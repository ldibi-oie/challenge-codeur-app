<template>
    <div class="min-h-screen">
        <NavbarAdmin/>
        <div class="flex items-center">
            <div class="w-full">
                <!-- <h2 class="text-center text-blue-800 font-bold text-2xl uppercase mb-10">
                    Merci de remplir le formulaire
                </h2> -->
                <div class="bg-white p-10 rounded-lg md:w-3/4 mx-auto lg:w-1/2">
                    <form @submit.prevent="submitForm">
                        <div class="mb-5" v-for="field in fields" :key="field.name">
                            <label class="block mb-2 font-bold text-gray-600">
                                {{ field.label }}
                            </label>
                
                                <input v-model="form[field.name]" :type="field.type" :placeholder="field.placeholder" class="border border-gray-300 shadow p-3 w-full rounded" />
                                </div>
                                <button
                                    type="submit"
                                    class="block w-full bg-blue-800 text-white font-bold p-4 rounded-lg"
                                    >
                                    Envoyer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <p>
                    {{ form }}
                </p>
        <!-- <form @submit.prevent="submitForm">
        <div v-for="field in fields" :key="field.name">
            <label>{{ field.label }}</label>
            <input v-model="form[field.name]" :type="field.type" :placeholder="field.placeholder">
        </div>
        <button type="submit">Submit</button>
        <p class="text-black bg-yellow-500 p-4">
            {{ fields }}
        </p>
    </form> -->
    </div>
</template>

<script>
import http from '../../axios';
import NavbarAdmin from './Navbar.vue';
    
export default {
    name: "Form",
    components: {
        NavbarAdmin
    },
    data() {
        return {
            form: {},
            fields: [],
        };
    },
    mounted() {
        this.fetchForm();
        console.log(this.$route.query.submitApi);
    },
    methods: {
        async submitForm() {
            try {
                const method = this.$route.query.submitApiMethod;
                const response = await http[method](this.$route.query.submitApi, this.form);
                this.$emit("submitted", response.data);
            } catch (error) {
                console.error(error);
            }
        },
        async fetchForm() {
            if (this.$route.query.submitApi == 'post') {
                switch (this.$route.query.submitApi) {
                    case '/api/categories':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                                { name: 'offers', label: 'Offre', type: 'text', placeholder: 'Offre' },
                            ];
                    break;
                }
            }
            
        }
    }
};
</script>