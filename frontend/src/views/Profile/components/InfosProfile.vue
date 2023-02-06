
<template>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">{{type ? type === 1 ? 'Freelance' : 'Company' : 'Mes informations' }}</h3>
            {{ user }}
            {{ type }}
            <form @submit.prevent="setInfos">
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
                        <label for="siretnumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">siretnumber</label>
                        <input type="number"  v-model="infos.siretnumber" name="siretnumber" id="siretnumber" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="000 0000 00000 00000" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" disabled :value="user.email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="example@company.com" required="">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
                    
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                        <input type="date" name="birthday" v-model="infos.birthday" id="birthday" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="15/08/1990" required="">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse</label>
                        <input type="text" name="address" id="role" v-model="infos.address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"  required="">
                    </div>
                    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <input type="text" name="role" id="role" :value="user.roles" disabled class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="React Developer" required="">
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button v-if="user.company ||user.freelance" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="submit">Mettre a jour</button>
                        <button v-if="user.company === null || user.freelance === null" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        
        
    </div>
</template>

<script>
import { getUser } from '../../../stores/usersFunction';
import { setFreelanceToUser } from '../../../stores/freelance';
import { setCompanyToUser } from '../../../stores/company';

import moment from "moment"
export default {
    props: ['type'],
    data() {
        return {
            user: "",
            infos: {
                userId: this.user ? this.user["@id"] : localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user'))["@id"] : "",
                name: '',
                surname: '',
                siretnumber: '',
                birthday: '',
                organization: '',
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
        this.getUserRequest()
    },
    methods: {
        getUserRequest: async function () {
            if (this.user !== '') return;
            await getUser().then((r) => {
                this.user = r[0]
            })
        },

        setInfos: async function(){
            console.log("clieck")
            console.log(this.userId)
            // this.infos.organization = moment(this.infos.organization).format('YYYY-MM-DD')
            console.log(this.infos)

            if(this.type === 1 ){
                await setFreelanceToUser(this.infos).then((st) => {
                    this.info = st
                })
            }

            if(this.type === 2){
                await setCompanyToUser(this.infos).then((st) => {
                    this.info = st
                })
            }

        }
    },
}
</script>