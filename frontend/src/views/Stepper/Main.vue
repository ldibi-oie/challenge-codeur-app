<template>
    <div class="mx-auto p-6 container pt-32" style="max-width: 800px">
        
        <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0 justify-between">
            <li v-on:click="nextStep(1)" v-bind:class="{'flex items-center text-red-600 dark:text-red-500 space-x-2.5': section === 1 , 'flex items-center text-gray-600 dark:text-gray-500 space-x-2.5': section != 1}">
                <span v-bind:class="{'flex items-center justify-center w-8 h-8 border border-red-600 rounded-full shrink-0 dark:border-red-500': section === 1 , 'flex items-center justify-center w-8 h-8 border border-gray-600 rounded-full shrink-0 dark:border-gray-500': section != 1}">
                    1
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Choix du type de compte</h3>
                    <!-- <span class="text-sm">Step details here</span> -->
                </span>
            </li>
            <li v-on:click="nextStep(2)" v-bind:class="{'flex items-center text-red-600 dark:text-red-500 space-x-2.5': section === 2 , 'flex items-center text-gray-600 dark:text-gray-500 space-x-2.5': section != 2}">
                <span v-bind:class="{'flex items-center justify-center w-8 h-8 border border-red-600 rounded-full shrink-0 dark:border-red-500': section === 2 , 'flex items-center justify-center w-8 h-8 border border-gray-600 rounded-full shrink-0 dark:border-gray-500': section != 2}">
                    2
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Mes informations</h3>
                    <!-- <span class="text-sm">Step details here</span> -->
                </span>
            </li>
            <li v-on:click="nextStep(3)" v-bind:class="{'flex items-center text-red-600 dark:text-red-500 space-x-2.5': section === 3 , 'flex items-center text-gray-600 dark:text-gray-500 space-x-2.5': section != 3}">
                <span v-bind:class="{'flex items-center justify-center w-8 h-8 border border-red-600 rounded-full shrink-0 dark:border-red-500': section === 3 , 'flex items-center justify-center w-8 h-8 border border-gray-600 rounded-full shrink-0 dark:border-gray-500': section != 3}">
                    3
                </span>
                <span>
                    <h3 class="font-medium leading-tight">Recapitulatif</h3>
                    <!-- <span class="text-sm">Step details here</span> -->
                </span>
            </li>
        </ol>

        <div v-bind:class="{'flex flex-col h-screen pt-32 items-center': section === 1 , 'hidden': section != 1}">
            <div v-bind:class="{'block': section === 1 , 'hidden': section != 1}">
             <div class="flex flex-row w-full items-center justify-start">
                <p class="text-2xl text-black font-bold">JE SUIS </p>

             </div>
               <div class="flex flex-row mt-4">
                <div class="px-12 bg-white flex row items-center mr-8 px-8 py-8 rounded-lg bg-purple-100 hover:bg-purple-300  focus:outline-none">
                <!-- Votre contenu ici -->
                <button v-on:click="setTypeUser(1)" class="mr-3 px-4 text-black font-medium rounded-lg text-lg px-5 py-2.5" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                    Un Freelance
                </button>
                </div>

                <div class="bg-white flex row items-center px-8 py-8 rounded-lg bg-purple-100 hover:bg-purple-300   focus:outline-none">
                <button v-on:click="setTypeUser(2)" class="m-3 text-black font-medium rounded-lg text-lg px-5 py-2.5" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                   Une Entreprise
                </button>
                </div>
               </div>
            </div>
            
        </div>
        <div v-bind:class="{'block m-6': section === 2 , 'hidden': section != 2}">
            <InfosProfile :type="typeUser" :user="user" @nextStep="sendData" />
        </div>

        <div v-bind:class="{'block m-6': section === 3 , 'hidden': section != 3}">
            <span>Souscrivez a un abonnement {{ typeUser === 2 ? 'Entreprise afin de pouvoir postuler des appels d\'offres et travailler avec des freelancers du monde entier' : 'Freelance afin de pouvoir candidater et trouver vos futures missions' }} </span>
            <PricingCard :is_company="typeUser === 2 ? true : false" :user="user" />
            <div class="flex justify-center p-5">
                <router-link
                  to="/"
                  class="text-sm text-gray-600 dark:text-gray-600 hover:underline first-letter"
                  >Retour a la page d'accueil</router-link
                >
            </div>
        </div>

    </div>


</template>

<script>
import InfosProfile from '../Profile/components/InfosProfile.vue';
import PricingCard from '../Subscription/PricingCard.vue'
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            section: 1,
            typeUser: null
        };
    },
    methods: {
        nextStep: function (it) {
            this.section = it;
        },
        setTypeUser: function (type) {
            this.typeUser = type;
            console.log(this.typeUser);
            this.nextStep(this.section + 1);
        },
        sendData: function(step){
            this.section = step
        }
    },
    components: { InfosProfile , PricingCard }
}
</script>