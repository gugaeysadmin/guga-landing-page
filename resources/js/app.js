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