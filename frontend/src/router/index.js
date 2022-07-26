import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Login from '../views/LoginView.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
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
