

import requestApi from '../axios';
import { popUpError, popUpSuccess } from './notyf';
import { getUser } from './usersFunction';
export const setCompanyToUser = async (data) => {
    var r;
    console.log(data)
    const v = {
        "user" : data.userId,
        "name": data.organization,
        "address": data.address,    
    }


    console.log("CREATION D'UNE COMPANY EN COURS ...." , v)

    await requestApi.post("/api/companies" , v)
    .then(async (res) => {
      console.log(res)
      console.log(res.data)

      await requestApi.patch("/api/users/" + data.id , {roles: ["ROLE_COMPANY"]} , {
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
        popUpError(err.message)
    })
    return r;
}

export const updateCompanyToUser = async (data) => {
    var r;
    const v = {
        "name": data.organization,
        // "siretnumber": data.siretnumber,
    }

    console.log("UPDATE D'UNE COMPANY EN COURS ....")

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
// get companies 
export const getCompanies = async () => {
    var r;
    await requestApi.get("/api/companies")
    .then((res) => {
      //console.log(res.data)
      r = res.data;
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}

// get company by id
export const getCompanyById = async (id) => {
    var r ;
    await requestApi.get("/api/companies/" + id)
    .then((res) => {
      r = res.data;
      //console.log("stores.company ", r)
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}


// add offre by compagny
export const addOffre = async (data, company_id) => {
    var r;
    const v = {
        "title": data.title,
        "description": data.description,
        "company": company_id,
        "category": data.category,
        "salary": data.salary,
        "status": data.status,
        "jobUrl": data.jobUrl,
    }

    console.log("CREATION D'UNE OFFRE EN COURS ....")

    await requestApi.post("/api/offers" , v)
    .then((res) => {
      console.log(res)
      console.log(res.data)
      r = res
    })
    .catch(err => {
        console.log("the error", err)
    })
    return r;
}



// get offers by company
export const getOffersByCompany = async (id) => {
    var r;
    await requestApi.get("/api/companies/" + id)
    .then((res) => {
        console.log("",res.data)
        r = res.data
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}



// get offers 
export const getOffers = async () => {
    var r;
    await requestApi.get("/api/offers")
    .then((res) => {
      console.log(res.data)
      r = res.data
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}

// get comments
export const getComments = async () => {
    var r;
    await requestApi.get("/api/comments")
    .then((res) => {
      console.log(res.data)
      r = res.data
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}

// get comments by offer
export const getCommentsByOffer = async (id) => {
    var r;
    await requestApi.get("/api/comments?offer.id=" + id)
    .then((res) => {
      console.log(res.data)
      r = res.data["hydra:member"]
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}

// add selected candidates
export const addSelectedCandidates = async (data) => {
    var r;
    console.log("data.offer_cliched_id", data)
    const v = {
        "selectedCandidate": "/api/freelances/"+data.selected_candidate_id,
    }

    //console.log("selected_candidate_id", data)
    console.log("AJOUT D'UN CANDIDAT  SELECTED EN COURS ....", v)
    await requestApi.patch("/api/offers/" + data.offer_cliched_id, v, {
    headers : {
        "Content-Type" : "application/merge-patch+json",
    }})
    .then((res) => {
    console.log(" res.data in ..", res.data)
    popUpSuccess("Vous venez de selectionner un candidat")
    window.location.reload();
    r = res
    })
    .catch(err => {
        console.log("the error", err)
    })
    return r;
}

