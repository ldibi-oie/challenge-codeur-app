
<template>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div role="status" class="" v-if="!user">
                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div> 
            {{ type }}
            <form @submit.prevent="setInfos" v-if="user ">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{type ? type === 1 ? 'Freelance' : 'Company' : 'Mes informations' }}</h3>

                <div class="grid grid-cols-6 gap-6">
                    <div v-bind:class="{'col-span-6 sm:col-span-3' : type === 2 , 'hidden' : type != 2}">
                        <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organization</label>
                        <input type="text" v-model="infos.organization" name="organization" id="organization" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Company Name" >
                    </div>
                    <div v-bind:class="{'col-span-6 sm:col-span-3' : type === 1 , 'hidden' : type != 1}">
                        <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prenom</label>
                        <input type="text" v-model="infos.name" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Bonnie" >
                    </div>
                    <div v-bind:class="{'col-span-6 sm:col-span-3': type === 1 , 'hidden' : type != 1}">
                        <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" v-model="infos.surname" name="last-name" id="last-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Green" >
                    </div>
                    
                    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" disabled :value="user.email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="example@company.com" >
                    </div>
                    
                    <!-- <div class="col-span-6 sm:col-span-3">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                        <input type="date" name="birthday" v-model="infos.birthday" id="birthday" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="15/08/1990" >
                    </div> -->

                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                        <input type="text" name="address" id="role" v-model="infos.address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"  >
                    </div>
                    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <input type="text" name="role" id="role" :value="user.roles" disabled class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="React Developer" >
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="submit">Save</button>
                    </div>
                    
                </div>
            </form>
        </div>
        
        
    </div>
</template>

<script>
import { getUser } from '../../../stores/usersFunction';
import { setFreelanceToUser , updateFreelanceToUser } from '../../../stores/freelance';
import { setCompanyToUser , updateCompanyToUser } from '../../../stores/company';
import { popUpSuccess , popUpError} from '../../../stores/notyf';

import moment from "moment"
export default {
    props: ['type' , 'user'],
    data() {
        return {
            isLoading: false,
            infos: {
                id: this.user ? this.user.id : localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')).id : "",
                userId: this.user ? this.user["@id"] : localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user'))["@id"] : "",
                name: this.user?.freelance ? this.user.freelance?.name :
                    this.user?.company ? this.user.company?.name : '',
                surname: this.user?.freelance ? this.user?.freelance?.surname :
                    this.user?.company ? this.user?.company?.surname : '',
                birthday: this.user?.freelance ? this.user?.freelance?.birthday :
                    this.user?.company ? this.user?.company?.birthday : '',
                organization: JSON.parse(localStorage.getItem('user'))?.company?.name ? JSON.parse(localStorage.getItem('user'))?.company.name : '',
                address: JSON.parse(localStorage.getItem('user'))?.company?.address ? JSON.parse(localStorage.getItem('user'))?.company.address : '',
            }
        };
    },
    // filters: {
    //     splitNumber(value) {
    //         return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    //     }
    // },
    created(){
        if(!localStorage.getItem('user')){
            this.$router.push({name: 'error'})
        }
    },
    mounted(){
        // this.getUserRequest()
    },

    methods: {
        setInfos: async function(){
            console.log("clieck")
            popUpSuccess('Mise a jour en cours ...')
            console.log(this.userId)
            // this.infos.organization = moment(this.infos.organization).format('YYYY-MM-DD')
            console.log(this.infos)

            if(this.type){
                console.log(this.infos)

                if(this.type === 1){
                    if(this.user.hasOwnProperty("freelance")){
                        // update
                        await updateFreelanceToUser(this.infos).then((st) => {
                            console.log(st)
                            this.$emit('nextStep' , 3)
                        })
                    } else {
                        //create
                        await setFreelanceToUser(this.infos).then((st) => {
                            console.log(st)
                            this.$emit('nextStep' , 3)
                        })
                    }
                }

                if(this.type === 2){
                    if(this.user.hasOwnProperty("company")){
                        // update
                        await updateCompanyToUser(this.infos).then((st) => {
                            console.log(st)
                            this.$emit('nextStep' , 3)
                        })
                    } else {
                        //create
                        await setCompanyToUser(this.infos).then((st) => {
                            console.log(st)
                            this.$emit('nextStep' , 3)
                        })
                    }

                }
            }
        },
    },
}
</script>