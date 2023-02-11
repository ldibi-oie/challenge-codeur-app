import http from "../axios";

export const fetchOffers = async () => {
  const offers = await http.get("/api/offers");
  return offers.data;
};

export const fetchOffer = async (id, state) => {
  try {
    state.loading = true;
    const offer = await http.get("/api/offers/" + id);
    state.offer = offer.data;
  } catch (error) {
    state.error = error;
  } finally {
    state.loading = false;
  }
};
