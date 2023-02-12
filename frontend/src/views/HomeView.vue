<!-- This example requires Tailwind CSS v3.0+ -->
<template>
  <div class="isolate bg-white">
    <div
      class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
    >
      <svg
        class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]"
        viewBox="0 0 1155 678"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill="url(#45de2b6b-92d5-4d68-a6a0-9b9b2abad533)"
          fill-opacity=".3"
          d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z"
        />
        <defs>
          <linearGradient
            id="45de2b6b-92d5-4d68-a6a0-9b9b2abad533"
            x1="1155.49"
            x2="-78.208"
            y1=".177"
            y2="474.645"
            gradientUnits="userSpaceOnUse"
          >
            <stop stop-color="#9089FC" />
            <stop offset="1" stop-color="#FF80B5" />
          </linearGradient>
        </defs>
      </svg>
    </div>
    <Navbar />
    <main class="flex flex-col items-center">
      <div class="relative  max-w-5xl">
        <section v-if="isCompany" class="dark:bg-gray-900 w-full px-6 pt-12">
          <div class="px-4 mx-auto max-w-screen-xl sm:py-8 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
              <h2
                class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
              >
                Trouvez un freelance rapidement
              </h2>
              <p class="text-gray-500 sm:text-xl dark:text-gray-400">
                Postez votre projet pour être mis en relation avec les nombreux
                freelances disponibles
              </p>
            </div>
            <div
              class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0"
            >
              <div>
                <div
                  class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-red-100 lg:h-12 lg:w-12 dark:bg-red-900"
                >
                  <svg
                    class="w-5 h-5 text-red-600 lg:w-6 lg:h-6 dark:text-red-300"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Simple</h3>
                <p class="text-gray-500 dark:text-gray-400">
                  Décrivez votre projet en quelques mots sur la plateforme
                </p>
              </div>
              <div>
                <div
                  class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-red-100 lg:h-12 lg:w-12 dark:bg-red-900"
                >
                  <svg
                    class="w-5 h-5 text-red-600 lg:w-6 lg:h-6 dark:text-red-300"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"
                    ></path>
                  </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Rapide</h3>
                <p class="text-gray-500 dark:text-gray-400">
                  Recevez une dizaine de devis en quelques minutes
                </p>
              </div>

              <div>
                <div
                  class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-red-100 lg:h-12 lg:w-12 dark:bg-red-900"
                >
                  <svg
                    class="w-5 h-5 text-red-600 lg:w-6 lg:h-6 dark:text-red-300"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Gratuit</h3>
                <p class="text-gray-500 dark:text-gray-400">
                  Choisissez le freelance idéal pour votre projet, sans
                  obligation
                </p>
              </div>
            </div>
          </div>
        </section>

        <div
          class="w-full absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-130rem)]"
        >
          <svg
            class="relative left-[calc(50%+3rem)] h-[21.1875rem] max-w-none -translate-x-1/2 sm:left-[calc(50%+36rem)] sm:h-[42.375rem]"
            viewBox="0 0 1155 678"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill="url(#ecb5b0c9-546c-4772-8c71-4d3f06d544bc)"
              fill-opacity=".3"
              d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z"
            />
            <defs>
              <linearGradient
                id="ecb5b0c9-546c-4772-8c71-4d3f06d544bc"
                x1="1155.49"
                x2="-78.208"
                y1=".177"
                y2="474.645"
                gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#9089FC" />
                <stop offset="1" stop-color="#FF80B5" />
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>
      <h5
        v-if="isCompany"
        class="pt-32 mb-4 mx-5 px-6 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white"
      >
        Nos principaux métiers
      </h5>

      <h5
        v-if="!isCompany"
        class="pt-32 mb-4 mx-5 px-6 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white"
      >
       Nos offres pour vous
      </h5>

      <div class="flex px-6 flex-row  w-full max-w-5xl my-10">
        <div class="px-3 w-64 rounded">
          <list-group>
            <div
              class="flex items-center justify-center h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
              v-if="categories.length === 0"
            >
              <div
                class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200"
              >
                loading...
              </div>
            </div>
            <list-group-item
              v-for="category in categories"
              :key="category['@id']"
              @click="selectCategory(category.id)"
            >
              <template #prefix>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"
                  />
                </svg>
              </template>
              {{ category?.name }}
            </list-group-item>
          </list-group>
        </div>
        <div
          v-if="offers.length === 0  || isLoading"
          class="flex w-full items-center justify-center  h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        >
          <div
          v-if="offers.length === 0 && !isLoading"
            class="px-3 py-1 text-lg font-medium leading-none text-center text-black  rounded-full"
          >
            Aucune offre disponible pour le moment
          </div>
          <div
          v-if="isLoading"
            class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200"
          >
            loading...
          </div>
        </div>
      
        <div class="flex flex-col w-full" v-if="offersFilter.length > 0 && !isLoading">
          <div v-for="offer in offersFilter" :key="offer['@id']">
            <OfferBoxComponent :jobOffer="{
              job_id: offer.id,
              job_title: offer.title,
              job_description: offer.description,
              salary: offer.salary,
              job_posted_at_datetime_utc: offer.createdAt,
              status: offer.status,
              job_apply_link: offer.jobUrl,
              keywords: offer.keywords,
            }" />
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
<script setup>
import { ListGroup, ListGroupItem } from "flowbite-vue";
</script>
<script>
import moment from "moment";
import Navbar from "../components/General/Navbar.vue";
import { getCategories, getLoggedUser, isCompany } from "../stores/usersFunction";
import { fetchOffers } from "../stores/offers";
import OfferBoxComponent from "../components/General/OfferBoxComponent.vue";
import storage from "../stores/storage";
moment.locale("fr");

export default {
  data() {
    return {
      user: "",
      userId: "",
      categories: [],
      offers: [],
      offersFilter: [],
      isLoading: false,
      isLoadingCategories: false,
      isCompany: false,
    };
  },
  mounted() {
    this.getCategoriesRequest();
    getLoggedUser().then((data) => {
      this.user = data;
      this.userId = data?.id;
      console.log("dataherebro", data)
      this.isCompany = data === null ? isCompany(data) : false;
    })
  },
  methods: {
    getCategoriesRequest: async function () {
      this.isLoadingCategories = true;
      const storedCategories  = await storage.getItem("categories");
      if(storedCategories){
        this.categories = storedCategories;
        this.getOffersRequest();
        return;
      }else{
        await getCategories().then((data) => {
        this.isLoadingCategories = false;
        this.categories = data;
        storage.setItem("categories", data);
        this.getOffersRequest();
      });
      }
     
    },
    getOffersRequest: async function (category_id) {
      this.isLoading = true;
      await fetchOffers({
        category: category_id !== 1 && category_id || ""
      }).then((data) => {
        this.isLoading = false;
        console.log("datahere", data)
        this.offers = data;
        this.offersFilter = data;
      });
      console.log(this.categories);
    },

    selectCategory(category) {
      console.log("category_id", category);
      this.getOffersRequest(category).then((res)=>{
        console.log(res);
      })
    },
  },
  components: { Navbar, OfferBoxComponent },
};
</script>
