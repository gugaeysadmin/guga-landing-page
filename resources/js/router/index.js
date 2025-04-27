import { createRouter, createWebHistory } from "vue-router";

import home from '../pages/HomePage.vue';
import aboutvue from '../pages/AboutPage.vue';
import notFound from '../pages/NotfoundPage.vue';
import adminpage from '../pages/AdminPage.vue';
import productpage from '../pages/ProductPage.vue';
import addproductpage from '../pages/AddProductPage.vue'
import promotionpage from '../pages/PromotionsPage.vue'
import enterprisepage from "../pages/EnterprisePage.vue";
import specialityareapage from "../pages/SpecialityAreaPage.vue";
import categoriespage from "../pages/CategoriesPage.vue";

const routes = [
    {
        path: '/app/homevue',
        component: home
    },
    {
        path: '/app/aboutvue',
        component: aboutvue
    },
    {
        path: '/app/nf',
        component: notFound
    },
    {
        path: '/app/admin',
        component: adminpage
    },
    {
        path: '/app/admin/product',
        component: productpage
    },
    {
        path: '/app/admin/product/add',
        component: addproductpage
    },
    {
        path: '/app/admin/promotions',
        component: promotionpage
    },
    {
        path: '/app/admin/enterprise',
        component: enterprisepage
    },
    {
        path: '/app/admin/categories',
        component: categoriespage
    },
    {
        path: '/app/admin/speciality-areas',
        component: specialityareapage
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

export default router;
