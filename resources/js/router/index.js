import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../views/employer/Dashboard.vue';

const routes = [
    {
        path: '/employer/dashboard',
        name: 'Dashboard',
        component: Dashboard,
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
