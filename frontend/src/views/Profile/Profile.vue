<template>
  <div>
    <Navbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <!-- <VerticalBar /> -->
      <div
        id="main-content"
        class="relative w-full h-full ml-18  overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
      >
        <Sidebar :role="user?.roles" @selectOnglet="sendData"/>

        <main>
          <div
            class="px-4 pt-6 xl:gap-4 dark:bg-gray-900"
          >
            <div class="mb-4 col-span-full xl:mb-2" >
              <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" v-if="user?.subscriptions?.length === 0" role="alert">
                <span class="font-medium">Mode basic user!</span> Sourcrivez a un abonnement Prenium Freelance ou Company pour commencer vos premiers projets 
              </div>
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
              >
                Mon profile - {{ section }}
              </h1>
            </div>
            <!-- Right Content -->
            
            <div v-bind:class="{'hidden' : section != 'offres', '': section === 'offres'}">
              <MyOffers 
              :user="user"
              :offers="offers"
              />
            </div>

            <div v-bind:class="{'hidden' : section != 'projets', '': section === 'projets'}">
              <MyProjects 
                :projets="offers"
              />
            </div>
            
            <div v-bind:class="{'hidden' : section != 'infos', '': section === 'infos'}">
              <SubscriptionSection 
                v-if="user?.subscriptions?.length === 0"
                :user="user"
                :type="user.hasOwnProperty('freelance') === true ? 'freelances' :
                  user.hasOwnProperty('company') === true ? 'companies' : null"
              />

              <InfosProfile 
                :type="user.hasOwnProperty('freelance') === true ? 1 :
                user.hasOwnProperty('company') === true ? 2 : null"
                :user="user"
              />
            </div>

            <div v-bind:class="{'hidden' : section != 'evaluations', '': section === 'evaluations'}">
              <MyComments 
              />
            </div>

            <div v-bind:class="{'hidden' : section != 'Ajouter une offre', '': section === 'Ajouter une offre'}">
              <AddOffer />
            </div>
            
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "../../components/General/Sidebar.vue";
import Navbar from "../../components/General/Navbar.vue";
import { getUser } from "../../stores/usersFunction";
import InfosProfile from "./components/InfosProfile.vue";
import SubscriptionSection from "./components/SubscriptionSection.vue";
import MyOffers from "./components/MyOffers.vue";
import MyProjects from "./components/MyProjects.vue";
import MyComments from "./components/MyComments.vue";
import AddOffer from "./components/AddOffer.vue"
import { fetchOffers } from "../../stores/offers";
const ROLE_FREELANCER = "ROLE_FREELANCER"
const ROLE_COMPANY = "ROLE_COMPANY"

export default {
  data() {
    return {
      user: "",
      section: "infos",
      offers: []
    };
  },
  mounted() {
    this.getUserRequest();
  },
  methods: {
    getUserRequest: async function () {
      getUser().then((r) => {
        console.log(r);
        this.user = r[0];
        this.getOffersById();
      });

    },

    getOffersById: async function() {  
      const id = this.user && this.user?.company ? this.user?.company?.id : 
        this.user && this.user?.freelance ? this.user?.freelance?.id : null
      console.log('cherche offer pour id ' + id);
      await fetchOffers({
          company_id: id
      }).then((response) => {
          this.offers = response
          console.log(this.offers)
      })
    },

    sendData(data) {
      this.section = data
    }
  },
  components: {
    Sidebar,
    Navbar,
    InfosProfile,
    SubscriptionSection,
    MyOffers,
    MyProjects,
    MyComments,
    AddOffer
},
};
</script>
