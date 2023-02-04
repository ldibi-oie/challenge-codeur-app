<template>
  <div>
    <Navbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <!-- <VerticalBar /> -->
      <div
        class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 hidden"
        id="sidebarBackdrop"
      >dededde</div>

      <div
        id="main-content"
        class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900"
      >
        <main>
          <div
            class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900"
          >
            <div class="mb-4 col-span-full xl:mb-2">
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
              >
                Mon profile
              </h1>
            </div>
            <!-- Right Content -->
            <SubscriptionSection />
            <InfosProfile />
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

export default {
  data() {
    return {
      user: "",
      userId: "",
    };
  },
  mounted() {
    // this.getUserRequest
  },
  methods: {
    getUserRequest: async function () {
      await getUser().then((r) => {
        this.user = r;
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
  },
};
</script>
