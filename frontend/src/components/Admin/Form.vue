<template>
    <div class="min-h-screen">
        <Navbar />
        <div class="flex items-center">
            <div class="w-full">
            <div v-if="loading" class="fixed top-0 left-0 right-0 z-50 py-64 overflow-x-hidden overflow-y-auto md:inset-0 bg-gray-800/70">
                <div class="relative w-full h-full max-w-md mx-auto">
                    <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
                <div class="bg-white p-10 rounded-lg md:w-3/4 mx-auto lg:w-1/2">
                    <div
                        v-if="error != ''"
                        class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:text-red-400"
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
                            <span class="font-medium">Erreur : </span>
                            {{ error }}
                        </div>
                    </div>
                    <div
                        v-if="success != ''"
                        class="flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:text-green-400"
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
                            <span class="font-medium">Succés : </span>
                            {{ success }}
                        </div>
                    </div>
                    <form @submit.prevent="submitForm">
                        <div class="mb-5" v-for="field in fields" :key="field.name">
                            <label class="block mb-2 font-bold text-gray-600">
                                {{ field.label }}
                            </label>
                
                                <input v-model="form[field.name]" :type="field.type" :placeholder="field.placeholder" class="border border-gray-300 shadow p-3 w-full rounded" />
                                </div>
                                <button
                                    type="submit"
                                    class="block w-full bg-red-800 text-white font-bold p-4 rounded-lg"
                                    >
                                    Envoyer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <p>
                    {{ form }}
                    <br>
                    {{ fields }}
                </p> -->
    </div>
</template>

<script>
import http from '../../axios';
import Navbar from '../General/Navbar.vue';
    
