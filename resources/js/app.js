import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

import { Tooltip,Carousel,Collapse, initTWE } from "tw-elements";
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import Swiper from 'swiper/bundle';

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'bootstrap-icons/font/bootstrap-icons.css';


initTWE({ Tooltip, Carousel, Collapse });


window.Alpine = Alpine;

Alpine.start();



var swiperAux = new Swiper('.swiper', {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: "4",
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

var swiperAlliances = new Swiper('.swiper-aliances',{
    modules: [Navigation, Pagination],
    spaceBetween: 50,
});
var swiperThumb= new Swiper(".product-thumb", {
    loop: true,
    spaceBetween: 12,
    slidesPerView: 4,
    
    freeMode: true,
    watchSlidesProgress: true,
   
});
var swiperPrev = new Swiper(".product-prev", {
    loop: true,
    spaceBetween: 32,
    effect: "fade",
   
    thumbs: {
        swiper: swiperThumb,
    },
    
});
// document.addEventListener('DOMContentLoaded', function () {

//     if (window.location.pathname === '/') {
//         return;
//     }

//     const navbar = document.getElementById('navbar');
//     const logo = document.getElementById("hlogo");
//     const navItems = document.querySelectorAll(".hnav-item");
//     navItems.forEach(function(navitem) {
//         navitem.classList.remove('text-gray-500');
//         navitem.classList.remove('hover:text-sky-500');
//         navitem.classList.remove('font-semibold');
//         navitem.classList.add('text-gray-200');
//         navitem.classList.add('hover:text-white');
//     });
//     navbar.classList.remove('bg-slate-50');
//     navbar.classList.remove('shadow');
//     logo.src = "img/logo_white.png";

// });


// document.addEventListener('scroll', function() {
//     // if (window.location.pathname !== '/') {
//     //     return;
//     // }

//     const navbar = document.getElementById('navbar');
//     const contactButton = document.getElementById('contactBtn');
//     const logo = document.getElementById("hlogo");
//     const navItems= document.querySelectorAll(".hnav-item");
//     const scrollY = window.scrollY;

//     if (scrollY > 50) { // Cambia el color cuando se haya desplazado más de 50px
//         navItems.forEach(function(navitem) {
//             navitem.classList.remove('text-gray-200');
//             navitem.classList.remove('hover:text-white');
//             navitem.classList.add('text-gray-500');
//             navitem.classList.add('hover:text-sky-500');
//             navitem.classList.add('font-semibold');
//         });
//         contactButton.classList.remove('hidden');
//         contactButton.classList.remove("translate-x-full");
//         contactButton.classList.add("translate-x-0");
//         navbar.classList.add('bg-slate-50');
//         navbar.classList.add('shadow');
//         logo.src = "img/logo_normal.png";
//     } else {
//         navItems.forEach(function(navitem) {
//             navitem.classList.remove('text-gray-500');
//             navitem.classList.remove('hover:text-sky-500');
//             navitem.classList.remove('font-semibold');
//             navitem.classList.add('text-gray-200');
//             navitem.classList.add('hover:text-white');
//         });
//         contactButton.classList.add('hidden');
//         contactButton.classList.remove("translate-x-0");
//         contactButton.classList.add("translate-x-full");
//         navbar.classList.remove('bg-slate-50');
//         navbar.classList.remove('shadow');
//         logo.src = "img/logo_white.png";
//     }
// });

document.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const contactButton = document.getElementById('contactBtn');
    const logo = document.getElementById("hlogo");
    const navItems = document.querySelectorAll(".hnav-item");
    const scrollY = window.scrollY;

    if (scrollY > 50) {
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-200', 'hover:text-white');
            navitem.classList.add('text-gray-500', 'hover:text-sky-500', 'font-semibold');
        });

        contactButton.classList.remove("hidden");

        navbar.classList.add('bg-slate-50', 'shadow');
        logo.src = "img/logo_normal.png";
    } else {
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-500', 'hover:text-sky-500', 'font-semibold');
            navitem.classList.add('text-gray-200', 'hover:text-white');
        });

        contactButton.classList.add("hidden");

        navbar.classList.remove('bg-slate-50', 'shadow');
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