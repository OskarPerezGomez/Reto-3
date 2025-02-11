import { createRouter, createWebHistory } from 'vue-router'
import userView from '../views/UserView.vue'
import login from "../components/Login.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'userView',
      component: userView,
    },
    {
      path: '/login',
      name: 'login',
      component: login,

    },
  ],
})

export default router
