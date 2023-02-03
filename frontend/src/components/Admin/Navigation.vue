<template>
    <div>
        <aside
            id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2">
                    <li v-for="item in Object.keys(data).slice(3)" :key="item">
                        <a
                            href="#"
                            class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5"></path>
                            </svg>
                            <span class="ml-3 capitalize">{{ item }} : {{ data[item] }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</template>

<script>
import http from '../../common/http-common'
export default {
    data() {
        return {
            data: []
        }
    },

    mounted() {
        this.test()
    },

    methods: {
        async test() {
            http
                .get("/api/")
                .then(response => {
                    this.data = response.data
                })
                .catch(e => {
                    console.log(e)
                })
        }
    },

}
</script>