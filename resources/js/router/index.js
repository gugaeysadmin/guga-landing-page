import { createRouter, createWebHistory } from "vue-router";

import home from '../components/HomePage.vue';
import aboutvue from '../components/AboutPage.vue';
import notFound from '../components/NotfoundPage.vue';
import adminpage from '../components/AdminPage.vue';
import productpage from '../components/ProructPage.vue';
import addproductpage from '../components/AddProductPage.vue'
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
        path: '/app/product',
        component: productpage
    },
    {
        path: '/app/product/add',
        component: addproductpage
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

export default router;
