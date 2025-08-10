import { 
  Code, 
  Smartphone, 
  Palette, 
  Settings,
  Headphones,
  Zap 
} from "lucide-react";

export const mockServices = [
  {
    id: 1,
    title: "Desarrollo Web",
    description: "Aplicaciones web modernas y responsivas con las últimas tecnologías. Desde landing pages hasta plataformas complejas.",
    icon: Code,
    features: ["React/Vue.js", "Node.js/Python", "Bases de datos", "APIs REST"],
    price: "Desde $2,500 USD"
  },
  {
    id: 2,
    title: "Aplicaciones Móviles",
    description: "Apps nativas e híbridas para iOS y Android. Experiencias móviles fluidas y optimizadas.",
    icon: Smartphone,
    features: ["React Native", "Flutter", "iOS/Android", "App Store"],
    price: "Desde $3,500 USD"
  },
  {
    id: 3,
    title: "UI/UX Design",
    description: "Diseño de interfaces intuitivas y experiencias de usuario excepcionales que convierten visitantes en clientes.",
    icon: Palette,
    features: ["Figma/Adobe XD", "Prototipos", "Design System", "Testing UX"],
    price: "Desde $1,500 USD"
  },
  {
    id: 4,
    title: "Consultoría Técnica",
    description: "Asesoramiento especializado en arquitectura, tecnologías y estrategias de desarrollo para tu proyecto.",
    icon: Settings,
    features: ["Arquitectura", "Code Review", "Performance", "Seguridad"],
    price: "Desde $100 USD/hora"
  },
  {
    id: 5,
    title: "Mantenimiento y Soporte",
    description: "Soporte continuo, actualizaciones y mantenimiento para mantener tu aplicación funcionando perfectamente.",
    icon: Headphones,
    features: ["Soporte 24/7", "Updates", "Backups", "Monitoreo"],
    price: "Desde $500 USD/mes"
  },
  {
    id: 6,
    title: "Optimización y Performance",
    description: "Mejora el rendimiento de tu aplicación existente. Análisis profundo y optimizaciones avanzadas.",
    icon: Zap,
    features: ["Análisis", "SEO/Core Vitals", "Caching", "CDN Setup"],
    price: "Desde $800 USD"
  }
];

export const mockProjects = [
  {
    id: 1,
    title: "EcommercePro",
    category: "E-commerce",
    description: "Plataforma de comercio electrónico completa con panel de administración, carrito de compras avanzado y sistema de pagos integrado.",
    image: "https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop",
    technologies: ["React", "Node.js", "MongoDB", "Stripe"],
    results: {
      metric1: { value: "+150%", label: "Conversiones" },
      metric2: { value: "2.3s", label: "Carga rápida" }
    }
  },
  {
    id: 2,
    title: "HealthApp",
    category: "Salud",
    description: "Aplicación móvil para el seguimiento de salud personal con integración de wearables y análisis de datos.",
    image: "https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800&h=600&fit=crop",
    technologies: ["React Native", "Python", "PostgreSQL", "AWS"],
    results: {
      metric1: { value: "10k+", label: "Usuarios activos" },
      metric2: { value: "4.8★", label: "Rating App Store" }
    }
  },
  {
    id: 3,
    title: "FinanceTracker",
    category: "Fintech",
    description: "Dashboard financiero para empresas con análisis avanzado, reportes automáticos y visualización de datos en tiempo real.",
    image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop",
    technologies: ["Vue.js", "FastAPI", "Redis", "Chart.js"],
    results: {
      metric1: { value: "40%", label: "Tiempo ahorrado" },
      metric2: { value: "99.9%", label: "Uptime" }
    }
  },
  {
    id: 4,
    title: "LearningHub",
    category: "Educación",
    description: "Plataforma educativa interactiva con sistema de cursos, evaluaciones y seguimiento de progreso estudiantil.",
    image: "https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800&h=600&fit=crop",
    technologies: ["Next.js", "GraphQL", "Prisma", "WebRTC"],
    results: {
      metric1: { value: "5k+", label: "Estudiantes" },
      metric2: { value: "92%", label: "Completación" }
    }
  }
];

export const mockTestimonials = [
  {
    id: 1,
    name: "Ana García",
    position: "CEO, TechStart",
    company: "TechStart Solutions",
    content: "CreaMix-DS transformó completamente nuestra presencia digital. La calidad del código y la atención a los detalles son excepcionales.",
    avatar: "https://images.unsplash.com/photo-1494790108755-2616b612b47c?w=100&h=100&fit=crop&crop=face",
    rating: 5
  },
  {
    id: 2,
    name: "Carlos Mendoza",
    position: "Founder",
    company: "InnovaCorp",
    content: "Trabajar con CreaMix-DS fue una experiencia increíble. Entregaron exactamente lo que necesitábamos, a tiempo y dentro del presupuesto.",
    avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face",
    rating: 5
  },
  {
    id: 3,
    name: "María González",
    position: "Product Manager",
    company: "DigitalPro",
    content: "La comunicación fue excelente durante todo el proyecto. CreaMix-DS realmente entiende las necesidades del cliente y las convierte en soluciones efectivas.",
    avatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face",
    rating: 5
  }
];