<template>
    <div>
        <OfferForm  @on-submit="createOffer" />
        <span v-show="user.subscriptions?.length === 0"> Vous ne pouvez pas ajouter d'offre pour l'instant</span>
    </div>
</template>

<script>
import OfferForm from "../../../components/Offer/OfferForm.vue";
import storage from "../../../stores/storage";
import {createOffer} from "../../../stores/offers"
export default {
    data(){
        return {
            user: ''
        }
    },
    mounted(){
       this.getUserLocal() 
    },

    methods:{
        getUserLocal: async function(){
            await storage.getItem('user').then((userF) => this.user = userF)
        },
        createOffer: async function(userForm) {
            userForm["company"] = this.user.company["@id"]

            console.log(userForm , this.user)
            await createOffer(userForm).then((res) => {
                console.log(res)
            })
        },
    },
    components: { OfferForm }
}

</script>