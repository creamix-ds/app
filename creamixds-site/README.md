# CreaMixds - Sitio web base con frontend y backend

Este proyecto incluye:

- `frontend/`: landing page responsive inspirada en una web de agencia digital
- `backend/`: API simple con Express para recibir formularios de contacto
- `frontend/assets/logo.png`: tu logo ya integrado

## Cómo usarlo

### 1) Frontend
Podés abrir `frontend/index.html` directamente en el navegador.

### 2) Backend
Desde la carpeta `backend`:

```bash
npm install
npm start
```

El backend corre en:

```bash
http://localhost:4000
```

### Endpoints disponibles

- `GET /api/health`
- `GET /api/contact`
- `POST /api/contact`

## Estructura

```text
creamixds-site/
├── frontend/
│   ├── assets/
│   │   └── logo.png
│   ├── index.html
│   ├── styles.css
│   └── script.js
├── backend/
│   ├── data/
│   │   └── contacts.json
│   ├── package.json
│   └── server.js
└── README.md
```

## Próximas mejoras recomendadas

- panel admin con login
- base de datos MySQL o PostgreSQL
- blog dinámico
- portfolio administrable
- integración con WhatsApp
- deploy en Vercel / Railway / Render
