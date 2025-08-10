import React, { useState, useEffect } from "react";
import { 
  Mail, 
  Calendar, 
  User, 
  MessageSquare, 
  Eye, 
  EyeOff, 
  Trash2, 
  Filter,
  ArrowLeft,
  BarChart3
} from "lucide-react";
import axios from "axios";

const BACKEND_URL = process.env.REACT_APP_BACKEND_URL;
const API = `${BACKEND_URL}/api`;

const AdminPanel = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [password, setPassword] = useState("");
  const [messages, setMessages] = useState([]);
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(false);
  const [filter, setFilter] = useState("all");
  const [currentView, setCurrentView] = useState("dashboard");

  // Contraseña simple (en producción usar autenticación real)
  const ADMIN_PASSWORD = "admin123";

  const handleLogin = (e) => {
    e.preventDefault();
    if (password === ADMIN_PASSWORD) {
      setIsAuthenticated(true);
      setPassword("");
    } else {
      alert("Contraseña incorrecta");
    }
  };

  const fetchMessages = async () => {
    setLoading(true);
    try {
      const response = await axios.get(`${API}/contact`);
      setMessages(response.data);
    } catch (error) {
      console.error("Error al cargar mensajes:", error);
    } finally {
      setLoading(false);
    }
  };

  const fetchStats = async () => {
    try {
      const response = await axios.get(`${API}/contact/stats`);
      setStats(response.data);
    } catch (error) {
      console.error("Error al cargar estadísticas:", error);
    }
  };

  const markAsRead = async (messageId, currentStatus) => {
    try {
      const newStatus = currentStatus === "leido" ? "nuevo" : "leido";
      await axios.put(`${API}/contact/${messageId}`, { status: newStatus });
      
      // Actualizar la lista local
      setMessages(prev => prev.map(msg => 
        msg.id === messageId 
          ? { ...msg, status: newStatus, read_at: newStatus === "leido" ? new Date() : null }
          : msg
      ));
      
      // Actualizar estadísticas
      fetchStats();
    } catch (error) {
      console.error("Error al actualizar mensaje:", error);
    }
  };

  const deleteMessage = async (messageId) => {
    if (!window.confirm("¿Estás seguro de que quieres eliminar este mensaje?")) {
      return;
    }
    
    try {
      await axios.delete(`${API}/contact/${messageId}`);
      setMessages(prev => prev.filter(msg => msg.id !== messageId));
      fetchStats();
    } catch (error) {
      console.error("Error al eliminar mensaje:", error);
    }
  };

  useEffect(() => {
    if (isAuthenticated) {
      fetchMessages();
      fetchStats();
    }
  }, [isAuthenticated]);

  const filteredMessages = messages.filter(message => {
    if (filter === "all") return true;
    if (filter === "new") return message.status === "nuevo";
    if (filter === "read") return message.status === "leido";
    return true;
  });

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString("es-ES", {
      year: "numeric",
      month: "short",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit"
    });
  };

  const getServiceLabel = (service) => {
    const services = {
      "web-development": "Desarrollo Web",
      "mobile-development": "App Móvil",
      "ui-ux-design": "UI/UX Design",
      "consulting": "Consultoría",
      "maintenance": "Mantenimiento"
    };
    return services[service] || service;
  };

  if (!isAuthenticated) {
    return (
      <div className="admin-login">
        <div className="admin-login-container">
          <div className="admin-login-card">
            <h2 className="heading-2">Panel de Administración</h2>
            <p className="body-medium">Ingresa la contraseña para acceder</p>
            
            <form onSubmit={handleLogin} className="admin-login-form">
              <div className="form-group">
                <label htmlFor="admin-password" className="form-label">
                  Contraseña
                </label>
                <input
                  type="password"
                  id="admin-password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="form-input"
                  placeholder="Ingresa la contraseña"
                  required
                />
              </div>
              
              <button type="submit" className="btn-primary">
                <span>Acceder</span>
              </button>
            </form>
            
            <p className="admin-login-hint">
              Contraseña de demostración: <code>admin123</code>
            </p>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="admin-panel">
      <div className="dark-content-container">
        <div className="admin-header">
          <div className="admin-header-content">
            <h1 className="display-medium">Panel de Administración</h1>
            <div className="admin-nav">
              <button 
                className={`admin-nav-btn ${currentView === 'dashboard' ? 'active' : ''}`}
                onClick={() => setCurrentView('dashboard')}
              >
                <BarChart3 size={20} />
                Dashboard
              </button>
              <button 
                className={`admin-nav-btn ${currentView === 'messages' ? 'active' : ''}`}
                onClick={() => setCurrentView('messages')}
              >
                <MessageSquare size={20} />
                Mensajes
              </button>
              <button 
                className="admin-logout-btn"
                onClick={() => setIsAuthenticated(false)}
              >
                <ArrowLeft size={20} />
                Salir
              </button>
            </div>
          </div>
        </div>

        {currentView === 'dashboard' && stats && (
          <div className="admin-dashboard">
            <div className="admin-stats-grid">
              <div className="admin-stat-card">
                <div className="admin-stat-icon">
                  <MessageSquare size={32} />
                </div>
                <div className="admin-stat-content">
                  <span className="admin-stat-number">{stats.total_messages}</span>
                  <span className="admin-stat-label">Total de Mensajes</span>
                </div>
              </div>
              
              <div className="admin-stat-card new">
                <div className="admin-stat-icon">
                  <Mail size={32} />
                </div>
                <div className="admin-stat-content">
                  <span className="admin-stat-number">{stats.new_messages}</span>
                  <span className="admin-stat-label">Mensajes Nuevos</span>
                </div>
              </div>
              
              <div className="admin-stat-card read">
                <div className="admin-stat-icon">
                  <Eye size={32} />
                </div>
                <div className="admin-stat-content">
                  <span className="admin-stat-number">{stats.read_messages}</span>
                  <span className="admin-stat-label">Mensajes Leídos</span>
                </div>
              </div>
            </div>
            
            {stats.services_stats && stats.services_stats.length > 0 && (
              <div className="admin-services-stats">
                <h3 className="heading-2">Servicios Más Solicitados</h3>
                <div className="services-stats-list">
                  {stats.services_stats.map((service, index) => (
                    <div key={index} className="service-stat-item">
                      <span className="service-stat-name">
                        {getServiceLabel(service._id)}
                      </span>
                      <span className="service-stat-count">{service.count}</span>
                    </div>
                  ))}
                </div>
              </div>
            )}
          </div>
        )}

        {currentView === 'messages' && (
          <div className="admin-messages">
            <div className="admin-messages-header">
              <div className="admin-filters">
                <button
                  className={`filter-btn ${filter === 'all' ? 'active' : ''}`}
                  onClick={() => setFilter('all')}
                >
                  Todos ({messages.length})
                </button>
                <button
                  className={`filter-btn ${filter === 'new' ? 'active' : ''}`}
                  onClick={() => setFilter('new')}
                >
                  Nuevos ({messages.filter(m => m.status === 'nuevo').length})
                </button>
                <button
                  className={`filter-btn ${filter === 'read' ? 'active' : ''}`}
                  onClick={() => setFilter('read')}
                >
                  Leídos ({messages.filter(m => m.status === 'leido').length})
                </button>
              </div>
            </div>

            {loading ? (
              <div className="admin-loading">
                <p>Cargando mensajes...</p>
              </div>
            ) : (
              <div className="admin-messages-list">
                {filteredMessages.length === 0 ? (
                  <div className="admin-empty">
                    <MessageSquare size={48} />
                    <p>No hay mensajes para mostrar</p>
                  </div>
                ) : (
                  filteredMessages.map((message) => (
                    <div 
                      key={message.id} 
                      className={`admin-message-card ${message.status === 'nuevo' ? 'unread' : 'read'}`}
                    >
                      <div className="admin-message-header">
                        <div className="admin-message-info">
                          <h4 className="admin-message-name">{message.name}</h4>
                          <span className="admin-message-email">{message.email}</span>
                        </div>
                        <div className="admin-message-meta">
                          <span className="admin-message-date">
                            {formatDate(message.created_at)}
                          </span>
                          <span className={`admin-message-status ${message.status}`}>
                            {message.status === 'nuevo' ? 'Nuevo' : 'Leído'}
                          </span>
                        </div>
                      </div>
                      
                      <div className="admin-message-service">
                        <strong>Servicio:</strong> {getServiceLabel(message.service)}
                      </div>
                      
                      <div className="admin-message-content">
                        <p>{message.message}</p>
                      </div>
                      
                      <div className="admin-message-actions">
                        <button
                          className="admin-action-btn read-btn"
                          onClick={() => markAsRead(message.id, message.status)}
                          title={message.status === 'leido' ? 'Marcar como no leído' : 'Marcar como leído'}
                        >
                          {message.status === 'leido' ? <EyeOff size={16} /> : <Eye size={16} />}
                        </button>
                        
                        <a
                          href={`mailto:${message.email}?subject=Re: ${getServiceLabel(message.service)}&body=Hola ${message.name},%0A%0AGracias por contactarme.%0A%0ASaludos,%0ACreaMix-DS`}
                          className="admin-action-btn email-btn"
                          title="Responder por email"
                        >
                          <Mail size={16} />
                        </a>
                        
                        <button
                          className="admin-action-btn delete-btn"
                          onClick={() => deleteMessage(message.id)}
                          title="Eliminar mensaje"
                        >
                          <Trash2 size={16} />
                        </button>
                      </div>
                    </div>
                  ))
                )}
              </div>
            )}
          </div>
        )}
      </div>
    </div>
  );
};

export default AdminPanel;