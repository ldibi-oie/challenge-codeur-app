
import requestApi from '../axios';
import { getUser } from './usersFunction';
import storage from './storage';
export const setFreelanceToUser = async (data) => {
    const v = {
        "userId": data.userId,
        "name": data.name,
        "surname": data.surname,
        "siretnumber": data.siretnumber,
        "birthday": data.birthday,
    }
    var r;
    console.log("CREATION D'UN FREELANCE EN COURS ....")

    await requestApi.post("/api/freelances", v)
    .then(async (res) => {
      console.log(res)
      console.log(res.data)
      storage.setItem("user", res.data);

      await requestApi.patch("/api/users/" + data.id , {roles: ["ROLE_FREELANCER"]} , {
        headers : {
            "Content-Type" : "application/merge-patch+json",
        }
        })
      .then(async () => {
        popUpSuccess('Vos donnees ont ete enregistré !')
        await getUser()
      }).catch((err ) => {
        popUpError(err.message)
      })

      r = true
    })
    .catch(err => {
        console.log(err)
        r = false
    })
    return r;
}

export const updateFreelanceToUser = async (data) => {
    console.log(data)
    const v = {
        "user": data.userId,
        "name": data.name,
        "surname": data.surname,
        "siretnumber": data.siretnumber,
        "birthday": data.birthday,
    }
    var r;
    console.log("CREATION D'UN FREELANCE EN COURS ....")

    await requestApi.patch("/api/freelances/" + data.idType , v , {
        headers : {
            "Content-Type" : "application/merge-patch+json",
        }
    })
    .then((res) => {
      console.log(res)
      console.log(res.data)
      r = true
    })
    .catch(err => {
        console.log(err)
        r = false
    })
    return r;
}