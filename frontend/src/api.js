import axios from 'axios';

const port = 8000
const host = '127.0.0.1'

const api = axios.create({
    baseURL: `http://${host}:${port}/api/v1/`,
  });

export default api;