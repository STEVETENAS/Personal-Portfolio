import axios from "axios";

const apiClient = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    }
})

export default {
    getResponses(url) {
        return apiClient.get(url);
    },
    getResponse(url, id) {
        return apiClient.get(url + '/' + id);
    },
    getItem(url, attribute, element) {
        return apiClient.get(url + '?' + attribute + '=' + element);
    },
    saveResponse(url) {
        return apiClient.post(url);
    },
    apiClient
}
