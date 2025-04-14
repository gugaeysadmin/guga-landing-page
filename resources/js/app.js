import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

import { Tooltip,Carousel,Collapse, initTWE, Modal } from "tw-elements";
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import Swiper from 'swiper/bundle';

import { createApp } from 'vue';
import mainVue from './app.vue'
import router from './router';

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'bootstrap-icons/font/bootstrap-icons.css';


initTWE({ Tooltip, Carousel, Collapse, Modal });


window.Alpine = Alpine;

Alpine.start();


import header from './components/Header.vue'
import sidebar from './components/SideBar.vue'
import title from './components/Title.vue'
import dinamictable from './components/DynamicTable.vue'
// createApp(app).use(router).mount("#app");

const app = createApp(mainVue)

app.use(router)

app.component('Header', header)
app.component('SideBar', sidebar)
app.component('Title', title)
app.component('DynamicTable', dinamictable)



app.mount('#app')



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
        200: {
            slidesPerView: 1,
            spaceBetween: 2,
        },
        300: {
            slidesPerView: 2,
            spaceBetween: 2,
        },
        640: {
        slidesPerView: 4,
        spaceBetween: 20,
        },
        1200: {
        slidesPerView: 4,
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

// document.addEventListener('scroll', function() {
//     const navbar = document.getElementById('navbar');
//     const contactButton = document.getElementById('contactBtn');
//     const logo = document.getElementById("hlogo");
//     const navItems = document.querySelectorAll(".hnav-item");
//     const scrollY = window.scrollY;

//     if (scrollY > 50) {
//         navItems.forEach(function(navitem) {
//             navitem.classList.remove('text-gray-200', 'hover:text-white');
//             navitem.classList.add('text-gray-500', 'hover:text-sky-500', 'font-semibold');
//         });

//         contactButton.classList.remove("hidden");

//         navbar.classList.add('bg-slate-50', 'shadow');
//         logo.src = "img/logo_normal.png";
//     } else {
//         navItems.forEach(function(navitem) {
//             navitem.classList.remove('text-gray-500', 'hover:text-sky-500', 'font-semibold');
//             navitem.classList.add('text-gray-200', 'hover:text-white');
//         });

//         contactButton.classList.add("hidden");

//         navbar.classList.remove('bg-slate-50', 'shadow');
//         logo.src = "img/logo_white.png";
//     }
// });


// Función para actualizar el navbar según la posición del scroll
function updateNavbar() {
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
        logo.src = "/img/logo_normal.png"; // Asegúrate de usar rutas absolutas
    } else {
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-500', 'hover:text-sky-500', 'font-semibold');
            navitem.classList.add('text-gray-200', 'hover:text-white');
        });

        contactButton.classList.add("hidden");
        navbar.classList.remove('bg-slate-50', 'shadow');
        logo.src = "/img/logo_white.png"; // Asegúrate de usar rutas absolutas
    }
}

// Ejecutar al cargar la página y al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    // Ejecutar inmediatamente al cargar
    updateNavbar();
    
    // También ejecutar después de un pequeño delay para asegurarse
    // de que todo está completamente cargado
    setTimeout(updateNavbar, 100);
});

// Escuchar eventos de scroll
document.addEventListener('scroll', updateNavbar);