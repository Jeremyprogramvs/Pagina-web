const carouselSlide = document.getElementById('carousel-slide');
let images = document.querySelectorAll('.carousel-slide img');

let counter = 1; // Iniciar en la primera imagen real
const size = images[0].clientWidth;

// Clonar el primer y último slide
const firstClone = images[0].cloneNode(true);
const lastClone = images[images.length - 1].cloneNode(true);

// Asignar IDs a los clones para diferenciarlos (opcional)
firstClone.id = "firstClone";
lastClone.id = "lastClone";

// Agregar clones al carrusel
carouselSlide.appendChild(firstClone);
carouselSlide.insertBefore(lastClone, images[0]);

// Actualizar la lista de imágenes (incluyendo los clones)
images = document.querySelectorAll('.carousel-slide img');

// Ajustar la posición inicial del carrusel
carouselSlide.style.transform = `translateX(${-size * counter}px)`;

// Botones
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Función para mover el carrusel
function moveCarousel() {
    carouselSlide.style.transition = "transform 0.5s ease-in-out";
    carouselSlide.style.transform = `translateX(${-size * counter}px)`;
}

// Evento para el botón "Next"
nextBtn.addEventListener('click', () => {
    if (counter >= images.length - 1) return; // Evitar sobrepasar el clon
    counter++;
    moveCarousel();
});

// Evento para el botón "Prev"
prevBtn.addEventListener('click', () => {
    if (counter <= 0) return; // Evitar sobrepasar el clon
    counter--;
    moveCarousel();
});

// Evento cuando la transición termina
carouselSlide.addEventListener('transitionend', () => {
    if (images[counter].id === "firstClone") {
        carouselSlide.style.transition = "none"; // Desactivar transición temporalmente
        counter = 1; // Saltar a la primera imagen real
        carouselSlide.style.transform = `translateX(${-size * counter}px)`;
    } else if (images[counter].id === "lastClone") {
        carouselSlide.style.transition = "none"; // Desactivar transición temporalmente
        counter = images.length - 2; // Saltar a la última imagen real
        carouselSlide.style.transform = `translateX(${-size * counter}px)`;
    }
});

// Ajustar el tamaño del carrusel al cambiar el tamaño de la ventana
window.addEventListener('resize', () => {
    const newSize = images[0].clientWidth;
    carouselSlide.style.transform = `translateX(${-newSize * counter}px)`;
});
