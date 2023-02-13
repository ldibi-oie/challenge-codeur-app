<template>
  <div>
    <Navbar />
    <div class="container px-4 pt-24 mx-auto md:pt-32 lg:px-0 dark:bg-gray-900 flex flex-col items-center">
      <div class="w-full" style="max-width: 700px;">
        <div class="w-full">
          <form class="w-full mt-4 flex flex-row items-center" @submit.prevent="submitForm">
            <div class="flex flex-row w-full">
              <input class="w-full rounded-lg text-base" type="text" placeholder="ex -  Developer in germany 60306, Developer in france paris" v-model="searchQuery"
                id="searchQuery" name="searchQuery" />
              <i class="search icon"></i>
            </div>
            <div class="flex ml-8 mr-2">
              <button type="submit" class="flex-1  py-2 px-4 rounded bg-gray-200 flex items-center">Search</button>
            </div>
          </form>
        </div>
        <div v-if="isLoading" class="flex-1 justify-center items-center flex w-full py-8" style="margin: 0">
          <div class="shadow-md p-4 mb-8">
            <div class="px-4 flex flex-row justify-between">
              <h2 class=" text-xl font-bold text-red-500 dark:text-white">
                Loading...
              </h2>
            </div>
          </div>
        </div>
        <div v-if="!isLoading" class="flex w-full py-8" v-for="jobOffer in jobOffers" :key="jobOffer.job_id" style="margin: 0">
           <OfferBoxComponent :jobOffer="jobOffer" :isScrapper="true"  />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from '../../components/General/Navbar.vue';
import axios from "axios";
import { getRapidApiOptions } from '../../stores/usersFunction';
import storage from '../../stores/storage';
import moment from 'moment';
import OfferBoxComponent from '../../components/General/OfferBoxComponent.vue';


const search = (query, state) => {
  state.isLoading = true;
  axios.request(getRapidApiOptions(query)).then(function (response) {
    console.log("datascrapbro", response.data.data);
    storage.setItem("jobOffers", response.data.data);
    state.jobOffers = response.data.data;
    state.isLoading = false;
  }).catch(function (error) {
    state.isLoading = false;
    console.error(error);
  })
};

export default {
  data() {
    return {
      jobOffers: [],
      searchQuery: "",
      isLoading: false,
    };
  },
  async mounted() {
    try {
      this.isLoading = true;
      const jobs = await storage.getItem("jobOffers") || [];
      this.isLoading = false;
      this.jobOffers = jobs;
      console.log("jobOffers", this.jobOffers);
      if (jobs?.length === 0) {
        search("Python developer in Texas, USA", this);
      }
    } catch (e) {
      console.log("Error Loading jobOffers");
    }
  },
  methods: {
    submitForm: async function () {
      console.log("submitForm", this.searchQuery);
      search(this.searchQuery, this);
    },
    moment,
    createOffer: function (offer) {
    console.log("offer", offer);
    this.$router.push({ name: "scrapper-create-offer-form", query: { offerData: JSON.stringify(offer)}});
  },
  },
  components: { Navbar, OfferBoxComponent },
};

</script>

