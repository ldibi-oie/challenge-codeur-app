<template> 
      <form v-if="mounted"  @submit.prevent="$emit('on-submit', form)">
        <div :class="{
        }">
          <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre</label>
                <input type="text" id="title" v-model="form.title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 dark:shadow-sm-light" placeholder="Mettez un titre" required>
            </div>

            <div class="mb-6">
                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your categorie</label>
                <select id="categories" v-model="form.category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                    <option v-for="categorie in categories" :key="categorie.id" :value="categorie['@id']">{{categorie.name}}</option>
                </select>
            </div>
            
            <div class="mb-6">
                <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salaire</label>
                <input type="number" id="salary" v-model="form.salary" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 dark:shadow-sm-light" placeholder="Le salaire" required>
            </div>
            
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" v-model="form.description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Leave a comment..."></textarea>
            </div>

            <!-- <div class="mb-6">
                <label for="jobUrl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Url d'application à l'offre</label>
                <input type="text" id="jobUrl" v-model="form.jobUrl" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 dark:shadow-sm-light" placeholder="L'url de l'offre">
            </div> -->

            <!-- <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your status</label>
                <select id="status" v-model="form.status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500">
                    <option>open</option>
                    <option>close</option>
                </select>
            </div> -->

            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Ajouter une offre</button>
          </div>
        </div>
      </form>
</template>

<script>
import storage from '../../stores/storage';
import { getCategories } from '../../stores/usersFunction';

export default {
  name: "OfferForm",
  props: {
    offerData: {
      type: Object,
    },
    fromScrapper: {
      type: Boolean,
      default: false,
    },
  },
data() {

    return {
      form: {
        title: "",
        category:  "",
        salary:  "",
        description: "",
        status:  "open",
        jobUrl:  "",
      },
      categories: [],
      mounted: false,
    };
  },
  async mounted() {
    await this.getCategoriesRequest();
    this.form = {
        title: this.offerData?.title || "",
        category: this.offerData?.category || "",
        salary: this.offerData?.salary || "",
        description: this.offerData?.description || "",
        status: this.offerData?.status || "open",
        // jobUrl: this.offerData?.jobUrl || "",
      };
    this.mounted = true;
  },
  methods: {
    getCategoriesRequest: async function () {
      await storage.getItem('categories').then((categorys) => this.categories = categorys);
    },
  },
};
</script>