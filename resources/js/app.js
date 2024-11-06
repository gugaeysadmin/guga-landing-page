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
        slidesPerView: 3,
        spaceBetween: 40,
        },
        1500: {
            slidesPerView: 5,
            spaceBetween: 40,
        },
    },
});

document.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const logo = document.getElementById("hlogo");
    const navItems= document.querySelectorAll(".hnav-item");
    const scrollY = window.scrollY;

    if (scrollY > 50) { // Cambia el color cuando se haya desplazado más de 50px
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-200');
            navitem.classList.remove('hover:text-white');
            navitem.classList.add('text-gray-500');
            navitem.classList.add('hover:text-sky-500');
            navitem.classList.add('font-semibold');
        });
        navbar.classList.add('bg-slate-50');
        navbar.classList.add('shadow');
        logo.src = "img/logo_normal.png";
    } else {
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-500');
            navitem.classList.remove('hover:text-sky-500');
            navitem.classList.remove('font-semibold');
            navitem.classList.add('text-gray-200');
            navitem.classList.add('hover:text-white');
        });
        navbar.classList.remove('bg-slate-50');
        navbar.classList.remove('shadow');
        logo.src = "img/logo_white.png";
    }
});

// window.onload = function() {
//     const img = document.getElementById('carousel-img');
//     const windowHeight = window.innerHeight; // Altura de la ventana
//     img.style.height = `${windowHeight - 80}px`; // Ajusta la altura de la imagen
// };

// Si deseas que la imagen se ajuste cuando cambie el tamaño de la ventana:
// window.onresize = function() {
//     const img = document.getElementById('carousel-img');
//     const windowHeight = window.innerHeight;
//     img.style.height = `${windowHeight - 80}px`;
// };