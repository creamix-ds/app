const express = require('express');
const cors = require('cors');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 4000;
const dataFile = path.join(__dirname, 'data', 'contacts.json');

app.use(cors());
app.use(express.json());

function ensureDataFile() {
  if (!fs.existsSync(dataFile)) {
    fs.writeFileSync(dataFile, '[]', 'utf8');
  }
}

function readContacts() {
  ensureDataFile();
  return JSON.parse(fs.readFileSync(dataFile, 'utf8'));
}

function saveContacts(contacts) {
  fs.writeFileSync(dataFile, JSON.stringify(contacts, null, 2), 'utf8');
}

app.get('/api/health', (_req, res) => {
  res.json({ ok: true, message: 'Backend CreaMixds funcionando.' });
});

app.get('/api/contact', (_req, res) => {
  const contacts = readContacts();
  res.json({ total: contacts.length, contacts });
});

app.post('/api/contact', (req, res) => {
  const { name, email, company = '', service = '', message } = req.body;

  if (!name || !email || !message) {
    return res.status(400).json({ message: 'Nombre, email y mensaje son obligatorios.' });
  }

  const contacts = readContacts();
  const newContact = {
    id: Date.now(),
    name,
    email,
    company,
    service,
    message,
    createdAt: new Date().toISOString(),
  };

  contacts.unshift(newContact);
  saveContacts(contacts);

  return res.status(201).json({
    message: 'Consulta guardada correctamente.',
    contact: newContact,
  });
});

app.listen(PORT, () => {
  ensureDataFile();
  console.log(`Servidor CreaMixds escuchando en http://localhost:${PORT}`);
});
