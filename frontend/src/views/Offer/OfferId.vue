<template>
  <div>
    <Navbar />
    <div v-if="loading" class="fixed min-h-screen top-0 left-0 right-0 z-50 py-64 overflow-x-hidden overflow-y-auto md:inset-0 bg-gray-800/70">
      <div class="relative w-full h-full max-w-md mx-auto">
        <div
            role="status"
            class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
          <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
    <div v-else class="p-4 h-min-screen">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mx-14">
        <div class="mb-4">
          <div class="flex flex-col h-32 rounded bg-white dark:bg-gray-800 p-4 space-y-3">
            <h2 class="text-2xl font-semibold text-center">{{ offer.title }}</h2>
            <div class="flex items-center justify-start">
              <div>
                <div v-if="offer.status == 'open'" class="flex items-center space-x-2">
                  <svg class="w-4 h-4 text-green-600 bg-green-300 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-green-600">Ouvert</span>
                </div>
                <div v-else class="flex items-center space-x-2">
                  <svg class="w-4 h-4 text-red-600 bg-red-300 rounded-full" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                  <span class="text-red-600">Fermé</span>
                </div>
              </div>
            </div>
            <div class="flex items-center space-x-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
              </svg>
              <span>{{ offer.candidates.length }} Offres</span>
            </div>
          </div>
        </div>
        <div class="p-6 min-h-fit mb-4 rounded bg-gray-50 dark:bg-gray-800">
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">Description de l'offre</h3>
          <p class="text-gray-600">{{ offer.description }}</p>
        </div>
        <div class="p-6 min-h-fit mb-4 rounded bg-gray-50 dark:bg-gray-800">
          <div class="flex flex-col">
            <div>
              <span class="font-semibold">Budget indicatif : </span>{{ offer.salary }} €
            </div>
            <div>
              <span class="font-semibold">Date de publication : </span>{{ offer.createdAt }}
            </div>
            <div>
              <span class="font-semibold">Créer par : </span>{{ offer.company.name }}
            </div>
          </div>
        </div>
        <div v-if="offer.selectedCandidate.length != 0" class="p-6 min-h-fit mb-4 rounded bg-green-100 dark:bg-gray-800" >
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">Candidat sélectionné</h3>
          <div class="text-gray-600 capitalize">{{ offer.selectedCandidate.name }} {{ offer.selectedCandidate.surname }}</div>
        </div>
        <div class="p-4 min-h-fit mb-4 rounded bg-gray-50 dark:bg-gray-800">
          <div>
            <div class="flex items-center space-x-2 text-base">
              <h3 class="font-semibold text-slate-900">Candidatures : </h3>
              <span
                  class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-700">{{ offer.candidates.length }}</span>
            </div>
            <div class="mt-3 flex -space-x-2 Budget indicatifoverflow-hidden p-4">
              <div v-for="candidate in offer.candidates" :key="candidate.name" class="bg-red-800 text-white h-12 w-12 rounded-full ring-2 ring-white flex items-center justify-center">
                  <span class="text-2xl font-medium">{{  candidate.name.charAt(0) }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-start items-baseline min-h-fit mb-4 rounded bg-gray-50 p-4">
          <h3 class="text-base font-semibold text-gray-900 dark:text-white">Mots clés :</h3>
          <div class="flex flex-wrap">
            <div v-for="tag in offer.keywords" :key="tag" class="px-2 py-1 text-xs font-semibold text-gray-600 bg-gray-200 rounded-full ml-2 mb-2">
              {{ tag.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { fetchOffer } from "../../stores/offers";
import Navbar from "../../components/General/Navbar.vue";

export default {
  name: "OfferId",
  components: {
    Navbar
  },
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
};
</script>
