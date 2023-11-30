import { createRouter, createWebHashHistory } from 'vue-router'
import Main from '../views/Main.vue'


const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main
  },
  {
    path: '/booking',
    name: 'UserBooking',
    component: () => import(/* webpackChunkName: "about" */ '../views/UserBooking.vue')
  },
  {
    path: '/about',
    name: 'UserAbout',
    component: () => import(/* webpackChunkName: "about" */ '../views/UserAbout.vue')
  },
  {
    path: '/admin',
    name: 'Admin',
    component: () => import(/* webpackChunkName: "about" */ '../views/Admin.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "about" */ '../views/Register.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "about" */ '../views/Login.vue')
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
