import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Subscribe from '../views/Subscribe.vue'
import Products from '../views/Products.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/subscribe',
      name: 'subscribe',
      component: Subscribe
    },
    {
      path: '/products',
      name: 'products',
      component: Products
    }
  ]
})

export default router