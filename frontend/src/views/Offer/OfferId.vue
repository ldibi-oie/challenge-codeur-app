<template>
  <div>
    <Navbar />
    <div style="max-width: 950px;" class="container px-4 pt-24 mx-auto md:pt-32 lg:px-0 dark:bg-gray-900 flex flex-col items-center">
      <div class="flex flex-row w-full">

          <div  class="w-full">
           <div  class="w-full" v-if="offer && !loading">
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
           <div v-if="loading" class="flex flex-col items-center shadow-md p-4 mb-8 bg-white" style="min-height: 250px;">
              <div
              
                class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200"
              >
                loading...
              </div>
          </div>
          </div>
          <!-- candidates profile with user avatar -->
          <div style="min-width: 250px;" v-if="isCompany">
            <div class="flex flex-col shadow ml-4">
              <div class="w-full">
                <div v-for="candidate in candidates" :key="candidate.id" class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex p-4 w-8 h-8 mx-4 rounded-full items-center justify-center  rounded-full text-purple-700 bg-gray-200" >
                  <p>{{ candidate.name[0] }}{{ candidate.surname[0] }}</p>
                </div>
                <div class="flex flex-row items-center">
                  <p>{{ candidate.name }} {{ candidate.surname }}</p>
                </div>
              </div>

              <div v-if="!loading">
                <button class="w-full flex flex-row items-center justify-end px-2 py-2 text-xs font-medium mr-2">
                  <div class="flex flex-row items-center">
                    <p class="text-purple-700">Select candidate</p>
                  </div>
                  <div class="flex p-4 w-4 h-4 mx-4 rounded-full items-center justify-center  rounded-full text-purple-700 bg-purple-200" >
                    <p>&#xbb;</p>
                  </div>
                </button>
              </div>

              </div>
            
              <div >
                <div v-if="candidates?.length === 0" class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                  <div class="flex flex-row items-center">
                    <p>No candidates yet</p>
                  </div>
                </div>
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
import OfferBoxComponent from "../../components/General/OfferBoxComponent.vue";
import { getOffersCommentsByOfferId, getOffersCandidatesByOfferId, isCompany, getLoggedUser } from "../../stores/usersFunction";

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
      comments: null,
      candidates: null,
      isCompany: false,
      user: null,
      newcomment: ""
    };
  },
  mounted() {
    this.initialize();
  },
  methods: {
    async initialize() {
      this.loading = true;
      await fetchOffer(this.$route.params.id, this);
      console.log("offerhere", this.offer)
      //get offer comments by id
      this.comments = await getOffersCommentsByOfferId({ offer_id: this.$route.params.id });
      console.log("this.comments", this.comments);
      //get offer candidates by id
      this.candidates = (await getOffersCandidatesByOfferId({ id: this.$route.params.id })).slice(0, 5); //slice to get only 5 candidates
      console.log("this.candidates", this.candidates);
      this.user = await getLoggedUser();
      this.isCompany = isCompany(this.user);
      this.loading = false;
    },
  },
  components: {
    Navbar,
    OfferBoxComponent,
  },
};
</script>
