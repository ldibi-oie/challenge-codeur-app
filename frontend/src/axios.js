import axios from "axios";

const requestApi = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL
});

export default requestApi;