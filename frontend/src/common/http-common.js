import axios from 'axios';

export default axios.create({
    baseURL: 'http://localhost:8741/apip/',
    headers: {
        'Content-type': 'application/json'
    }
});