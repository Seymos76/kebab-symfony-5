import { API_URL } from "../config/ApiConfig";
import axios from "axios";

async function getAll() {
    try {
        const response = await axios.get(`${API_URL}/plates`);
        return response.data['hydra:member'];
    } catch (error) {
        console.error(error);
    }
}

async function create(config) {
    return await axios.post(`${API_URL}/plates`, config)
        .then(response => response.status)
        .catch(err => err.message);
}

export default {
    getAll,
    create,
}
