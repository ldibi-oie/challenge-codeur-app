import { defineStore } from "pinia";
import http from "./../common/http-common";
import requestApi from './../axios';
import { popUpError , popUpSuccess } from "./notyf";

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

export const setSiretbyId = async (type, data) => {
  console.log("------   AJOUT D'UN SIRET --------")
  console.log(type , data)
  var r;
  await requestApi.patch("/api/" + type + "/" + data.id , data , {
    headers : {
        "Content-Type" : "application/merge-patch+json",
    }
    })
  .then(() => {
    popUpSuccess('Siret soumis !')
    r = true
  })
  .catch((err) => {
    popUpError(err)
    r = false
  })
  return r
}
