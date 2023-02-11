

import requestApi from '../axios';
export const setCompanyToUser = async (data) => {
    var r;
    const v = {
        "id" : data.id,
        "name": data.organization,
        "siretnumber": data.siretnumber,
    }

    console.log("CREATION D'UNE COMPANY EN COURS ....")

    await requestApi.post("/api/companies" , v)
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

export const updateCompanyToUser = async (data) => {
    var r;
    const v = {
        "name": data.organization,
        // "siretnumber": data.siretnumber,
    }

    console.log("CREATION D'UNE COMPANY EN COURS ....")

    await requestApi.put("/api/companies/" + data.userId , v)
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