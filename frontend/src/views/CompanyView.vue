<template> 
<CompayVertBar />         
  <form >  
    <div class="p-4 sm:ml-64">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
    
          <div>
              <label for="compagny_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Name</label>
              <input type="text" id="compagny_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
              :placeholder="company.name" required>
          </div>
          <div>
              <label for="compagny_siret" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Siret number</label>
              <input type="text" id="compagny_siret" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
              :placeholder="company.siretnumber" required>
          </div>
          <div>
              <label for="company_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Address</label>
              <input type="text" id="company_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
              :placeholder="company.address" required>
          </div> 

          <button type="submit" class=" p-2.5 m-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>
      </div>
    </div>
    </form>    
  </template>

<script>
import CompayVertBar from './company/CompayVertBar.vue';
import { getCompanyById, getCompanies } from '../stores/company';
import { getUser } from '../stores/usersFunction';
export default {
  name: 'CompanyView',
  components: {
    CompayVertBar,
  },
  data() {
    return {
      company: {
        name: '',
        siretnumber: '',
        address: '',
      },
      user: "",
    };
  },
  methods: {
    async getCompany() {
      if (this.user !== '') return;
      await getUser().then((r) => 
      {
          this.user = r[0]
          console.log("getUserRequest company id", this.user);
      })
      console.log("user id", this.user.id)
      console.log("company", this.user.company.id)
      await getCompanyById(this.user.company.id).then((response) => {
        this.company = response;
        console.log("getCompanyById data results", this.company)
      });
    },
  },
  mounted() {
    this.getCompany();
  }
};

</script>

  <style>
  @media (min-width: 1024px) {
    .company {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }
  }
  </style>
  