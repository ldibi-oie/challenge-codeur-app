<template>
  <Navbar />
  <div class="container mx-auto dark:bg-gray-900">
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
      <div role="status" class="" v-if="!offer">
        <svg
          aria-hidden="true"
          class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
          viewBox="0 0 100 101"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
            fill="currentColor"
          />
          <path
            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
            fill="currentFill"
          />
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
      <div
        v-if="offer"
        id="main-content"
        class="relative w-full max-w-screen-2xl mx-auto h-full overflow-y-auto bg-gray-50 dark:bg-gray-900"
      >
        <main>
          <div
            class="grid grid-rows-1 px-4 pt-6 xl:grid-cols-3 xl:px-0 xl:gap-4 dark:bg-gray-900"
          >
            <div class="mb-4 col-span-full xl:mb-2">
              <h1
                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
              >
                {{ offer?.title }}
              </h1>
              {{ offer }}
            </div>
            <!-- Right Content -->
            <div
              v-if="offer?.selectedCandidate?.length > 1"
              v-bind:class="{
                ' col-span-full xl:col-auto ':
                  offer.selectedCandidate?.length > 0,
                hidden: offer?.selectedCandidate?.length === 0,
              }"
            >
              <div
                class="p-4 mb-4 space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
              >
                <div class="px-4 py-2">
                  <h3
                    class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white"
                  >
                    <img
                      src="../../assets/img/king-svgrepo-com.svg"
                      alt=""
                      style="width: 40px"
                    />

                    Le freelance selectionné
                  </h3>
                </div>
                <div class="h-32 px-4 py-2">
                  <h3>{{ offer?.selectedCandidate }}</h3>
                </div>
                <div class="px-4 py-2"></div>
              </div>
            </div>
            <div class="col-span-2">
              <div
                class="p-4 mb-4 space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
              >
                <div class="flex flex-row items-center">
                  <div
                    v-if="offer.status === 'open'"
                    class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                  >
                    ouvert
                  </div>
                  <div
                    v-if="offer.status === 'IN_PROGRESS'"
                    class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                  >
                    en cours ...
                  </div>
                  <div
                    v-if="offer.status === 'closed'"
                    class="px-3 py-1 text-xs font-medium leading-none text-center text-purple-800 bg-purple-200 rounded-full animate-pulse dark:bg-purple-900 dark:text-purple-200"
                  >
                    finish
                  </div>
                  <h3 class="mx-3">
                    {{ offer?.title }}
                  </h3>
                </div>
                <div class="h-32 px-4 py-2">
                  <h3>{{ offer?.description }}</h3>
                </div>
                <div class="px-4 py-2">
                  <h3>Tarification : {{ offer?.salary }} €</h3>
                </div>
                <div class="px-4">
                  <h3>Category: {{ offer?.category }}</h3>
                </div>
                <div class="px-4 py-2">
                  <h3>Mots cles :</h3>
                  <ul>
                    <li v-for="item in offer.keywords" v-bind:key="item.id">
                      <span> {{ item }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div
            v-if="offer?.candidates"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800"
          >
            <h3
              class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white"
            >
              Les candidatures
            </h3>
            <div
              data-popover=""
              id="popover-description"
              role="tooltip"
              class="absolute z-10 inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 opacity-0 invisible"
              style="
                position: absolute;
                inset: 0px auto auto 0px;
                margin: 0px;
                transform: translate(221.111px, 731.111px);
              "
              data-popper-placement="bottom-start"
            >
              <div class="p-3 space-y-2"></div>
              <div
                data-popper-arrow=""
                style="
                  position: absolute;
                  left: 0px;
                  transform: translate(6.66667px, 0px);
                "
              ></div>
            </div>
            <div
              id="fullWidthTabContent"
              class="border-t border-gray-200 dark:border-gray-600"
            >
              <div
                class="pt-4"
                id="faq"
                role="tabpanel"
                aria-labelledby="faq-tab"
              >
                <ul
                  role="list"
                  class="divide-y divide-gray-200 dark:divide-gray-700"
                >
                  <li
                    class="py-3 sm:py-4"
                    v-for="item in offer?.candidates"
                    v-bind:key="item.id"
                  >
                    <div class="flex items-center justify-between">
                      <div class="flex items-center min-w-0">
                        <!-- <img class="flex-shrink-0 w-10 h-10" src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png" alt="imac image"> -->
                        <div class="ml-3">
                          <p
                            class="font-medium text-gray-900 truncate dark:text-white"
                          >
                            {{ item }}
                          </p>
                          <span class="ml-2 text-gray-500"> user email </span>
                        </div>
                      </div>
                      <div
                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                      >
                        Publie
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Card Footer -->
          </div>
          <!-- <div class="grid gap-4 px-4 mb-4 md:grid-cols-2 xl:grid-cols-4 xl:px-0">
                <div class="p-4 space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="px-4 py-2 ">
                        <h3>{{offer.title}}</h3>
                    </div>
                    <div class="h-32 px-4 py-2 ">
                        <h3>{{offer.description}}</h3>
                    </div>
                    <div class="px-4 py-2 ">
                        <h3>Card footer</h3>
                    </div>
                </div>
            </div> -->
        </main>
      </div>
      <div
        class="p-6 min-h-fit mb-4 rounded bg-green-100 dark:bg-gray-800"
        v-if="offer.selectedCandidate.length != 0"
      >
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
          Candidat sélectionné
        </h3>
        <div class="text-gray-600">{{ offer.selectedCandidate }}</div>
      </div>
      <div
        class="flex items-center justify-start h-48 mb-4 rounded bg-gray-50 p-4"
        v-else
      >
        <div>
          <div class="flex items-center space-x-2 text-base">
            <h4 class="font-semibold text-slate-900">Candidatures :</h4>
            <span
              class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700"
              >{{ offer.candidates.length }}</span
            >
          </div>
          <div class="mt-3 flex -space-x-2 Budget indicatifoverflow-hidden">
            <img
              v-for="candidate in offer.candidates"
              :key="candidate.id"
              class="inline-block h-12 w-12 rounded-full ring-2 ring-white"
              src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt=""
            />
          </div>
        </div>
      </div>
      <div
        class="flex flex-col items-start justify-center h-48 mb-4 rounded bg-gray-50 p-4"
        v-if="offer.comments.length != 0"
      >
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
          Commentaires
        </h3>
        <div class="flex flex-col space-y-4">
          <div v-for="comment in offer.comments" :key="comment.id">
            <div class="flex flex-col">
              <div>
                <span class="font-semibold">Posté par : </span>{{ comment }}
              </div>
              <div>
                <span class="font-semibold">Commentaire : </span>{{ comment }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="rounded-full bg-red-800 text-white p-6 first-letter:hidden w-12 h-12 flex items-center justify-center">
            <span class="text-2xl font-bold">{{ firstLetter('offer.title') }}</span>
        </div> -->
    </div>
  </div>
</template>
<script>
import { fetchOffer } from "../../stores/offers";

export default {
  name: "OfferId",
  data() {
    return {
      offer: null,
      error: null,
      loading: false,
    };
  },
  created() {
    this.fetchOffer();
  },
  methods: {
    async fetchOffer() {
      await fetchOffer(this.$route.params.id, this);
    },
  },
  // computed: {
  //     firstLetter(word) {
  //         return word.toString().charAt(0).toUpperCase();
  //     }
  // }
};
</script>
