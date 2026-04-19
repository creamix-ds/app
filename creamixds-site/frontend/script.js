const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');
const contactForm = document.getElementById('contactForm');
const formStatus = document.getElementById('formStatus');

menuToggle?.addEventListener('click', () => {
  navLinks.classList.toggle('open');
});

document.querySelectorAll('.nav-links a').forEach((link) => {
  link.addEventListener('click', () => navLinks.classList.remove('open'));
});

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });

document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));

contactForm?.addEventListener('submit', async (event) => {
  event.preventDefault();
  formStatus.textContent = 'Enviando consulta...';

  const formData = Object.fromEntries(new FormData(contactForm).entries());

  try {
    const response = await fetch('http://localhost:4000/api/contact', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || 'No se pudo enviar la consulta.');
    }

    formStatus.textContent = 'Consulta enviada correctamente. Revisá el backend para ver el registro.';
    contactForm.reset();
  } catch (error) {
    formStatus.textContent = error.message || 'Ocurrió un error inesperado.';
  }
});
