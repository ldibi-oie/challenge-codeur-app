<template>
    <NavBar />
    <div class="flex justify-center w-full px-4 pt-24  md:pt-32 lg:px-0">
        <div v-if="mounted" class="w-full mb-8" style="width: 700px;">
            <OfferForm :offerData="offer" @on-submit="createOffer" :fromScrapper="true" />
        </div>
    </div>
</template>

<script>
import OfferForm from '../../components/Offer/OfferForm.vue';
import { addOffre } from '../../stores/company';
import { getLoggedUser } from '../../stores/usersFunction';
import NavBar from '../../components/General/Navbar.vue';

export default {
    name: "OfferScrapperForm",
    data() {
        return {
            offer: null,
            user: null,
            mounted: false,
        };
    },

    async mounted() {
        this.user = await getLoggedUser()

        const data = JSON.parse(this.$route.query.offerData);
        this.offer = {
            title: data.job_title,
            category_id: "",
            salary: data.job_max_salary,
            description: data.job_description,
            status: "",
            jobUrl: data.job_apply_link,
        }
        this.mounted = true
    },
    methods: {
        createOffer: async function (userForm) {
            await addOffre(userForm, "/api/companies/" + this.user.company.id)
            this.$router.push({ name: "scrapper-create-offer" });
        },
    },
    components: {
        OfferForm,
        NavBar
    },
};
</script>
