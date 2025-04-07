import { createRouter, createWebHistory } from "vue-router";

import home from '../components/HomePage.vue';
import aboutvue from '../components/AboutPage.vue';
import notFound from '../components/NotfoundPage.vue';

const routes = [
    {
        path: '/homevue',
        component: home
    },
    {
        path: '/aboutvue',
        component: aboutvue
    },
    {
        path: '/nf',
        component: notFound
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

export default router;
