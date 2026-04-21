// ===== SISTEMA DE ANIMACIONES CON SCROLL =====

// Configuración del Intersection Observer
const observerOptions = {
  threshold: 0.1, // El elemento debe estar al menos 10% visible
  rootMargin: "0px 0px -50px 0px", // Margen inferior para que la animación se active antes
};

// Función para manejar las animaciones
function handleIntersection(entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      // Elemento entra en vista - activar animación
      entry.target.classList.add("animate");
    } else {
      // Elemento sale de vista - desactivar animación
      entry.target.classList.remove("animate");
    }
  });
}

// Crear el observer
const observer = new IntersectionObserver(handleIntersection, observerOptions);

// Función para inicializar las animaciones
function initScrollAnimations() {
  // Seleccionar todos los elementos con clases de animación
  const animatedElements = document.querySelectorAll(
    [
      ".animate-on-scroll",
      ".fade-in-up",
      ".fade-in-down",
      ".fade-in-right",
      ".fade-in-left",
      ".scale-in",
      ".hero-title",
    ].join(",")
  );

  // Observar cada elemento
  animatedElements.forEach((element) => {
    observer.observe(element);
  });
}

// Inicializar cuando el DOM esté cargado
document.addEventListener("DOMContentLoaded", initScrollAnimations);

// Función para respetar las preferencias de movimiento reducido
function respectMotionPreferences() {
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
  ).matches;

  if (prefersReducedMotion) {
    // Desactivar todas las transiciones y animaciones
    const style = document.createElement("style");
    style.textContent = `
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        `;
    document.head.appendChild(style);
  }
}

// Aplicar preferencias de movimiento
respectMotionPreferences();

// Función adicional para agregar animaciones a elementos dinámicos
function addScrollAnimation(element, animationType = "fade-in-up") {
  element.classList.add(animationType);
  observer.observe(element);
}

// Función para configurar delays automáticamente
function setupStaggeredAnimations(container, animationClass = "fade-in-up") {
  const elements = container.querySelectorAll("*");
  elements.forEach((element, index) => {
    element.classList.add(animationClass);
    element.classList.add(`delay-${Math.min(index + 1, 6)}`);
    observer.observe(element);
  });
}

// Ejemplo de uso para elementos agregados dinámicamente:
// addScrollAnimation(nuevoElemento, 'fade-in-right');

// Ejemplo de uso para animaciones escalonadas:
// setupStaggeredAnimations(document.querySelector('.cards-container'), 'scale-in');
