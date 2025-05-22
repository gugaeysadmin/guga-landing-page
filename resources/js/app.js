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
import modal from './components/Modal.vue';
import promotionform from './forms/PromotionForm.vue';
import offerttable from './components/OffertTable.vue';
import mainstatistics from './components/home/MainStatistics.vue';
import specareaform from './forms/SpecAreaForm.vue';
import specareatable from './components/specarea/SpecAreaTable.vue';
import categoryform from './forms/CategoryForm.vue';
import categoriestable from './components/category/CategoriesTable.vue';
import categoriessection from './components/category/CategoriesSection.vue';
import catalogsection from './components/category/CatalogSection.vue';
import catalogsectionform from './forms/CatalogSectionForm.vue';
import navsections from './components/enterprise/NavSections.vue';
import alliancestable from './components/enterprise/AlliancesTable.vue';
import brandtable from './components/enterprise/BrandTable.vue';
import pdfaccesorytable from './components/enterprise/PdfAccesoryTable.vue';
import servicestable from './components/enterprise/ServicesTable.vue';
import allianceform from './forms/AllianceForm.vue';
import brandform from './forms/BrandForm.vue';
import serviceform from './forms/ServiceForm.vue';
import accesorypdfform from './forms/AccesoryPdfForm.vue';
import enterpriseform from './forms/EnterpriseForm.vue';
import producttable from './components/product/ProductTable.vue';
import updatespecareaform from './forms/UpdateSpecAreaForm.vue';
import specproducttable from './components/specarea/SpecProductTable.vue';

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';

const app = createApp(mainVue)

app.use(router)

app.component('Header', header);
app.component('SideBar', sidebar);
app.component('Title', title);
app.component('DynamicTable', dinamictable);
app.component('Modal', modal);
app.component('PromotionForm', promotionform);
app.component('OffertTable', offerttable);
app.component('MainStatistics', mainstatistics);
app.component('SpecAreaForm', specareaform);
app.component('SpecAreaTable', specareatable);
app.component('CategoryForm', categoryform);
app.component('CategoriesTable', categoriestable);
app.component('CategoriesSection', categoriessection);
app.component('CatalogSection', catalogsection);
app.component('CatalogSectionForm', catalogsectionform);
app.component('NavSections', navsections);
app.component('AlliancesTable', alliancestable);
app.component('BrandTable', brandtable);
app.component('PdfAccesoryTable', pdfaccesorytable);
app.component('ServicesTable', servicestable);

app.component('AllianceForm', allianceform);
app.component('BrandForm', brandform);
app.component('ServiceForm', serviceform);
app.component('AccesoryPdfForm', accesorypdfform);
app.component('EnterpriseForm', enterpriseform);
app.component('ProductTable',producttable);
app.component('UpdateSpecAreaForm',updatespecareaform);
app.component('SpecProductTable',specproducttable);




app.component('QuillEditor', QuillEditor);







app.mount('#app')



var swiperAux = new Swiper('.swiper1', {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: "4",
    centeredSlides: true,
    spaceBetween: 50,
    pagination: {
        el: ".swiper-pagination1",
        dynamicBullets:true,
        clickable:true,
    },
    navigation: {
        nextEl: ".swiper-button-next1",
        prevEl: ".swiper-button-prev1",
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
            slidesPerView: 1,
            spaceBetween: 2,
        },
        640: {
        slidesPerView: 2,
        spaceBetween: 20,
        },
        1200: {
        slidesPerView: 4,
        spaceBetween: 40,
        },
        1500: {
            slidesPerView: 4,
            spaceBetween: 80,
        },
    },
});

var swiper2 = new Swiper('.swiper2', {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: 2,  // Sin comillas
    centeredSlides: false,  // Cambiado a false para mejor visualización
    spaceBetween: 0,
    loop: true,  // Agregado para mejor experiencia
    pagination: {
        el: ".swiper-pagination2",
        dynamicBullets:false,
        clickable:true,
    },
    navigation: {
        nextEl: ".swiper-button-next2",
        prevEl: ".swiper-button-prev2",
    },
    scrollbar: {
        el: ".swiper-scrollbar1"
    },

    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    breakpoints: {
        200: {
            slidesPerView: 1,
            spaceBetween: 2,
        },
        300: {
            slidesPerView: 1,
            spaceBetween: 2,
        },
        640: {
        slidesPerView: 2,
        spaceBetween: 20,
        },
        1200: {
        slidesPerView: 3,
        spaceBetween: 40,
        },
        1500: {
            slidesPerView: 3,
            spaceBetween: 80,
        },
    }
});

// var swiperAlliances = new Swiper('.swiper-aliances',{
//     modules: [Navigation, Pagination],
//     spaceBetween: 50,
// });

// var swiperThumb= new Swiper(".product-thumb", {
//     loop: true,
//     spaceBetween: 12,
//     slidesPerView: 4,

//     freeMode: true,
//     watchSlidesProgress: true,

// });

// var swiperPrev = new Swiper(".product-prev", {
//     loop: true,
//     spaceBetween: 32,
//     effect: "fade",

//     thumbs: {
//         swiper: swiperThumb,
//     },

// });

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


let modalMostrado = false;
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
        navbar.classList.add('bg-slate-50', 'shadow');
        logo.src = "/img/logo_normal.png";
        if (!modalMostrado) {
            document
                .getElementById('triggerSpecialOffertModal')
                .click();
            modalMostrado = true;
        }

        contactButton.classList.remove("hidden");
    } else {
        navItems.forEach(function(navitem) {
            navitem.classList.remove('text-gray-500', 'hover:text-sky-500', 'font-semibold');
            navitem.classList.add('text-gray-200', 'hover:text-white');
        });

        navbar.classList.remove('bg-slate-50', 'shadow');
        logo.src = "/img/logo_white.png"; // Asegúrate de usar rutas absolutas
        contactButton.classList.add("hidden");
    }
}

function mostrarModal() {
    const scrollY = window.scrollY;
    if (scrollY > 50 && !modalMostrado) {
        document
            .getElementById('triggerSpecialOffertModal')
            .click();
        }
        modalMostrado = true;
}


// Ejecutar al cargar la página y al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    // Verificar si no estamos en la ruta /app
    if (!window.location.pathname.startsWith('/app')) {
        // Ejecutar inmediatamente al cargar
        updateNavbar();

        // También ejecutar después de un pequeño delay
        setTimeout(updateNavbar, 300);
        document.addEventListener('scroll', updateNavbar);
    }
});

// if(!window.location.pathname.startsWith('/app')){
//     // Escuchar eventos de scroll
//     document.addEventListener('scroll', updateNavbar);
// }
