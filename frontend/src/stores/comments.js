import { defineStore } from "pinia";
import http from "../axios";

export const useCommentsStore = defineStore({
    id: "comments",
    state: () => ({
        comments: [],
        comment: {},
        loading: false,
        error: null,
    }),
    getters: {
        getComments(state) {
            return state.comments;
        }
    },
    actions: {
        async fetchComments() {
            this.loading = true;
            try {
                const response = await http.get("/api/comments");
                this.comments = response.data["hydra:member"];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchComment(id) {        
            this.loading = true;
            try {
                const response = await http.get(`/api/comments/${id}`);
                this.comment = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async createComment(comment) {
            this.loading = true;
            try {
                const response = await http.post("/api/comments", comment);
                this.comment = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async updateComment(comment) {
            this.loading = true;
            try {
                const response = await http.put(`/api/comments/${comment.id}`, comment);
                this.comment = response.data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async deleteComment(id) {
            this.loading = true;
            try {
                await http.delete(`/api/comments/${id}`);
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});