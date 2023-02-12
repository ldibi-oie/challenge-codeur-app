import requestApi from "../axios";
import {getToken} from "./usersFunction"

export const fetchOffers = async (options) => {
  const {
    company_id= "",
    category= "",
    page= 1
  } = options
  var token = await getToken();
  const offers = await requestApi.get(`/api/offers?page=${page}&company%5B%5D=${company_id}&category=${category}`, {
    headers: "Bearer " + token,
  });
  return offers.data["hydra:member"];
};

export const fetchOffer = async (id, state) => {
  try {
    state.loading = true;
    const offer = await requestApi.get("/api/offers/" + id);
    state.offer = offer.data;
  } catch (error) {
    state.error = error;
  } finally {
    state.loading = false;
  }
};
