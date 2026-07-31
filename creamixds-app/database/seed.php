<?php
declare(strict_types=1);

/**
 * Datos iniciales. Migrados desde el antiguo app/config/fake_db.php,
 * que ahora queda obsoleto: el contenido vive en la base de datos
 * y se edita desde el panel de administracion.
 */

return [
    'settings' => [
        ['site_title',    'CreaMixds | Diseno y desarrollo web a medida en Argentina', 'Titulo del sitio (SEO)', 1],
        ['site_description', 'Estudio digital que disena sitios web, landing pages, sistemas a medida y automatizaciones. Presencia online clara, rapida y pensada para conseguir clientes.', 'Descripcion (SEO)', 2],
        ['brand',         'CreaMixds', 'Nombre de la marca', 3],
        ['email',         'creamixds@gmail.com', 'Email de contacto', 4],
        ['whatsapp',      '5492494501665', 'WhatsApp (solo numeros)', 5],
        ['location',      'Argentina', 'Ubicacion', 6],
        ['hero_title',    'Sitios web que trabajan para tu negocio.', 'Titulo principal', 7],
        ['hero_subtitle', 'Disenamos y desarrollamos paginas, sistemas a medida y automatizaciones para que tu marca se vea profesional, cargue rapido y convierta visitas en consultas reales.', 'Subtitulo principal', 8],
        ['about_text',    'CreaMixds nace de una idea simple: una web sirve cuando alguien la usa y algo pasa despues. Una consulta que entra, un turno que se agenda, un cliente que entiende en treinta segundos que ofreces.', 'Texto de Nosotros', 9],
        ['instagram_url', 'https://www.instagram.com/creamixds', 'Instagram', 10],
        ['linkedin_url',  '', 'LinkedIn', 11],
    ],

    'blocks' => [
        // type, icon, title, description, position
        ['benefit', 'rocket',  'Mas clientes online',      'Aumenta tus ventas con un sitio optimizado para conversion y resultados medibles.', 1],
        ['benefit', 'sparkle', 'Imagen profesional',       'Destaca de la competencia con un diseno unico que refleja la esencia de tu marca.', 2],
        ['benefit', 'zap',     'Web rapida y optimizada',  'Sitios de alto rendimiento que cargan en segundos y mejoran la experiencia del usuario.', 3],
        ['benefit', 'handshake','Soporte personalizado',   'Te acompanamos en todo el proceso y mas alla del lanzamiento de tu proyecto.', 4],

        ['service', 'monitor',      'Desarrollo web',            'Sitios personalizados, modernos y funcionales construidos con las ultimas tecnologias.', 1],
        ['service', 'palette',      'Diseno UI/UX',              'Interfaces intuitivas y atractivas que ofrecen experiencias memorables a tus usuarios.', 2],
        ['service', 'rocket',       'Landing pages',             'Paginas de aterrizaje optimizadas para maximizar conversiones y captar clientes potenciales.', 3],
        ['service', 'shopping-bag', 'Tiendas online',            'E-commerce completos con sistemas de pago, inventario y gestion de pedidos integrados.', 4],
        ['service', 'target',       'Branding digital',          'Identidad de marca coherente y profesional que conecta con tu audiencia objetivo.', 5],
        ['service', 'wrench',       'Mantenimiento',             'Soporte continuo, actualizaciones y optimizacion para mantener tu sitio siempre activo.', 6],

        ['process', '01', 'Analisis del proyecto',  'Conocemos tus objetivos, publico y necesidades para definir alcance, plazos y presupuesto cerrado.', 1],
        ['process', '02', 'Diseno y prototipo',     'Creamos la estructura y el diseno visual para que apruebes antes de que escribamos codigo.', 2],
        ['process', '03', 'Desarrollo',             'Construimos frontend y backend, conectamos formularios e integraciones, y probamos en todos los dispositivos.', 3],
        ['process', '04', 'Lanzamiento y soporte',  'Publicamos, configuramos analitica y buscadores, y te ensenamos a administrar el sitio.', 4],

        ['stat', 'target', '+10',  'Proyectos entregados', 1],
        ['stat', 'smile',  '100%', 'Clientes conformes', 2],
        ['stat', 'zap',    '24/7', 'Soporte continuo', 3],
        ['stat', 'award',  '2+',   'Anos de experiencia', 4],
    ],

    'projects' => [
        ['👩‍🎨', 'Portafolio',   'Alexandra Torres',      'Portafolio profesional y elegante para fotografa con galeria de trabajos, seccion de servicios y formulario de contacto integrado.', 'https://creamix-ds.github.io/proyectos/portafolioalexandratorres.html', 1],
        ['💻', 'E-commerce',    'TechStore Pro',          'E-commerce corporativo de tecnologia con catalogo de productos, carrito de compras, filtros avanzados y diseno profesional optimizado.', 'https://creamix-ds.github.io/proyectos/TechStorePro-E-commerceCorporativo.html', 2],
        ['🍕', 'Sitio web',     'Pizzeria Artesanal',     'Sitio web para pizzeria con menu interactivo, sistema de pedidos online y diseno visual atractivo que aumento las ventas digitales.', 'https://creamix-ds.github.io/proyectos/pizerria.html', 3],
        ['📱', 'Landing page',  'Digital Marketing Pro',  'Landing page de alta conversion con formularios inteligentes, diseno moderno y optimizacion para captacion de leads.', 'https://creamix-ds.github.io/proyectos/DigitalMarketingPro.html', 4],
        ['💼', 'Sitio web',     'Empresa Corporativa',    'Sitio web profesional para empresa con presentacion de servicios, equipo de trabajo y formulario de contacto integrado.', 'https://creamix-ds.github.io/proyectos/corporativa.html', 5],
        ['🏋️', 'Sitio web',     'Fitness Zone',           'Portal web con sistema de reservas de clases, membresias online y blog de contenido fitness.', 'https://creamix-ds.github.io/proyectos/fitness-zone.html', 6],
    ],

    'testimonials' => [
        ['👨', 'El equipo de CreaMixds transformo completamente nuestra presencia online. En 3 meses triplicamos nuestras ventas digitales.', 'Carlos Mendoza', 'CEO, Tech Solutions', 1],
        ['👩', 'Entendieron perfecto lo que necesitabamos y entregaron mas de lo esperado. El sitio es lindo y ademas funciona.', 'Maria Gonzalez', 'Fundadora, Moda Urbana', 2],
        ['👨', 'No solo crearon un sitio espectacular, sino que nos ensenaron a aprovecharlo al maximo. Muy recomendados.', 'Roberto Silva', 'Dueno, Sabores Express', 3],
    ],
];
