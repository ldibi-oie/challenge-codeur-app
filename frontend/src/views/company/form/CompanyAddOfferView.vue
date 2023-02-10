<template> 
    <CompayVertBar /> 
      <form @submit.prevent="setInfos">  
        <div class="p-4 sm:ml-64">
          <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre</label>
                <input type="text" id="title" v-model="infos.title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Mettez un titre" required>
            </div>

            <div class="mb-6">
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your categorie</label>
                <select id="categories" v-model="infos.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="/api/categories/10">Développeur</option>
                    <option value="/api/categories/11">Administrateur</option>
                    <option value="/api/categories/12">Consultant</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salaire</label>
                <input type="number" id="salary" v-model="infos.salary" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Le salaire" required>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" v-model="infos.description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            </div>

            <div class="mb-6">
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your categorie</label>
                <select id="categories" v-model="infos.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>open</option>
                    <option>close</option>
                </select>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter une offre</button>
          </div>
        </div>
      </form>

        <div class="p-4 sm:ml-64">
          <div class="flex flex-row  p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Keyword
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
          </div>
        </div>   
</template>

<script>
import CompayVertBar from '../CompayVertBar.vue';
import { addOffre } from '../../../stores/company';
import { getUser } from '../../../stores/usersFunction';
export default {
    name: 'CompanyAddOfferView',
    components: {
        CompayVertBar
    },
    props: ['type'],
    data() {
        return {
            user: "",
            infos: {
                title: '',
                description: '',
                salary: '',
                status: '',
                company_id: '',
                category_id: '',
                selected_candidate_id: '',
            }
        };
    },
    mounted(){
        this.getUserRequest()
    },
    methods: {
        getUserRequest: async function () {
            if (this.user !== '') return;
            await getUser().then((r) => 
            {
                this.user = r[0]
                //console.log("user", this.user);
            })
        },
        setInfos: async function() {
            console.log("set infof clicked")
            console.log("this.user.company.id", this.user.company.id)
            this.infos.company_id = "/api/companies/"+this.user.company.id
            //console.log("info submit clicked", this.infos)
            await addOffre(this.infos)
        }
    }
}
</script>