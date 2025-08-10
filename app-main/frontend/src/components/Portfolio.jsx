import React from "react";
import { mockProjects } from "../data/mock";
import { ExternalLink, Github } from "lucide-react";

const Portfolio = () => {
  return (
    <section id="portfolio" className="portfolio-section">
      <div className="dark-content-container">
        <div className="section-header">
          <h2 className="display-large section-title">
            Proyectos Destacados
          </h2>
          <p className="body-large section-description">
            Una selección de mis trabajos más recientes y exitosos que 
            demuestran la calidad y versatilidad de mis servicios.
          </p>
        </div>
        
        <div className="portfolio-grid">
          {mockProjects.map((project, index) => (
            <div key={project.id} className="project-card">
              <div className="project-image">
                <img 
                  src={project.image} 
                  alt={project.title}
                  className="project-img"
                />
                <div className="project-overlay">
                  <div className="project-links">
                    <button className="project-link-btn">
                      <ExternalLink size={20} />
                    </button>
                    <button className="project-link-btn">
                      <Github size={20} />
                    </button>
                  </div>
                </div>
              </div>
              
              <div className="project-content">
                <div className="project-category">
                  {project.category}
                </div>
                <h3 className="heading-2 project-title">
                  {project.title}
                </h3>
                <p className="body-medium project-description">
                  {project.description}
                </p>
                
                <div className="project-tech">
                  {project.technologies.map((tech, idx) => (
                    <span key={idx} className="tech-tag">
                      {tech}
                    </span>
                  ))}
                </div>
                
                <div className="project-results">
                  <div className="project-result">
                    <span className="result-number">{project.results.metric1.value}</span>
                    <span className="result-label">{project.results.metric1.label}</span>
                  </div>
                  <div className="project-result">
                    <span className="result-number">{project.results.metric2.value}</span>
                    <span className="result-label">{project.results.metric2.label}</span>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Portfolio;