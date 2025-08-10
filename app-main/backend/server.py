from fastapi import FastAPI, APIRouter, HTTPException
from dotenv import load_dotenv
from starlette.middleware.cors import CORSMiddleware
from motor.motor_asyncio import AsyncIOMotorClient
import os
import logging
from pathlib import Path
from pydantic import BaseModel, Field, EmailStr
from typing import List, Optional
import uuid
from datetime import datetime


ROOT_DIR = Path(__file__).parent
load_dotenv(ROOT_DIR / '.env')

# MongoDB connection
mongo_url = os.environ['MONGO_URL']
client = AsyncIOMotorClient(mongo_url)
db = client[os.environ['DB_NAME']]

# Create the main app without a prefix
app = FastAPI()

# Create a router with the /api prefix
api_router = APIRouter(prefix="/api")


# Define Models
class StatusCheck(BaseModel):
    id: str = Field(default_factory=lambda: str(uuid.uuid4()))
    client_name: str
    timestamp: datetime = Field(default_factory=datetime.utcnow)

class StatusCheckCreate(BaseModel):
    client_name: str

class ContactMessage(BaseModel):
    id: str = Field(default_factory=lambda: str(uuid.uuid4()))
    name: str
    email: EmailStr
    service: str
    message: str
    status: str = "nuevo"
    created_at: datetime = Field(default_factory=datetime.utcnow)
    read_at: Optional[datetime] = None

class ContactMessageCreate(BaseModel):
    name: str
    email: EmailStr
    service: str
    message: str

class ContactMessageUpdate(BaseModel):
    status: Optional[str] = None
    read_at: Optional[datetime] = None

# Add your routes to the router instead of directly to app
@api_router.get("/")
async def root():
    return {"message": "Hello World"}

@api_router.post("/status", response_model=StatusCheck)
async def create_status_check(input: StatusCheckCreate):
    status_dict = input.dict()
    status_obj = StatusCheck(**status_dict)
    _ = await db.status_checks.insert_one(status_obj.dict())
    return status_obj

@api_router.get("/status", response_model=List[StatusCheck])
async def get_status_checks():
    status_checks = await db.status_checks.find().to_list(1000)
    return [StatusCheck(**status_check) for status_check in status_checks]

# Contact Form Routes
@api_router.post("/contact", response_model=ContactMessage)
async def create_contact_message(input: ContactMessageCreate):
    """Crear nuevo mensaje de contacto"""
    contact_dict = input.dict()
    contact_obj = ContactMessage(**contact_dict)
    
    # Insertar en la base de datos
    result = await db.contact_messages.insert_one(contact_obj.dict())
    
    if result.inserted_id:
        logger.info(f"Nuevo mensaje de contacto creado: {contact_obj.name} - {contact_obj.email}")
        return contact_obj
    else:
        raise HTTPException(status_code=500, detail="Error al guardar el mensaje")

@api_router.get("/contact", response_model=List[ContactMessage])
async def get_contact_messages(skip: int = 0, limit: int = 50):
    """Obtener todos los mensajes de contacto"""
    messages = await db.contact_messages.find().sort("created_at", -1).skip(skip).limit(limit).to_list(limit)
    return [ContactMessage(**message) for message in messages]

@api_router.get("/contact/stats")
async def get_contact_stats():
    """Obtener estadísticas de mensajes de contacto"""
    total_messages = await db.contact_messages.count_documents({})
    new_messages = await db.contact_messages.count_documents({"status": "nuevo"})
    read_messages = await db.contact_messages.count_documents({"status": "leido"})
    
    # Contar por servicio
    pipeline = [
        {"$group": {"_id": "$service", "count": {"$sum": 1}}},
        {"$sort": {"count": -1}}
    ]
    services_stats = await db.contact_messages.aggregate(pipeline).to_list(10)
    
    return {
        "total_messages": total_messages,
        "new_messages": new_messages,
        "read_messages": read_messages,
        "services_stats": services_stats
    }

@api_router.put("/contact/{contact_id}", response_model=ContactMessage)
async def update_contact_message(contact_id: str, update: ContactMessageUpdate):
    """Actualizar estado de mensaje de contacto"""
    update_data = {}
    
    if update.status:
        update_data["status"] = update.status
        if update.status == "leido":
            update_data["read_at"] = datetime.utcnow()
    
    if update.read_at:
        update_data["read_at"] = update.read_at
    
    # Actualizar en la base de datos
    result = await db.contact_messages.update_one(
        {"id": contact_id},
        {"$set": update_data}
    )
    
    if result.modified_count == 0:
        raise HTTPException(status_code=404, detail="Mensaje no encontrado")
    
    # Obtener el mensaje actualizado
    updated_message = await db.contact_messages.find_one({"id": contact_id})
    if not updated_message:
        raise HTTPException(status_code=404, detail="Mensaje no encontrado")
    
    return ContactMessage(**updated_message)

@api_router.delete("/contact/{contact_id}")
async def delete_contact_message(contact_id: str):
    """Eliminar mensaje de contacto"""
    result = await db.contact_messages.delete_one({"id": contact_id})
    
    if result.deleted_count == 0:
        raise HTTPException(status_code=404, detail="Mensaje no encontrado")
    
    return {"message": "Mensaje eliminado correctamente"}

# Include the router in the main app
app.include_router(api_router)

app.add_middleware(
    CORSMiddleware,
    allow_credentials=True,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

@app.on_event("shutdown")
async def shutdown_db_client():
    client.close()
