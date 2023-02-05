<script setup>
</script>

<template>
  <main>
    <h1>Home View</h1>
  </main>
</template>
<script setup>
import { Dropdown, ListGroup, ListGroupItem } from 'flowbite-vue'

</script>
<script>
import { ref } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import Navbar from "../components/General/Navbar.vue";
import requestApi from '../axios';
import { getUser , getCategories } from '../stores/usersFunction';

export default {
    data() {
        return {
            user: "",
            userId: "",
            categories: []
        };
    },
    mounted(){
        this.getCategoriesRequest()
    },
    methods: {
        getCategoriesRequest: async function () {
          await getCategories().then((data) => {
            this.categories = data
          })
          console.log(this.categories)
        }
    },
    components: { Navbar }
}

</script>
