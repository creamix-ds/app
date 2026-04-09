# CreaMix-ds PHP MVC

Proyecto convertido de página estática a una app dinámica en PHP con arquitectura MVC y una base de datos fake basada en arrays de configuración.

## Estructura

- `public/index.php`: front controller
- `app/core`: núcleo MVC simple (Router, Controller, View)
- `app/controllers/HomeController.php`: controlador principal
- `app/models/SiteModel.php`: obtiene los datos fake del sitio
- `app/config/fake_db.php`: base de datos fake
- `app/views`: vistas y layouts
- `public/assets/css/style.css`: estilos base recreados

## Cómo correrlo

### Opción 1: PHP embebido
```bash
cd public
php -S localhost:8000
```
Luego abrir `http://localhost:8000`

### Opción 2: XAMPP / Laragon / hosting PHP
Copiá la carpeta del proyecto al servidor y apuntá el document root a `public/`.

## Qué quedó dinámico

- Navbar
- Hero
- Beneficios
- Servicios
- Proceso
- Portafolio
- Testimonios
- Estadísticas
- CTA
- Contacto
- Footer

## Nota
No vino incluido el archivo original `styles.css`, así que armé una versión nueva y limpia, manteniendo la estructura y contenido de la página original.
