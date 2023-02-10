import { defineStore } from "pinia";
import http from "./../common/http-common";

export const useUserStore = defineStore("user", {
  state: () => ({ users: [] }),
  getters: {
    get(state) {
      return state.users;
    },
  },
  actions: {
    async fetchUsers(url) {
      try {
        const response = await http.get(url);
        this.users = response.data;
      } catch (error) {
        alert(error);
        console.log(error);
      }
    },
  },
});
