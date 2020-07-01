import {API_PLATFORM} from "../config/ApiConfig";
import axios from "axios";

async function createFile(formData) {
    axios.post(`${API_PLATFORM}/media_objects`, formData)
        .then(response => response.status)
        .catch(err => err.message);
}

export default {
    createFile
}
