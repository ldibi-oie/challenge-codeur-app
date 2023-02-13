<template> 
    <CompayVertBar /> 
        <div class="p-4 sm:ml-64">
          <div class="flex flex-col  p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                
            <div v-for="item in offers" class="grid w-full md:grid-cols-2">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Offres</h5>
                    </a>
                    <div >
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                            <span class="text-2xs font-bold tracking-tight text-gray-900 dark:text-white"> Titre :</span> {{ item.title }}</div>
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                            <span class="text-2xs font-bold tracking-tight text-gray-900 dark:text-white"> Description :</span> {{ item.description }}</div>
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                            <span class="text-2xs font-bold tracking-tight text-gray-900 dark:text-white"> Salaire :</span>  {{ item.salary }} </div>
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                            <span class="text-2xs font-bold tracking-tight text-gray-900 dark:text-white"> Status :</span> {{ item.status }} {{ item.id }} </div>
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                            <p v-if="item.selectedCandidate" class="text-2xs font-normal tracking-tight text-gray-900 dark:text-white"> Offre déjà attribué. </p></div>
                    </div>
                        
                </div>


                <div v-if="item.selectedCandidate" class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between">                            
                        <div class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> Candidat sélectionné </div>
                    </div>
                        <div v-for="candidates in item.candidates" class="flex items-center justify-between border border-gray-200 rounded">
                                <div v-if="item.selectedCandidate.id == candidates.id " >
                                    <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> Nom : {{ candidates.id }} {{ candidates.name }}  née en : {{ candidates.birthday }}</div>
                                    <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                                        <a href="" >CV</a>
                                    </div>
                                </div>
                        </div> 
                </div>

                <div v-else class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between">                            
                        <div class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> Candidatures</div>
                    </div>
                    <form @submit="sendCandidate" >
                        <div v-for="candidates in item.candidates" class="flex items-center justify-between border border-gray-200 rounded">
                                <div>
                                    <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> Nom : {{ candidates.id }} {{ candidates.name }}  née en : {{ candidates.birthday }}</div>
                                    <div class="mb-1 font-normal text-gray-700 dark:text-gray-400"> 
                                        <a href="" >CV</a>
                                    </div>
                                </div>
                                <div class="inline-flex items-center px-1 py-1 text-sm font-medium 
                                text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 
                                focus:ring-4 focus:outline-none focus:ring-blue-300 
                                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> 
                                
                                    <input type="hidden" ref="offer_cliched_id" name="offer_cliched_id" :value="item.id" id="offer_cliched_id">
                                    <button type="button" v-on:click="sendCandidate(item.id, candidates.id)" 
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                                    focus:outline-none focus:ring-blue-300 font-medium 
                                    rounded-lg text-sm px-5 py-2.5 text-center 
                                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accepter</button>
                                </div>
                        </div> 
                    </form>               
                </div>
            </div>
          </div>
        </div>   
</template>

<script>
import CompayVertBar from './CompayVertBar.vue';
import { getUser } from '../../stores/usersFunction';
import { addSelectedCandidates } from '../../stores/company'

export default {
  name: 'CompanyOfferCandidateView',
  components: {
    CompayVertBar,
  },
  data() {
    return {
        offers: [],
        form: {
            selected_candidate_id: '',
            offer_cliched_id: ''
        },
    }
  },
  mounted(){
    this.getRequest();
  },
  methods: {
    getRequest: async function (){
        //if (this.user !== '') return;
        await getUser().then((response) => {
            console.log(" getting user in cadidateView", response[0].company.offers)
            this.offers = response[0].company.offers
        })
    },
    sendCandidate: async function (id_offer, id_freelance){
       //console.log("offers ", this.offers)
       //this.form.selected_candidate_id = this.$refs.selected_candidate_id
       this.form.offer_cliched_id = id_offer
       this.form.selected_candidate_id = id_freelance
       console.log("this.form.selected_candidate_id   ", id_offer)
       console.log("this.form.selected_candidate_id   ", id_freelance)
       await addSelectedCandidates(this.form)
    }
  }
};
</script>
