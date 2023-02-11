<template>
  <div>
    <Navbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <!-- <VerticalBar /> -->
      <div
        id="main-content"
        class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
      >
        <main>
          <div class="px-4 pt-6 xl:gap-4 dark:bg-gray-900 min-h-screen">
            <div class="mb-4 col-span-full xl:mb-2">
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
              >
                Mon profile
              </h1>
              {{ user }}
            </div>
            <!-- Right Content -->
            <SubscriptionSection
              v-if="
                user.hasOwnProperty('freelance') === true ||
                user.hasOwnProperty('company') === true
              "
              :user="user"
            />
            <InfosProfile
              :type="
                user.hasOwnProperty('freelance') === true
                  ? 1
                  : user.hasOwnProperty('company') === true
                  ? 2
                  : null
              "
            />

            <MyOffers />
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "../../components/General/Sidebar.vue";
import Navbar from "../../components/General/Navbar.vue";
import VerticalBar from "../Navbar/VerticalBar.vue";
import { getUser } from "../../stores/usersFunction";
import requestApi from "../../axios";
import InfosProfile from "./components/InfosProfile.vue";
import Comments from "../../components/General/Comments.vue";
import SubscriptionSection from "./components/SubscriptionSection.vue";
import MyOffers from "./components/MyOffers.vue";

export default {
  data() {
    return {
      user: "",
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
  },
  components: {
    Sidebar,
    Navbar,
    VerticalBar,
    InfosProfile,
    Comments,
    SubscriptionSection,
    MyOffers,
  },
};
</script>
