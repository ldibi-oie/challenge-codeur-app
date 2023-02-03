import axios from 'axios';

export default axios.create({
    baseURL: 'http://host.docker.internal:8741/apip',
    headers: {
        'Content-type': 'application/json'
    }
});