# Contratos API - CreaMix-DS

## Backend Implementation Plan

### 1. Contact Form Endpoints

**POST /api/contact**
- Recibe datos del formulario de contacto
- Guarda en MongoDB
- Envía respuesta de confirmación

**GET /api/contact**
- Lista todos los mensajes de contacto
- Solo para administración
- Paginación opcional

**PUT /api/contact/:id**
- Marca mensaje como leído/no leído
- Para gestión administrativa

### 2. Database Models

**ContactMessage:**
```javascript
{
  _id: ObjectId,
  name: String (required),
  email: String (required),
  service: String (required),
  message: String (required),
  status: String (default: 'nuevo'),
  createdAt: Date,
  readAt: Date
}
```

### 3. Frontend Integration

**Components to Create:**
- AdminPanel.jsx - Panel para ver mensajes
- ContactStats.jsx - Estadísticas de contactos

**Routes to Add:**
- /admin - Panel de administración
- Protección básica con contraseña

### 4. Mock Data Removal

**Files to Update:**
- Contact.jsx - Integrar con API real
- Remover alert() y usar notificaciones reales
- Agregar validación y loading states

### 5. Admin Features

- Lista de mensajes con filtros
- Marcar como leído/no leído
- Responder directamente por email
- Estadísticas básicas