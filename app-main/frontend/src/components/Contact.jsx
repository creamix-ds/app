import React, { useState } from "react";
import { Send, Mail, Phone, MapPin, MessageCircle } from "lucide-react";
import axios from "axios";

const BACKEND_URL = process.env.REACT_APP_BACKEND_URL;
const API = `${BACKEND_URL}/api`;

const Contact = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    service: "",
    message: ""
  });
  
  const [isLoading, setIsLoading] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);
  const [error, setError] = useState("");

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError("");
    
    try {
      const response = await axios.post(`${API}/contact`, formData);
      
      if (response.status === 200) {
        setIsSuccess(true);
        setFormData({
          name: "",
          email: "",
          service: "",
          message: ""
        });
        
        // Mostrar mensaje de éxito por 5 segundos
        setTimeout(() => {
          setIsSuccess(false);
        }, 5000);
      }
    } catch (error) {
      console.error("Error al enviar mensaje:", error);
      setError("Hubo un error al enviar tu mensaje. Por favor intenta de nuevo.");
    } finally {
      setIsLoading(false);
    }
  };

  const contactInfo = [
    {
      icon: Mail,
      title: "Email",
      value: "hola@creamix-ds.com",
      action: "mailto:hola@creamix-ds.com"
    },
    {
      icon: Phone,
      title: "Teléfono",
      value: "+52 123 456 7890",
      action: "tel:+5211234567890"
    },
    {
      icon: MessageCircle,
      title: "WhatsApp",
      value: "Chatear ahora",
      action: "https://wa.me/5211234567890"
    },
    {
      icon: MapPin,
      title: "Ubicación",
      value: "Ciudad de México, MX",
      action: null
    }
  ];

  return (
    <section id="contact" className="contact-section">
      <div className="dark-content-container">
        <div className="section-header">
          <h2 className="display-large section-title">
            Comencemos tu Proyecto
          </h2>
          <p className="body-large section-description">
            ¿Tienes una idea increíble? Hablemos sobre cómo puedo ayudarte 
            a convertirla en realidad.
          </p>
        </div>
        
        <div className="contact-grid">
          <div className="contact-info">
            <h3 className="heading-2 contact-info-title">
              Información de Contacto
            </h3>
            
            <div className="contact-methods">
              {contactInfo.map((info, index) => (
                <div key={index} className="contact-method">
                  <div className="contact-method-icon">
                    <info.icon size={24} />
                  </div>
                  <div className="contact-method-content">
                    <span className="contact-method-title">{info.title}</span>
                    {info.action ? (
                      <a 
                        href={info.action} 
                        className="contact-method-value contact-link"
                        target="_blank"
                        rel="noopener noreferrer"
                      >
                        {info.value}
                      </a>
                    ) : (
                      <span className="contact-method-value">{info.value}</span>
                    )}
                  </div>
                </div>
              ))}
            </div>
            
            <div className="contact-cta">
              <h4 className="heading-3">¿Listo para empezar?</h4>
              <p className="body-medium">
                Respondo en menos de 24 horas. Hablemos sobre tu proyecto 
                y cómo puedo ayudarte a alcanzar tus objetivos.
              </p>
            </div>
          </div>
          
          <div className="contact-form-container">
            {isSuccess && (
              <div className="success-message">
                <div className="success-content">
                  <Send className="success-icon" size={24} />
                  <div>
                    <h4>¡Mensaje enviado exitosamente!</h4>
                    <p>Te contactaré pronto. Gracias por tu interés.</p>
                  </div>
                </div>
              </div>
            )}
            
            {error && (
              <div className="error-message">
                <p>{error}</p>
              </div>
            )}
            
            <form className="contact-form" onSubmit={handleSubmit}>
              <div className="form-group">
                <label htmlFor="name" className="form-label">
                  Nombre completo
                </label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleInputChange}
                  className="form-input"
                  placeholder="Tu nombre"
                  required
                  disabled={isLoading}
                />
              </div>
              
              <div className="form-group">
                <label htmlFor="email" className="form-label">
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleInputChange}
                  className="form-input"
                  placeholder="tu@email.com"
                  required
                  disabled={isLoading}
                />
              </div>
              
              <div className="form-group">
                <label htmlFor="service" className="form-label">
                  Servicio de interés
                </label>
                <select
                  id="service"
                  name="service"
                  value={formData.service}
                  onChange={handleInputChange}
                  className="form-select"
                  required
                  disabled={isLoading}
                >
                  <option value="">Selecciona un servicio</option>
                  <option value="web-development">Desarrollo Web</option>
                  <option value="mobile-development">App Móvil</option>
                  <option value="ui-ux-design">UI/UX Design</option>
                  <option value="consulting">Consultoría</option>
                  <option value="maintenance">Mantenimiento</option>
                </select>
              </div>
              
              <div className="form-group">
                <label htmlFor="message" className="form-label">
                  Mensaje
                </label>
                <textarea
                  id="message"
                  name="message"
                  value={formData.message}
                  onChange={handleInputChange}
                  className="form-textarea"
                  placeholder="Cuéntame sobre tu proyecto..."
                  rows={5}
                  required
                  disabled={isLoading}
                />
              </div>
              
              <button 
                type="submit" 
                className={`btn-primary form-submit ${isLoading ? 'loading' : ''}`}
                disabled={isLoading}
              >
                <span>{isLoading ? 'Enviando...' : 'Enviar Mensaje'}</span>
                <Send size={20} />
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Contact;