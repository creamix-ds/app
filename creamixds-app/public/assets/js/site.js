(function () {
  "use strict";

  /* Menú móvil */
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.getElementById("nav-principal");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", String(open));
    });
    nav.addEventListener("click", function (e) {
      if (e.target.tagName === "A") {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  /* Apariciones al hacer scroll */
  var items = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add("is-in"); io.unobserve(en.target); }
      });
    }, { rootMargin: "0px 0px -12% 0px", threshold: 0.1 });
    items.forEach(function (el) { io.observe(el); });
  } else {
    items.forEach(function (el) { el.classList.add("is-in"); });
  }

  /* Formulario: se envía por fetch. Si el JS falla, el form igual funciona
     porque tiene method="post" y action="/contacto". */
  var form = document.getElementById("contact-form");
  var msg = document.getElementById("form-msg");
  if (!form || !msg) { return; }

  function setMsg(text, state) {
    msg.textContent = text;
    if (state) { msg.setAttribute("data-state", state); }
    else { msg.removeAttribute("data-state"); }
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    var btn = form.querySelector('button[type="submit"]');
    btn.disabled = true;
    setMsg("Enviando…", null);

    fetch(form.action, {
      method: "POST",
      headers: { "Content-Type": "application/json", "Accept": "application/json" },
      body: JSON.stringify({
        _csrf: form._csrf.value,
        nombre: form.nombre.value.trim(),
        email: form.email.value.trim(),
        marca: form.marca.value.trim(),
        servicio: form.servicio.value,
        mensaje: form.mensaje.value.trim(),
        empresa_alt: form.empresa_alt.value
      })
    })
      .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, data: d }; }); })
      .then(function (res) {
        if (res.ok && res.data.ok) {
          form.reset();
          setMsg(res.data.message, "ok");
        } else {
          setMsg(res.data.message || "No se pudo enviar. Intentá de nuevo.", "error");
        }
      })
      .catch(function () {
        setMsg("No se pudo enviar. Escribinos por email y lo resolvemos.", "error");
      })
      .finally(function () { btn.disabled = false; });
  });
})();
