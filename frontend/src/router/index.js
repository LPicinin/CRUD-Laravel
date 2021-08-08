import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';

const routes = [{
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/especialidade',
        name: 'Especialidade',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import ( /* webpackChunkName: "about" */ '../views/Especialidade.vue'),
    },
    {
        path: '/medico',
        name: 'Medico',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import ( /* webpackChunkName: "about" */ '../views/Medico.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;