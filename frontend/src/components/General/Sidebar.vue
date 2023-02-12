<template>
  

  <aside class="fixed top-0 left-0 w-1/6 h-full" aria-label="Sidenav">
    
    <div class="overflow-y-auto pb-5 pt-28 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        {{ role }}
        <div role="status" class="" v-if="!role">
          <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
          </svg>
          <span class="sr-only">Loading...</span>
        </div> 
        <ul class="space-y-2 py-3" >
          
          <li class="" v-if="role" v-for="item in settings" >
              <button @click="selectOnglet(item.value)" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                  <span class="flex-1 ml-3 whitespace-nowrap">{{item.name}}</span>
                  <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                  </span>
              </button>
          </li>.
          <li class="">
            <button @click="logoutRequest()" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Deconnexion</span>
                <span class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                </span>
            </button>
        </li>
        </ul>
    </div>
  </aside>
</template>

<script>
import { logout } from '../../stores/usersFunction'
const userNormalParams = [
  { name: 'Mes informations' , value: 'infos' },
  // { name: 'Devenir Premium' , value: 'premium'},

]

const freelanceParams = [
 { name: 'Mes informations' ,  value: 'infos'},
 { name: 'Mes evaluations' , value: 'evaluations' },
 { name: 'Mes offres en cours' , value: 'offres' },
 { name: 'Mes projets realisés' , value: 'projets' },
 { name: 'Mon abonnement' , value: 'abonnement' },
]

const companyParams = [
 { name: 'Mes informations' ,  value: 'infos'},
 { name: 'Mes evaluations' , value: 'evaluations' },
 { name: 'Mes offres en cours' , value: 'offres' },
 { name: 'Gerer mes offres' , value: 'offres' },
 { name: 'Mes projets realisés' , value: 'projets' },
 { name: 'Mon abonnement' , value: 'abonnement' },
]

const ROLE_FREELANCER = "ROLE_FREELANCER"
const ROLE_COMPANY = "ROLE_COMPANY"

export default {
  props: ['role'],

  data(){
    return {
      isLoading: this.role ? true : false,
      settings: this.role && this.role?.includes(ROLE_COMPANY) ? freelanceParams : 
        this.role && this.role?.includes(ROLE_FREELANCER) ? freelanceParams :
        userNormalParams
      // settings: freelanceParams
    }
  }
  ,
  mounted() {
    console.log(this.role , this.role?.includes(ROLE_COMPANY) , this.role?.includes(ROLE_FREELANCER))
  },
  methods: {
    selectOnglet: async function(value){
        console.log(value)
        this.$emit('selectOnglet' , value )
    },

    logoutRequest: function(){
      logout()
      this.$route.push({name: 'home'})
    }   
  }
}
</script>