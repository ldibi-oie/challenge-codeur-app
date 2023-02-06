<template>
    <div class="mx-auto p-6 container ">
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

        <div v-bind:class="{'flex flex-col h-screen justify-center items-center': section === 1 , 'hidden': section != 1}">
            <div v-bind:class="{'block': section === 1 , 'hidden': section != 1}">
                <span>JE SUIS </span>

                <div class="bg-white flex row items-center">
                <!-- Votre contenu ici -->
                <button v-on:click="setTypeUser(1)" class="m-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                    Un Freelance
                </button>
                <button v-on:click="setTypeUser(2)" class="m-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800" type="button" data-drawer-target="drawer-create-product-default" data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default" data-drawer-placement="right">
                   Une Entreprise
                </button>
                </div>
            </div>
            
        </div>
        <div v-bind:class="{'block m-6': section === 2 , 'hidden': section != 2}">
            <InfosProfile :type="typeUser" />
        </div>

        <div v-bind:class="{'block m-6': section === 3 , 'hidden': section != 3}">
            <span>3EME ONGLET</span>
        </div>


        
        

    </div>


</template>

<script>
import InfosProfile from '../Profile/components/InfosProfile.vue';

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
        }
    },
    components: { InfosProfile }
}
</script>