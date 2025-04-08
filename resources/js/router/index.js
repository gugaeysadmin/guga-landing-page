import { createRouter, createWebHistory } from "vue-router";

import home from '../components/HomePage.vue';
import aboutvue from '../components/AboutPage.vue';
import notFound from '../components/NotfoundPage.vue';
import admin from '../components/Admin.vue';
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
        component: admin
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

export default router;
