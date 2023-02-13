<template>
    <div>
        <Navbar />
        <!-- Si l'utilisateur n'est pas un admin, renvoie une page avec un interdiction a l'utilisateur d'acceder a cette page -->
        <div v-if="!isAdmin">
            <div class="flex flex-col items-center justify-center h-screen">
                <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Vous n'avez pas les droits pour acceder a cette page
                </p>
            </div>
        </div>
        <div v-else>
            <aside
            id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <div v-if="loadNavigation" class="flex justify-center items-center">
                    <div>
                        <svg
                        aria-hidden="true"
                        class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"/>
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <ul v-else class="space-y-2">
                    <li v-for="item in Object.keys(data).slice(3)" :key="item">
                        <button
                            v-on:click="fetchData(data[item])"
                            class="flex items-start p-2 w-full text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg
                                aria-hidden="true"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="ml-3 whitespace-nowrap capitalize">{{ item }}</span>
                        </button>
                    </li>
                </ul>
            </div>
        </aside>

<div class="p-4 sm:ml-64">
    <div
        v-if="error != ''"
        class="flex p-4 mt-5 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:text-red-400"
        role="alert">
        <svg
            aria-hidden="true"
            class="flex-shrink-0 inline w-5 h-5 mr-3"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Erreur :
            </span>
            {{ error }}
        </div>
    </div>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-200 mt-7">
        <button class="bg-blue-500 py-2 px-4 rounded-md text-white dark:text-white mx-5">
            <span v-if="loadNavigation">
                <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-4 h-4 mr-3 text-white animate-spin"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"/>
                </svg>
                Chargement
            </span>
            <span v-else v-on:click="formData()">
                Ajouter un objet
            </span>
        </button>
        <TableAdmin ref="tableAdmin" :path="url" />
    </div>
    <!-- <p class="p-4 bg-red-500 rounded-md mt-5">
        {{ url }}
    </p> -->
</div>

</div>
</div>
</template>

<script>
    import NavigationAdmin from '../../components/Admin/Navigation.vue'
    import TableAdmin from '../../components/Admin/Table.vue'
    import Navbar from '../../components/General/Navbar.vue'
    import http from '../../axios'

    export default {
        components: {
            NavigationAdmin,
            TableAdmin,
            Navbar,
        },
        data() {
            return {
                // Sidebar
                data: [],
                url: '/api/users',
                loadNavigation: true,

                // Table
                columns: [],
                dataTable: [],

                // Alert error
                error: '',

                // Admin
                isAdmin: false,
            }
        },
        mounted() {
            this.getLinks()
            this.fetchData(this.url)
            this.getAdmin()
        },
        methods: {
            async getLinks() {
                http
                    .get("/api")
                    .then(response => {
                        this.data = response.data
                        this.error = ''
                    })
                    .catch(e => {
                        this.error = e
                    })
                    .finally(() => {
                        this.loadNavigation = false
                    })
            },
            async fetchData(path) {
                try {
                    this.$refs.tableAdmin.load = true
                    this.url = path
                    const response = await http.get(path);
                    
                    this.error = ''

                    this.columns = Object.keys(response.data["hydra:member"][0]);
                    this.dataTable = response.data["hydra:member"];

                    this.$refs.tableAdmin.columns = this.columns
                    this.$refs.tableAdmin.data = this.dataTable

                    console.log(this.dataTable)
                    console.log(this.columns)
                } catch (error) {
                    console.log(error);
                    this.error = error.response.data['hydra:description']
                } finally {
                    this.$refs.tableAdmin.load = false
                }
            },
            async formData() {
                this.$router.push({ name: 'admin_form_add', query: { submitApi: this.url, submitApiMethod: 'post' } });
            },
            async getAdmin() {
                try {
                    const admin = JSON.parse(localStorage.getItem('user'))
                    if (admin.roles[0] === 'ROLE_ADMIN') {
                        this.isAdmin = true
                    }
                } catch (error) {
                    console.log(error)
                }
            }
        },
    }
</script>