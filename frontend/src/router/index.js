import { createRouter, createWebHistory } from 'vue-router';
import LandingView from '../views/LandingView.vue';
import Login from '../views/LoginView.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: LandingView
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  }
]

const router = createRouter({
  linkExactActiveClass: 'active',
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
