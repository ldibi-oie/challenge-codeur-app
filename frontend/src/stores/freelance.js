
import requestApi from '../axios';

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

    await requestApi.post("/api/freelances" , v)
    .then((res) => {
      console.log(res)
      console.log(res.data)
      r = true
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}