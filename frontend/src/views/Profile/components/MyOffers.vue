<template>
    <div>
          <div class="flex flex-col justify-center my-5" >
            <div role="status" class="flex flex-col justify-center" v-if="!offers">
                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <div class="overflow-x-auto" v-if="offers">
                <div class="w-full mb-1" >
                    <div class="mb-4">
                      <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Mes offres</h1>
                    </div>
                </div>
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Nom de mission
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        budget propos??
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Status
                                    </th>
                                    <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <div v-if="loading" class="flex flex-col items-center shadow-md p-4 mb-8 bg-white" style="min-height: 250px;">
                                    <div
                                    
                                      class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200"
                                    >
                                      loading...
                                    </div>
                                </div>
                                
                                
                              <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" v-for="item in offers" @click="viewOfferDetail(item , item.id)">
                                  
                                  <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                      <div class="text-base font-semibold text-gray-900 dark:text-white">{{item.title}}</div>
                                      <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{user?.company?.name}}</div>
                                  </td>
                                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{item.salary}} ???</td>
                                  <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div
                                        v-if="item.status === 'open'"
                                        class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                                    >
                                        ouvert
                                    </div>
                                    <div
                                        v-if="item.status === 'IN_PROGRESS'"
                                        class="px-3 py-1 text-xs font-medium leading-none text-center text-green-800 bg-green-200 rounded-full animate-pulse dark:bg-green-900 dark:text-green-200"
                                    >
                                        en cours ...
                                    </div>
                                    <div
                                        v-if="item.status === 'closed'"
                                        class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse"
                                    >
                                        finish
                                    </div>
                                </td>
      
                                  <td class="p-4 space-x-2 whitespace-nowrap">
                                      <router-link :to="'/offer/' + item.id" type="button" id="updateProductButton" data-drawer-target="drawer-update-product-default" data-drawer-show="drawer-update-product-default" aria-controls="drawer-update-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                          Voir
                                      </router-link>
                                  </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="p-5 items-center w-full">
              <ManageOffer :details="viewDetail" />
            </div>

        </div>

    </div>
</template>
<script>
import { fetchOffers } from '../../../stores/offers';
import storage from '../../../stores/storage';
import ManageOffer from './ManageOffer.vue';
import {getOffersCandidatesByOfferId} from "../../../stores/usersFunction"

export default {
    props: ["user", "offers"],
    data() {
        return {
            id: storage.getItem("user").id,
            isLoading: null,
            viewDetail: ''
        };
    },
    methods: {
      viewOfferDetail: function(offer , offerId) {
        console.log(offer)
        offer["offerId"] = offerId;
        this.viewDetail = offer
        this.getOffers(offer.id)
      },

      getOffers: async function(id){
        await getOffersCandidatesByOfferId({offer_id : id}).then((res) => {
            this.viewDetail["candidates"] = res
        })
      }

    },
    components: { ManageOffer }
}
</script>
<style lang="">
    
</style>