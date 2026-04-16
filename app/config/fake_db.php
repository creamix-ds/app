<?php

return [ // Simulamos una base de datos con un array multidimensional que contiene toda la información del sitio
    'site' => [
        'title' => 'CreaMix-ds | Agencia Digital Creativa',
        'brand' => 'CreaMix-ds',
        'email' => 'creamixds@gmail.com',
        'whatsapp' => '+5492494501665',
        'description' => 'Agencia digital especializada en diseño y desarrollo web',
        'location' => 'Argentina',
        'year' => '2026',
        'logo' => 'logo.png',
    ],
// Información para el menú de navegación, se puede modificar fácilmente para agregar o quitar secciones
    'nav' => [
        ['label' => 'Inicio', 'href' => '#inicio'],
        ['label' => 'Servicios', 'href' => '#servicios'],
        ['label' => 'Portafolio', 'href' => '#portafolio'],
        ['label' => 'Proceso', 'href' => '#proceso'],
    ],
// Contenido para la sección hero, con título, subtítulo y botón de llamada a la acción
    'hero' => [
        'title' => 'Diseño y desarrollo web para hacer crecer tu negocio',
        'subtitle' => 'Creamos sitios modernos, rápidos y optimizados para convertir visitas en clientes',
        'button' => ['label' => 'Ver proyectos', 'href' => '#portafolio'],
    ],
// Beneficios destacados de trabajar con la agencia, cada uno con un ícono, título y descripción
    'benefits' => [
        [
            'icon' => '🚀',
            'title' => 'Más clientes online',
            'description' => 'Aumenta tus ventas con un sitio optimizado para conversión y resultados medibles',
        ],
        [
            'icon' => '✨',
            'title' => 'Imagen profesional',
            'description' => 'Destaca de la competencia con un diseño único que refleja la esencia de tu marca',
        ],
        [
            'icon' => '⚡',
            'title' => 'Web rápida y optimizada',
            'description' => 'Sitios de alto rendimiento que cargan en segundos y mejoran la experiencia del usuario',
        ],
        [
            'icon' => '🤝',
            'title' => 'Soporte personalizado',
            'description' => 'Te acompañamos en todo el proceso y más allá del lanzamiento de tu proyecto',
        ],
    ],
// Información para la sección de servicios, con un título, subtítulo y una lista de servicios ofrecidos por la agencia
    'services_section' => [
        'badge' => 'Servicios',
        'title' => 'Soluciones digitales completas',
        'subtitle' => 'Todo lo que necesitas para establecer una presencia digital profesional y efectiva',
    ],

    'services' => [
        ['icon' => 'monitor', 'title' => 'Desarrollo Web', 'description' => 'Sitios web personalizados, modernos y funcionales construidos con las últimas tecnologías del mercado'],
        ['icon' => 'palette', 'title' => 'Diseño UI/UX', 'description' => 'Interfaces intuitivas y atractivas que ofrecen experiencias memorables a tus usuarios'],
        ['icon' => 'rocket', 'title' => 'Landing Pages', 'description' => 'Páginas de aterrizaje optimizadas para maximizar conversiones y captar clientes potenciales'],
        ['icon' => 'shopping-bag', 'title' => 'Tiendas Online', 'description' => 'E-commerce completos con sistemas de pago, inventario y gestión de pedidos integrados'],
        ['icon' => 'target', 'title' => 'Branding Digital', 'description' => 'Identidad de marca coherente y profesional que conecta con tu audiencia objetivo'],
        ['icon' => 'wrench', 'title' => 'Mantenimiento', 'description' => 'Soporte continuo, actualizaciones y optimización para mantener tu sitio siempre activo'],
    ],

    'process_section' => [
        'badge' => 'Proceso',
        'title' => 'Cómo trabajamos',
        'subtitle' => 'Un proceso claro y efectivo que garantiza resultados excepcionales',
    ],

    'process_steps' => [
        ['number' => 1, 'title' => 'Análisis del proyecto', 'description' => 'Conocemos tus objetivos, público y necesidades para crear la estrategia perfecta'],
        ['number' => 2, 'title' => 'Diseño y prototipo', 'description' => 'Creamos wireframes y diseños visuales para que apruebes antes de desarrollar'],
        ['number' => 3, 'title' => 'Desarrollo', 'description' => 'Construimos tu sitio con código limpio, optimizado y siguiendo mejores prácticas'],
        ['number' => 4, 'title' => 'Lanzamiento y soporte', 'description' => 'Publicamos tu proyecto y te acompañamos con soporte continuo y capacitación'],
    ],
// Información para la sección de portafolio, con un título, subtítulo y una lista de proyectos destacados realizados por la agencia
    'portfolio_section' => [
        'badge' => 'Portafolio',
        'title' => 'Proyectos destacados',
        'subtitle' => 'Algunos de nuestros trabajos más recientes que transformaron negocios',
    ],
// Cada proyecto del portafolio tiene un emoji representativo, una etiqueta de categoría, un título, una descripción breve y un enlace al proyecto en vivo
    'portfolio' => [
        [
            'emoji' => '👩‍🎨',
            'tag' => 'Portafolio',
            'title' => 'Alexandra Torres',
            'description' => 'Portafolio profesional y elegante para fotógrafa con galería de trabajos, sección de servicios y formulario de contacto integrado',
            'url' => 'https://creamix-ds.github.io/proyectos/portafolioalexandratorres.html',
        ],
        [
            'emoji' => '💻',
            'tag' => 'E-commerce',
            'title' => 'TechStore Pro',
            'description' => 'E-commerce corporativo de tecnología con catálogo de productos, carrito de compras, filtros avanzados y diseño profesional optimizado',
            'url' => 'https://creamix-ds.github.io/proyectos/TechStorePro-E-commerceCorporativo.html',
        ],
        [
            'emoji' => '🍕',
            'tag' => 'Sitio Web',
            'title' => 'Pizzería Artesanal',
            'description' => 'Sitio web para pizzería con menú interactivo, sistema de pedidos online y diseño visual atractivo que aumentó las ventas digitales',
            'url' => 'https://creamix-ds.github.io/proyectos/pizerria.html',
        ],
        [
            'emoji' => '📱',
            'tag' => 'Landing Page',
            'title' => 'Digital Marketing Pro',
            'description' => 'Landing page de alta conversión con formularios inteligentes, diseño moderno y optimización para captación de leads',
            'url' => 'https://creamix-ds.github.io/proyectos/DigitalMarketingPro.html',
        ],
        [
            'emoji' => '💼',
            'tag' => 'Sitio Web',
            'title' => 'Empresa Corporativa',
            'description' => 'Sitio web profesional para empresa con presentación de servicios, equipo de trabajo y formulario de contacto integrado',
            'url' => 'https://creamix-ds.github.io/proyectos/corporativa.html',
        ],
        [
            'emoji' => '🏋️',
            'tag' => 'Sitio Web',
            'title' => 'Fitness Zone',
            'description' => 'Portal web con sistema de reservas de clases, membresías online y blog de contenido fitness',
            'url' => 'https://creamix-ds.github.io/proyectos/fitness-zone.html',
        ],
    ],

    'testimonials_section' => [
        'badge' => 'Testimonios',
        'title' => 'Lo que dicen nuestros clientes',
        'subtitle' => 'Historias de éxito que nos motivan a seguir mejorando',
    ],

    'testimonials' => [
        [
            'avatar' => '👨',
            'text' => 'El equipo de CreaMix-ds transformó completamente nuestra presencia online. En 3 meses triplicamos nuestras ventas digitales. Profesionales y comprometidos al 100%.',
            'name' => 'Carlos Mendoza',
            'role' => 'CEO, Tech Solutions',
        ],
        [
            'avatar' => '👩',
            'text' => 'Increíble experiencia trabajando con ellos. Entendieron perfecto lo que necesitábamos y entregaron más de lo esperado. El sitio es hermoso y funcional.',
            'name' => 'María González',
            'role' => 'Fundadora, Moda Urbana',
        ],
        [
            'avatar' => '👨',
            'text' => 'La mejor inversión que hicimos para nuestro negocio. No solo crearon un sitio espectacular, sino que nos enseñaron a aprovecharlo al máximo. Muy recomendados.',
            'name' => 'Roberto Silva',
            'role' => 'Dueño, Sabores Express',
        ],
    ],
// Estadísticas destacadas de la agencia, cada una con un ícono, un número representativo y una etiqueta descriptiva
    'stats' => [
        ['icon' => '🎯', 'number' => '+10', 'label' => 'Proyectos Exitosos'],
        ['icon' => '😊', 'number' => '100%', 'label' => 'Clientes Satisfechos'],
        ['icon' => '⚡', 'number' => '24/7', 'label' => 'Soporte Continuo'],
        ['icon' => '🏆', 'number' => '2+', 'label' => 'Años de Experiencia'],
    ],

    'cta' => [
        'title' => '¿Listo para llevar tu proyecto al siguiente nivel?',
        'subtitle' => 'Comienza hoy mismo a construir la presencia digital que tu negocio merece',
        'button' => ['label' => 'Pedí tu presupuesto hoy', 'href' => '#contacto'],
    ],
// Información para la sección de contacto, con un título, subtítulo y botones para contactar por whatsapp o email
    'contact' => [
        'badge' => 'Contacto',
        'title' => 'Hablemos de tu proyecto',
        'subtitle' => 'Contanos qué necesitas y te enviaremos una propuesta personalizada',
        'buttons' => [
            ['label' => 'Contactar por whatsapp', 'href' => 'https://wa.me/5492494501665'],
            ['label' => 'Contactar por email', 'href' => 'mailto:creamixds@gmail.com?subject=Consulta%20sobre%20mi%20proyecto'],
        ],
    ],
];
