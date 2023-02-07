import axios from 'axios';

export default axios.create({
    baseURL: 'http://host.docker.internal:8741',
    headers: {
        'Content-type': 'application/json'
    }
});