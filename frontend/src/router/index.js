import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AdminView from '../views/AdminView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import WaitingView from '../views/verify/waiting.vue'
import ProfileView from '../views/Profile/Profile.vue'
import Subscription from '../views/Subscription/Subscription.vue'
import VerificationInfos from "../views/Stepper/Main.vue"
import CompanyView from '../views/CompanyView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/verify/waiting',
      name: 'waiting',
      component: WaitingView
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfileView
    },
    {
      path: '/subscription',
      name: 'subscription',
      component: Subscription
    },
    {
      path: '/verify/infos',
      name: 'verify_user',
      component: VerificationInfos
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
      path: '/offer',
      name: 'offer',
      component: () => import('../views/offerView.vue')
    },
    {
      path: '/company',
      name: 'company',
      component: CompanyView
    }
  ]
})

export default router
