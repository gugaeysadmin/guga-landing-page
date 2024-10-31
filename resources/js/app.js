import './bootstrap';
import Alpine from 'alpinejs';

import { Tooltip,Carousel, initTWE } from "tw-elements";


initTWE({ Tooltip, Carousel });


window.Alpine = Alpine;

Alpine.start();



import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import { Swiper } from 'swiper';

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'bootstrap-icons/font/bootstrap-icons.css';
// Initialize Swiper

  
const swiper = new Swiper('.swiper', {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: "1",
    centeredSlides: true,
    spaceBetween: 50,
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets:true,
        clickable:true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    autoplay: {
        delay: 2000,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
        slidesPerView: 2,
        spaceBetween: 20,
        },
        1200: {
        slidesPerView: 4,
        spaceBetween: 40,
        },
    },
});

document.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const scrollY = window.scrollY;

    if (scrollY > 50) { // Cambia el color cuando se haya desplazado más de 50px
        navbar.classList.remove('bg-white');
        navbar.classList.add('bg-blue-50');
        navbar.classList.add('bg-opacity-90'); 
    } else {
        navbar.classList.remove('bg-blue-50');
        navbar.classList.remove('bg-opacity-90'); 
        navbar.classList.add('bg-white');
    }
});

window.onload = function() {
    const img = document.getElementById('carousel-img');
    const windowHeight = window.innerHeight; // Altura de la ventana
    img.style.height = `${windowHeight - 80}px`; // Ajusta la altura de la imagen
};

// Si deseas que la imagen se ajuste cuando cambie el tamaño de la ventana:
window.onresize = function() {
    const img = document.getElementById('carousel-img');
    const windowHeight = window.innerHeight;
    img.style.height = `${windowHeight - 80}px`;
};