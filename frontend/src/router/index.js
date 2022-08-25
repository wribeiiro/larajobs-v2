import { createRouter, createWebHistory } from 'vue-router';
import LandingView from '../views/LandingView.vue';
import Login from '../views/LoginView.vue';
import Register from '../views/RegisterView.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: LandingView
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    }
]

const router = createRouter({
    linkExactActiveClass: 'active',
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
