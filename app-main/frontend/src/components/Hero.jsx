import React from "react";
import { ArrowRight, Code, Star } from "lucide-react";

const Hero = () => {
  return (
    <section className="hero-section">
      <div className="dark-content-container">
        <div className="hero-grid">
          <div className="hero-content">
            <div className="hero-badge">
              <Star className="hero-badge-icon" />
              <span>Desarrollador Full-Stack Profesional</span>
            </div>
            
            <h1 className="display-huge hero-title">
              Transformo Ideas en 
              <span className="hero-accent"> Soluciones Digitales</span>
            </h1>
            
            <p className="body-large hero-description">
              Como agente de servicios de desarrollo, creo aplicaciones web y móviles 
              de alta calidad que impulsan el crecimiento de tu negocio. Especializado 
              en tecnologías modernas y experiencias de usuario excepcionales.
            </p>
            
            <div className="hero-actions">
              <button className="btn-primary hero-cta">
                <span>Ver Mis Servicios</span>
                <ArrowRight size={20} />
              </button>
              
              <button className="btn-secondary hero-secondary">
                <Code size={20} />
                <span>Ver Portafolio</span>
              </button>
            </div>
            
            <div className="hero-stats">
              <div className="hero-stat">
                <span className="hero-stat-number">50+</span>
                <span className="hero-stat-label">Proyectos Completados</span>
              </div>
              <div className="hero-stat">
                <span className="hero-stat-number">3 años</span>
                <span className="hero-stat-label">de Experiencia</span>
              </div>
              <div className="hero-stat">
                <span className="hero-stat-number">100%</span>
                <span className="hero-stat-label">Satisfacción Cliente</span>
              </div>
            </div>
          </div>
          
          <div className="hero-visual">
            <div className="hero-code-preview">
              <div className="code-header">
                <div className="code-dots">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
                <span className="code-title">CreaMix-DS</span>
              </div>
              <div className="code-content">
                <div className="code-line">
                  <span className="code-keyword">const</span>
                  <span className="code-variable"> desarrollador</span>
                  <span className="code-operator"> = </span>
                  <span className="code-string">'CreaMix-DS'</span>
                </div>
                <div className="code-line">
                  <span className="code-keyword">function</span>
                  <span className="code-function"> crearSolucion</span>
                  <span className="code-punctuation">(</span>
                  <span className="code-parameter">idea</span>
                  <span className="code-punctuation">) {"{"}</span>
                </div>
                <div className="code-line code-indent">
                  <span className="code-keyword">return</span>
                  <span className="code-string"> 'Aplicación Increíble'</span>
                </div>
                <div className="code-line">
                  <span className="code-punctuation">{"}"}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;