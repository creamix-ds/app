import React from "react";
import { Github, Linkedin, Twitter, Mail } from "lucide-react";

const Footer = () => {
  const currentYear = new Date().getFullYear();
  
  const socialLinks = [
    {
      icon: Github,
      href: "https://github.com/creamix-ds",
      label: "GitHub"
    },
    {
      icon: Linkedin,
      href: "https://linkedin.com/in/creamix-ds",
      label: "LinkedIn"
    },
    {
      icon: Twitter,
      href: "https://twitter.com/creamix_ds",
      label: "Twitter"
    },
    {
      icon: Mail,
      href: "mailto:hola@creamix-ds.com",
      label: "Email"
    }
  ];

  const footerLinks = [
    {
      title: "Servicios",
      links: [
        { name: "Desarrollo Web", href: "#services" },
        { name: "Apps Móviles", href: "#services" },
        { name: "UI/UX Design", href: "#services" },
        { name: "Consultoría", href: "#services" }
      ]
    },
    {
      title: "Empresa",
      links: [
        { name: "Acerca de", href: "#about" },
        { name: "Portafolio", href: "#portfolio" },
        { name: "Contacto", href: "#contact" },
        { name: "Blog", href: "#" }
      ]
    },
    {
      title: "Legal",
      links: [
        { name: "Privacidad", href: "#" },
        { name: "Términos", href: "#" },
        { name: "Cookies", href: "#" }
      ]
    }
  ];

  return (
    <footer className="footer">
      <div className="dark-content-container">
        <div className="footer-content">
          <div className="footer-brand">
            <h3 className="footer-logo">CreaMix-DS</h3>
            <p className="footer-tagline">
              Transformando ideas en soluciones digitales excepcionales
            </p>
            
            <div className="footer-social">
              {socialLinks.map((social, index) => (
                <a
                  key={index}
                  href={social.href}
                  className="footer-social-link"
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={social.label}
                >
                  <social.icon size={20} />
                </a>
              ))}
            </div>
          </div>
          
          <div className="footer-links">
            {footerLinks.map((section, index) => (
              <div key={index} className="footer-section">
                <h4 className="footer-section-title">{section.title}</h4>
                <ul className="footer-section-links">
                  {section.links.map((link, linkIndex) => (
                    <li key={linkIndex}>
                      <a href={link.href} className="footer-link">
                        {link.name}
                      </a>
                    </li>
                  ))}
                </ul>
              </div>
            ))}
          </div>
        </div>
        
        <div className="footer-bottom">
          <div className="footer-copyright">
            <p>© {currentYear} CreaMix-DS. Todos los derechos reservados.</p>
          </div>
          
          <div className="footer-bottom-links">
            <a href="#" className="footer-bottom-link">Aviso de Privacidad</a>
            <a href="#" className="footer-bottom-link">Términos de Servicio</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;