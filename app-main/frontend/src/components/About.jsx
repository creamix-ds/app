import React from "react";
import { CheckCircle, Award, Users, Clock } from "lucide-react";

const About = () => {
  const achievements = [
    {
      icon: Award,
      title: "Calidad Premium",
      description: "Código limpio y optimizado siguiendo mejores prácticas"
    },
    {
      icon: Clock,
      title: "Entrega Puntual",
      description: "Cumplimiento de plazos garantizado en todos los proyectos"
    },
    {
      icon: Users,
      title: "Soporte Continuo",
      description: "Acompañamiento durante y después del desarrollo"
    }
  ];

  return (
    <section id="about" className="about-section">
      <div className="dark-content-container">
        <div className="about-grid">
          <div className="about-content">
            <h2 className="display-large about-title">
              Sobre CreaMix-DS
            </h2>
            
            <p className="body-large about-description">
              Soy un desarrollador apasionado por crear soluciones digitales que 
              marcan la diferencia. Con más de 3 años de experiencia en el sector, 
              me especializo en transformar ideas complejas en aplicaciones 
              intuitivas y efectivas.
            </p>
            
            <div className="about-skills">
              <h3 className="heading-2">Tecnologías Principales</h3>
              <div className="skills-grid">
                <span className="skill-tag">React</span>
                <span className="skill-tag">Node.js</span>
                <span className="skill-tag">Python</span>
                <span className="skill-tag">FastAPI</span>
                <span className="skill-tag">MongoDB</span>
                <span className="skill-tag">PostgreSQL</span>
                <span className="skill-tag">React Native</span>
                <span className="skill-tag">TypeScript</span>
                <span className="skill-tag">AWS</span>
                <span className="skill-tag">Docker</span>
              </div>
            </div>
            
            <div className="about-values">
              <h3 className="heading-2">Por qué elegir CreaMix-DS</h3>
              <div className="values-list">
                <div className="value-item">
                  <CheckCircle className="value-icon" size={20} />
                  <span>Enfoque centrado en resultados y ROI</span>
                </div>
                <div className="value-item">
                  <CheckCircle className="value-icon" size={20} />
                  <span>Comunicación transparente en todo momento</span>
                </div>
                <div className="value-item">
                  <CheckCircle className="value-icon" size={20} />
                  <span>Soluciones escalables y mantenibles</span>
                </div>
                <div className="value-item">
                  <CheckCircle className="value-icon" size={20} />
                  <span>Testing riguroso y documentación completa</span>
                </div>
              </div>
            </div>
          </div>
          
          <div className="about-achievements">
            {achievements.map((achievement, index) => (
              <div key={index} className="achievement-card">
                <div className="achievement-icon-container">
                  <achievement.icon className="achievement-icon" size={28} />
                </div>
                <div className="achievement-content">
                  <h4 className="heading-3 achievement-title">
                    {achievement.title}
                  </h4>
                  <p className="body-medium achievement-description">
                    {achievement.description}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default About;