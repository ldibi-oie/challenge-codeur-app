import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
<<<<<<< HEAD
<<<<<<< HEAD
=======
import AdminView from '../views/AdminView.vue'
>>>>>>> develop
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import WaitingView from '../views/verify/waiting.vue'
import ProfileView from '../views/Profile/Profile.vue'
import Subscription from '../views/Subscription/Subscription.vue'
import VerificationInfos from "../views/Stepper/Main.vue"
<<<<<<< HEAD
=======
import CompanyView from '../views/CompanyView.vue'
>>>>>>> 42c52507 (adding the first compagny design)
=======
import ErrorPage from "../views/ErrorPage.vue"
import OfferId from "../views/Offer/OfferId.vue"
>>>>>>> develop

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
<<<<<<< HEAD
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
      path: '/error',
      name: 'error',
      component: ErrorPage
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
      path: '/offer/:id',
      name: 'offerId',
      component: OfferId
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
<<<<<<< HEAD
=======
      path: '/offer',
      name: 'offer',
      component: () => import('../views/offerView.vue')
    },
    {
      path: '/company',
      name: 'company',
      component: CompanyView
>>>>>>> 42c52507 (adding the first compagny design)
    }
=======
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/Admin/PanelView.vue'),
    },
    {
      path: '/admin/form/add',
      name: 'admin_form_add',
      component: () => import('../components/Admin/Form.vue'),
    },
    {
      path: '/admin/form/edit/:id',
      name: 'admin_form_edit',
      component: () => import('../components/Admin/Form.vue'),
    },
>>>>>>> develop
  ]
})

export default router
