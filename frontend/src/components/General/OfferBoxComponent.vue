<template>
          <div class="shadow-md p-4 mb-8 bg-white w-full">
            <div class="px-4 flex flex-row justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700 dark:text-white pr-4">
                {{ jobOffer.job_title }}{{ jobOffer.job_country && `, ${jobOffer.job_country}` }}
              </h2>

            
        
         
              <p class="text-xs">
                Posted on the {{ jobOffer.job_posted_at_datetime_utc  && moment(jobOffer.job_posted_at_datetime_utc).format("lll") }}
              </p>
    
            </div>
            <div class="text-base">
              <ReadMore :content="jobOffer.job_description " />
            </div>
            <div >
              <p class="text-xs pb-4 px-4 font-semibold" v-if="jobOffer.job_min_salary && jobOffer.job_max_salary" >
                Salary Estimation: {{ `${jobOffer.job_min_salary}$ - ${jobOffer.job_max_salary}$`}}
              </p>
              <p class="text-xs pb-4 px-4 font-semibold" v-if="jobOffer.salary" >
                Salary: {{ `${jobOffer.salary}$`}}
              </p>
              <p class="text-xs pb-4 px-4 font-semibold" v-if="jobOffer.keywords" >
                  <div class="flex flex-row flex-wrap">
                    <div v-for="keyword in jobOffer.keywords" :key="keyword" class="px-2 py-2 text-xs font-medium leading-none text-center text-purple-400 bg-purple-100 rounded-full mr-2">
                      {{ keyword.name }}
                  </div>
                </div>
              </p>
            </div>
            <div v-if="isRegisteredUser &&  isScrapper" class="flex flex-row ml-4 mb-4">
              <button  @click="createOffer(jobOffer)"  class="py-1 px-8 rounded bg-green-200 flex items-center">Choose</button>
            </div>
            <div v-if="isRegisteredUser && (isScrapper===false)" class="flex flex-row ml-4 my-4 ">
              <button  @click="viewDetail(jobOffer)"  class="rounded-lg shadow text-xs py-2 px-6 bg-gray-100 flex items-center">Candidater pour l'offre</button>
            </div>
            <div class="flex flex-row ml-4 my-4 ">
              <router-link :to="'/offer/' + jobOffer.job_id" class="rounded-lg shadow text-xs py-2 px-6 bg-gray-100 flex items-center">Voir</router-link>
            </div>

            <div v-if="jobOffer.job_apply_link" class="text-xs px-4 font-semibold w-full">
              <p>
                Apply Link : 
                <p class="text-xs text-red-400 truncate ... flex-wrap. w-full" >
                 <a v-bind:href="jobOffer.job_apply_link">
                  {{ jobOffer.job_apply_link }}
                 </a> 
                </p>
              </p>
         
            </div>

            <div class="flex w-full justify-end">
                <div
                  v-if="jobOffer.status && jobOffer.status === 'open'"
                  class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                >
                  ouvert
                </div>
                <div
                  v-if="jobOffer.status && jobOffer.status === 'IN_PROGRESS'"
                  class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                >
                  en cours ...
                </div>
                <div
                  v-if="jobOffer.status && jobOffer.status === 'closed'"
                  class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse"
                >
                  finish
                </div>
            </div>
          </div>
</template>
<script>
import moment from 'moment';
import ReadMore from '../../components/General/ReadMore.vue';
import { isRegisteredUser , getLoggedUser , addCandidate} from '../../stores/usersFunction.js';


 export default {
  name: 'OfferBoxComponent',
  components: {
    ReadMore
  },
  props: {
    jobOffer: {
      type: Object,
      default: () => []
    },
    isScrapper: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      isRegisteredUser: false,
    };
  },
  mounted() {
    this.initialize();
  },
  methods: {
    createOffer(jobOffer) {
      this.$router.push({ name: "scrapper-create-offer-form", query: { offerData: JSON.stringify(jobOffer)} });
    },
    async viewDetail(jobOffer) {
      // await addCandidate()
    },
    moment,
    initialize: async function () {
      const user = await getLoggedUser()
      this.isRegisteredUser = isRegisteredUser(user);
      console.log(this.jobOffer)
    },
  }
};
</script>