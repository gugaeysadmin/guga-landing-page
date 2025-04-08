import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';

import { Tooltip,Carousel,Collapse, initTWE } from "tw-elements";
import { Autoplay, Navigation, Pagination } from 'swiper/modules';
import Swiper from 'swiper/bundle';

import { createApp } from 'vue';
import mainVue from './components/app.vue'
import router from './router';

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'bootstrap-icons/font/bootstrap-icons.css';


initTWE({ Tooltip, Carousel, Collapse });


window.Alpine = Alpine;

Alpine.start();


import header from './components/Header.vue'

// createApp(app).use(router).mount("#app");

const app = createApp(mainVue)

app.use(router)

app.component('Header', header)

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
