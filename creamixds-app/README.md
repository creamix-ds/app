# CreaMixds — aplicación full stack

Sitio de CreaMixds en PHP con arquitectura MVC, base de datos real y panel de
administración. Todo el contenido del sitio (servicios, proyectos, testimonios,
textos, datos de contacto) se edita desde el panel, sin tocar código.

Sin dependencias externas: no necesita Composer ni npm.

---

## Requisitos

- PHP 8.1 o superior
- Extensión PDO con `pdo_sqlite` (desarrollo) o `pdo_mysql` (producción)
- Apache con `mod_rewrite`, o Nginx, o el servidor embebido de PHP

`mbstring` es recomendable pero no obligatorio: si no está, la aplicación usa
funciones de respaldo.

---

## Puesta en marcha en 3 pasos

```bash
cp .env.example .env      # 1. crear la configuración
php bin/install.php       # 2. crear tablas y cargar contenido inicial
php -S localhost:8000 -t public public/index.php   # 3. levantar
```

El instalador imprime el usuario y la contraseña del panel al terminar. Si dejás
`ADMIN_PASSWORD` vacío en el `.env`, genera una al azar y la muestra por pantalla.

- Sitio: http://localhost:8000
- Panel: http://localhost:8000/admin

Para empezar de cero: `php bin/install.php --fresh` (borra todo).

---

## Estructura

```
├── .env                    Configuración y credenciales (nunca va al repositorio)
├── bin/install.php         Instalador: crea tablas y carga datos iniciales
├── database/
│   ├── schema.mysql.sql    Esquema para MySQL / MariaDB
│   ├── schema.sqlite.sql   Esquema para SQLite
│   └── seed.php            Contenido inicial
├── app/
│   ├── routes.php          Todas las rutas de la aplicación
│   ├── Core/               Núcleo: Router, Database, Auth, Csrf, Validator...
│   ├── Models/             Acceso a datos, una clase por tabla
│   ├── Controllers/        Sitio público + panel (Controllers/Admin)
│   └── Views/              Plantillas y layouts
├── public/                 Única carpeta expuesta al navegador
│   ├── index.php           Front controller
│   ├── .htaccess           Reescritura de URLs y cabeceras de seguridad
│   └── assets/             CSS, JS e imágenes
└── storage/                Base SQLite y logs (no versionado)
```

---

## Base de datos

Seis tablas:

| Tabla | Para qué |
|---|---|
| `users` | Usuarios del panel, contraseña con `password_hash()` |
| `settings` | Textos y datos del sitio en pares clave/valor |
| `content_blocks` | Servicios, beneficios, pasos del proceso y estadísticas |
| `projects` | Portafolio |
| `testimonials` | Testimonios de clientes |
| `leads` | Consultas recibidas por el formulario |

Cambiar de SQLite a MySQL es cambiar `DB_DRIVER=mysql` en el `.env`, completar
los datos de conexión y volver a correr `php bin/install.php`. El código no cambia.

---

## El panel

- **Resumen** — consultas sin leer y últimas recibidas
- **Consultas** — bandeja con filtros por estado, responder por email, archivar o eliminar
- **Servicios / Proyectos / Testimonios / Beneficios / Proceso / Estadísticas** — alta, baja, modificación, orden y visibilidad
- **Datos del sitio** — marca, email, WhatsApp, redes, textos y etiquetas SEO, más el cambio de contraseña

Cada sección usa el mismo CRUD (`Controllers/Admin/ResourceController`): para
agregar un recurso nuevo alcanza con declarar su modelo y sus campos.

---

## Seguridad

- **Rutas explícitas.** El router anterior armaba el nombre de la clase y del método
  desde la URL (`?url=Controlador/metodo`), lo que permitía invocar cualquier
  método público del proyecto. Ahora solo existe lo declarado en `app/routes.php`.
- **Consultas preparadas** en todas las operaciones; ningún valor se concatena al SQL.
- **Escape en las vistas** con `e()` en cada dato que viene de la base.
- **Token CSRF** obligatorio en todos los POST.
- **Contraseñas** con `password_hash()` y verificación de tiempo constante.
- **Cookies de sesión** `HttpOnly` y `SameSite=Lax`, con regeneración de ID al entrar.
- **Antispam** en el formulario: campo trampa invisible y máximo de 3 envíos por IP por hora.
- **Credenciales fuera del código**, en `.env`, que está en el `.gitignore`.
- **Panel con `noindex`** para que no aparezca en buscadores.

---

## SEO

- Un solo `<h1>`, jerarquía de encabezados correcta y HTML semántico
- `title`, `description`, canonical, Open Graph y Twitter Card generados desde la base
- Datos estructurados JSON-LD (`ProfessionalService`)
- Sin Tailwind por CDN: el CSS es propio y pesa una fracción
- Fuentes con `preconnect` y `display=swap`
- Formulario accesible, foco visible, salto al contenido y `prefers-reduced-motion`

---

## Subir a producción

1. Copiar los archivos al servidor.
2. **Apuntar el document root a `public/`.** Si el hosting no lo permite, mover el
   contenido de `public/` a la raíz y ajustar la constante `BASE_PATH` en `index.php`.
3. Crear la base MySQL y completar el `.env` con sus datos.
4. Poner `APP_ENV=production`, `APP_DEBUG=false` y `APP_URL=https://creamixds.com`.
5. Correr `php bin/install.php`.
6. Entrar al panel y cambiar la contraseña.
7. Activar `MAIL_ENABLED=true` para recibir aviso por email de cada consulta.

Verificar que `.env`, `storage/` y `app/` no sean accesibles desde el navegador:
si el document root apunta a `public/`, quedan fuera por diseño.

---

## Qué reemplaza esta versión

| Antes | Ahora |
|---|---|
| `app/config/fake_db.php` (arrays en el código) | Base de datos + panel de administración |
| Backend Node en `creamixds-site/` guardando en `contacts.json` | Tabla `leads` y bandeja de consultas en PHP |
| Formulario sin destino real | Guarda, valida, filtra spam y avisa por email |
| Router que aceptaba cualquier controlador desde la URL | Rutas declaradas, con verbos HTTP y middleware |
| Sin usuarios ni login | Autenticación con sesiones y contraseñas hasheadas |

El contenido de `fake_db.php` está migrado en `database/seed.php`; los archivos
viejos se pueden borrar del repositorio.
