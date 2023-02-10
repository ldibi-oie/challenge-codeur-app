import { defineStore } from "pinia";
import http from "../axios";

export const useOffersStore = defineStore({
    id: "offers",
    state: () => ({
        offers: [],
        offer: {},
        loading: false,
        error: null,
    }),
    getters: {
        getOffers(state) {
            return state.offers;
        }
    },
    actions: {
        async fetchOffers() {
            this.loading = true;
            try {
                const response = await http.get("/api/offers");
                this.offers = response.data["hydra:member"];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchOffer(id) {
            this.loading = true;
            try {
                const response = await http.get(`/api/offers/${id}`);
                this.offers = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async createOffer(offer) {
            this.loading = true;
            try {
                const response = await http.post("/api/offers", offer);
                this.offer = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async updateOffer(offer) {
            this.loading = true;
            try {
                const response = await http.put(`/api/offers/${offer.id}`, offer);
                this.offer = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async deleteOffer(id) {
            this.loading = true;
            try {
                await http.delete(`/api/offers/${id}`);
                this.offer = {};
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});