export default {
    name: "Form",
    components: {
        Navbar,
    },
    data() {
        return {
            form: {},
            fields: [],
            error: '',
            success: '',
            loading: false,
        };
    },
    mounted() {
        this.$route.params.id ? this.fetchData() : '';
        // this.fetchData();
        this.fetchForm();
        console.log(this.$route.query.submitApi);
    },
    methods: {
        async submitForm() {
            try {
                this.loading = true;

                const method = this.$route.query.submitApiMethod;
                const url = this.$route.params.id ? `${this.$route.query.submitApi}/${this.$route.params.id}` : this.$route.query.submitApi;
                const response = await http[method](url, this.form);
                
                this.success = 'Objet enregistré avec succès';
                this.$emit("submitted", response.data);
                
            } catch (error) {
                this.error = error.response.data['hydra:description']
                console.error(error);
            }
            finally {
                this.loading = false;
                this.$router.push({ name: 'admin' });
            }
        },
        async fetchData() {
            try {
                this.loading = true;
                const response = await http.get(this.$route.query.submitApi + '/' + this.$route.params.id);
                this.form = response.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
        async fetchForm() {
                switch (this.$route.query.submitApi) {
                    case '/api/categories':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                            ];
                        break;
                    case '/api/comments':
                        this.fields = [
                                { name: 'comment', label: 'Comment', type: 'text', placeholder: 'Comment' },
                                { name: 'author', label: 'Author', type: 'text', placeholder: 'Author' },
                                { name: 'offer', label: 'Offer', type: 'text', placeholder: 'Offer' },
                            ];
                        break;
                    case '/api/companies':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                                { name: 'siretnumber', label: 'Siret Number', type: 'text', placeholder: 'Siret Number' },
                                { name: 'address', label: 'Address', type: 'text', placeholder: 'Address' },
                                { name: 'logo', label: 'Logo', type: 'text', placeholder: 'Logo' },
                                { name: 'offers', label: 'Offers', type: 'text', placeholder: 'Offers' },
                                { name: 'users', label: 'Users', type: 'text', placeholder: 'Users' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                            ];
                        break;
                    case '/api/freelances':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                                { name: 'surname', label: 'Surname', type: 'text', placeholder: 'Surname' },
                                { name: 'siretnumber', label: 'Siret Number', type: 'number', placeholder: 'Siret Number' },
                                { name: 'birthday', label: 'Birthday', type: 'date', placeholder: 'Birthday' },
                                { name: 'cv', label: 'CV', type: 'text', placeholder: 'CV' },
                                { name: 'profile', label: 'Profile', type: 'text', placeholder: 'Profile' },
                                { name: 'offers', label: 'Offers', type: 'text', placeholder: 'Offers' },
                                { name: 'userId', label: 'User ID', type: 'text', placeholder: 'User ID' },
                                { name: 'isSelectedCandidateList', label: 'Is Selected Candidate List', type: 'text', placeholder: 'Is Selected Candidate List' },
                                { name: 'keywords', label: 'Keywords', type: 'text', placeholder: 'Keywords' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/invoice':
                        this.fields = [
                                { name: 'stripeId', label: 'Stripe ID', type: 'text', placeholder: 'Stripe ID' },
                                { name: 'amountPaid', label: 'Amount Paid', type: 'number', placeholder: 'Amount Paid' },
                                { name: 'number', label: 'Number', type: 'text', placeholder: 'Number' },
                                { name: 'hostedInvoiceUrl', label: 'Hosted Invoice Url', type: 'text', placeholder: 'Hosted Invoice Url' },
                                { name: 'subscription', label: 'Subscription', type: 'text', placeholder: 'Subscription' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/keywords':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                                { name: 'freelances', label: 'Freelances', type: 'text', placeholder: 'Freelances' },
                                { name: 'offers', label: 'Offers', type: 'text', placeholder: 'Offers' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/offers':
                        this.fields = [
                                { name: 'title', label: 'Title', type: 'text', placeholder: 'Title' },
                                { name: 'description', label: 'Description', type: 'text', placeholder: 'Description' },
                                { name: 'company', label: 'Company', type: 'text', placeholder: 'Company' },
                                { name: 'candidates', label: 'Candidates', type: 'text', placeholder: 'Candidates' },
                                { name: 'category', label: 'Category', type: 'text', placeholder: 'Category' },
                                { name: 'salary', label: 'Salary', type: 'number', placeholder: 'Salary' },
                                { name: 'selectedCandidate', label: 'Selected Candidate', type: 'text', placeholder: 'Selected Candidate' },
                                { name: 'comments', label: 'Comments', type: 'text', placeholder: 'Comments' },
                                { name: 'keywords', label: 'Keywords', type: 'text', placeholder: 'Keywords' },
                                { name: 'status', label: 'Status', type: 'text', placeholder: 'Status' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/plans':
                        this.fields = [
                                { name: 'name', label: 'Name', type: 'text', placeholder: 'Name' },
                                { name: 'slug', label: 'Slug', type: 'text', placeholder: 'Slug' },
                                { name: 'stripeId', label: 'Stripe ID', type: 'text', placeholder: 'Stripe ID' },
                                { name: 'price', label: 'Price', type: 'number', placeholder: 'Price' },
                                { name: 'paymentLink', label: 'Payment Link', type: 'text', placeholder: 'Payment Link' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/subcriptions':
                        this.fields = [
                                { name: 'stripeId', label: 'Stripe ID', type: 'text', placeholder: 'Stripe ID' },
                                { name: 'isActive', label: 'Is Active', type: 'text', placeholder: 'Is Active' },
                                { name: 'plan', label: 'Plan', type: 'text', placeholder: 'Plan' },
                                { name: 'currentPeriodStart', label: 'Current Period Start', type: 'date', placeholder: 'Current Period Start' },
                                { name: 'currentPeriodEnd', label: 'Current Period End', type: 'date', placeholder: 'Current Period End' },
                                { name: 'user', label: 'User', type: 'text', placeholder: 'User' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/users':
                        this.fields = [
                                { name: 'email', label: 'Email', type: 'text', placeholder: 'Email' },
                                { name: 'roles', label: 'Roles', type: 'text', placeholder: 'Roles' },
                                { name: 'password', label: 'Password', type: 'text', placeholder: 'Password' },
                                { name: 'isVerified', label: 'Is Verified', type: 'text', placeholder: 'Is Verified' },
                                { name: 'freelance', label: 'Freelance', type: 'text', placeholder: 'Freelance' },
                                { name: 'company', label: 'Company', type: 'text', placeholder: 'Company' },
                                { name: 'subscriptions', label: 'Subscriptions', type: 'text', placeholder: 'Subscriptions' },
                                { name: 'stripeId', label: 'Stripe ID', type: 'text', placeholder: 'Stripe ID' },
                                { name: 'comments', label: 'Comments', type: 'text', placeholder: 'Comments' },
                                { name: 'createdAt', label: 'Created At', type: 'date', placeholder: 'Created At' },
                                { name: 'updatedAt', label: 'Updated At', type: 'date', placeholder: 'Updated At' },
                            ];
                        break;
                    case '/api/media_objects':
                        this.fields = [
                                { name: 'contentUrl', label: 'Content Url', type: 'text', placeholder: 'Content Url' },
                            ];
                        break;
                }      
        }
    }
};
</script>