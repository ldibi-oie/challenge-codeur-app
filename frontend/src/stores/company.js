

import requestApi from '../axios';
const url = "http://localhost:8741";

export const setCompanyToUser = async (data) => {
    var r;
    const v = {
        "id" : data.id,
        "name": data.organization,
        "siretnumber": data.siretnumber,
    }

    console.log("CREATION D'UNE COMPANY EN COURS ....")

    await requestApi.post(url+"/api/companies" , v)
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
// get companies 
export const getCompanies = async () => {
    var r;
    await requestApi.get(url+"/api/companies")
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
    await requestApi.get(url+"/api/companies/" + id)
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
export const addOffre = async (data) => {
    var r;
    const v = {
        "title": data.title,
        "description": data.description,
        "company": data.company_id,
        "category": data.category_id,
        "salary": data.salary,
        "status": data.status,
    }

    console.log("CREATION D'UNE OFFRE EN COURS ....")

    await requestApi.post(url+"/api/offers" , v)
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
    await requestApi.get(url+"/api/companies/" + id)
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
    await requestApi.get(url+"/api/offers")
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
    await requestApi.get(url+"/api/comments")
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
    await requestApi.get(url+"/api/comments?offer.id=" + id)
    .then((res) => {
      console.log(res.data)
      r = res.data["hydra:member"]
    })
    .catch(err => {
        console.log(err)
    })
    return r;
}
