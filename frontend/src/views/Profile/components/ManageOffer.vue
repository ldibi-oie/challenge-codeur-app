<template>
    <div>
        {{ details }}
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
              <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Les candidatures</h3>
                <div v-for="item in details.candidates" class="grid w-full md:grid-cols-3 items-center">
                    {{ item.name }}  {{ item.surname }}
                    <a href="" >Regarder le cv</a>
                    <button @click="setFinalCandidate(item['@id'] , details.id)" class="text-white bg-red-700 w-30 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Accepter</button>

                    
                </div>
                <span v-if="details?.candidates?.length === 0">Pas de candidature pour le moment</span>
            </div>
            <div id="traffic-channels-chart" class="w-full"></div>
          </div>
    </div>
</template>

<script>
import {getOffersCandidatesByOfferId , addCandidate} from "../../../stores/usersFunction"

export default {
    props: ['details'],
    data(){
        return {
            candidates: ''
        }
    },

    methods:{
        setFinalCandidate: async function(id , userId) {
            console.log(id)
            await addCandidate({'selectedCandidate': id , 'id': userId}).then((st) => {
                console.log(st)
            })
        }
    }
}
</script>