import { API_PLATFORM as API_URL, API_CUSTOM } from "../config/ApiConfig";
import axios from "axios";

async function getAll() {
    try {
        const response = await axios.get(`${API_URL}/plates`);
        return response.data['hydra:member'];
    } catch (error) {
        console.error(error);
    }
}

async function create(ajaxConfig) {
    return await axios.post(`${API_CUSTOM}/plates/add`, ajaxConfig)
        .then(response => response.status)
        .catch(err => err.message);
}

export default {
    getAll,
    create,
}
