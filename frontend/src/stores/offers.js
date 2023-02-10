
import requestApi from '../axios';

export const getOffer = async (id) => {
    console.log("cherche offer en cours pour " + id + " -------------")
    var r;
    await requestApi.get("/api/offers/" + id ).then((offers) => {
        const response = offers.data
        console.log(response)
        r = response   
    })
    return r;
}

export const getOffers = async () => {
    console.log("cherche offres en cours -------------")
    var r = [];
    await requestApi.get("/api/offers").then((categories) => {
        const response = categories.data["hydra:member"]
        console.log(response)
        r.push(...response)   
    })
    return r;
}