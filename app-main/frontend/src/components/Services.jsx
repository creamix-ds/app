import React from "react";
import { mockServices } from "../data/mock";
import { ArrowRight } from "lucide-react";

const Services = () => {
  return (
    <section id="services" className="services-section">
      <div className="dark-content-container">
        <div className="section-header">
          <h2 className="display-large section-title">
            Servicios Profesionales
          </h2>
          <p className="body-large section-description">
            Ofrezco soluciones completas de desarrollo que cubren todas las 
            necesidades tecnológicas de tu proyecto o empresa.
          </p>
        </div>
        
        <div className="services-grid">
          {mockServices.map((service, index) => (
            <div key={service.id} className="service-card">
              <div className="service-icon-container">
                <service.icon className="service-icon" size={32} />
              </div>
              
              <div className="service-content">
                <h3 className="heading-2 service-title">{service.title}</h3>
                <p className="body-medium service-description">
                  {service.description}
                </p>
                
                <div className="service-features">
                  {service.features.map((feature, idx) => (
                    <span key={idx} className="service-feature">
                      {feature}
                    </span>
                  ))}
                </div>
                
                <div className="service-footer">
                  <span className="service-price">{service.price}</span>
                  <button className="service-cta">
                    <span>Más detalles</span>
                    <ArrowRight size={16} />
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Services;