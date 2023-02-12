<template>
  <div>
    <Navbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <!-- <VerticalBar /> -->
      <div
        id="main-content"
        class="relative w-full h-full ml-18  overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
      >
        <Sidebar :role="user.roles" @selectOnglet="sendData"/>
        {{ user }}

        <main>
          <div
            class="px-4 pt-6 xl:gap-4 dark:bg-gray-900"
          >
            <div class="mb-4 col-span-full xl:mb-2" >
              <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" v-if="user?.roles?.length === 1" role="alert">
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
                :offers="user.freelance?.offers"
              />
            </div>

            <div v-bind:class="{'hidden' : section != 'projets', '': section === 'projets'}">
              <MyProjects 
                :projets="user.freelance?.offers"
              />
            </div>
            
            <div v-bind:class="{'hidden' : section != 'infos', '': section === 'infos'}">
              <SubscriptionSection 
                v-if="user?.subscriptions?.length > 1"
                :user="user"
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

export default {
  data() {
    return {
      user: "",
      section: "infos"
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
      });
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
    MyComments
},
};
</script>
