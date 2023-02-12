import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
import WaitingView from "../views/verify/waiting.vue";
import ProfileView from "../views/Profile/Profile.vue";
import Subscription from "../views/Subscription/Subscription.vue";
import VerificationInfos from "../views/Stepper/Main.vue";
import ErrorPage from "../views/ErrorPage.vue";
import OfferId from "../views/Offer/OfferId.vue";
import AdminRoutes from "./admin.js";
import OfferScrapperView from "../views/OfferScrapper/OfferScrapperView.vue";
import CompanyAddOfferView from "../views/company/form/CompanyAddOfferView.vue";
import OfferScrapperForm from "../views/OfferScrapper/OfferScrapperForm.vue";



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    //companies routes    
    {
      // path: '/company/:id',
      path: '/company',
      name: 'company_edit',
      component: () => import('../views/CompanyView.vue')
    },
    {
      path: '/company/addOffre',
      name: 'company_addOffre',
      component: CompanyAddOfferView
    },
    {
      path: '/company/candidate',
      name: 'company_candidate',
      component: () => import('../views/company/CompanyOfferCandidateView.vue')
    },
    {
      path: '/company/comments',
      name: 'company_comments',
      component: () => import('../views/company/CompanyCommentsView.vue')
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/register",
      name: "register",
      component: RegisterView,
    },
    {
      path: "/verify/waiting",
      name: "waiting",
      component: WaitingView,
    },
    {
      path: "/profile",
      name: "profile",
      component: ProfileView,
    },
    {
      path: "/error",
      name: "error",
      component: ErrorPage,
    },
    {
      path: "/subscription",
      name: "subscription",
      component: Subscription,
    },
    {
      path: "/verify/infos",
      name: "verify_user",
      component: VerificationInfos,
    },
    {
      path: "/offer/:id",
      name: "offerId",
      component: OfferId,
    },
    ...AdminRoutes,
    {
      path: "/scrapper-create-offer",
      name: "scrapper-create-offer",
      component: OfferScrapperView,
    },
    {
      path: "/scrapper-create-offer-form",
      name: "scrapper-create-offer-form",
      component: OfferScrapperForm,
    }
  ],
});

export default router;
