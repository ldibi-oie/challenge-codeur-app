import requestApi from "../axios";
import {getToken} from "./usersFunction"
import { popUpError , popUpSuccess } from "./notyf";
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

export const createOffer = async (state) => {
  try {
    state.loading = true;
    const offer = await requestApi.post("/api/offers" , state);
    state.offer = offer.data;
    popUpSuccess('Offre créée avec succes')
  } catch (error) {
    state.error = error;
    popUpError(error)
  } finally {
    state.loading = false;
  }
};
