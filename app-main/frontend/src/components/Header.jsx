import React, { useState } from "react";
import { Menu, X } from "lucide-react";

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
      element.scrollIntoView({ behavior: "smooth" });
    }
    setIsMenuOpen(false);
  };

  return (
    <header className="dark-header">
      <div className="dark-logo-container">
        <h1 className="dark-logo-text">CreaMix-DS</h1>
      </div>
      
      <nav className="dark-nav">
        <button 
          className="dark-nav-link" 
          onClick={() => scrollToSection('services')}
        >
          Servicios
        </button>
        <button 
          className="dark-nav-link" 
          onClick={() => scrollToSection('about')}
        >
          Acerca de
        </button>
        <button 
          className="dark-nav-link" 
          onClick={() => scrollToSection('portfolio')}
        >
          Portafolio
        </button>
        <button 
          className="dark-nav-link" 
          onClick={() => scrollToSection('contact')}
        >
          Contacto
        </button>
      </nav>

      <div className="mobile-menu-button">
        <button 
          onClick={() => setIsMenuOpen(!isMenuOpen)}
          className="mobile-menu-toggle"
        >
          {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
        </button>
      </div>

      {isMenuOpen && (
        <div className="mobile-menu">
          <button 
            className="mobile-nav-link" 
            onClick={() => scrollToSection('services')}
          >
            Servicios
          </button>
          <button 
            className="mobile-nav-link" 
            onClick={() => scrollToSection('about')}
          >
            Acerca de
          </button>
          <button 
            className="mobile-nav-link" 
            onClick={() => scrollToSection('portfolio')}
          >
            Portafolio
          </button>
          <button 
            className="mobile-nav-link" 
            onClick={() => scrollToSection('contact')}
          >
            Contacto
          </button>
        </div>
      )}
    </header>
  );
};

export default Header;