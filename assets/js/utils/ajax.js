import axios from "axios";

function initAjax(method, myHeaders, formData) {
    return {
        method: 'POST',
        headers: myHeaders,
        mode: 'cors',
        body: JSON.stringify(formData),
        cache: 'default'
    };
}

function initAxios() {
    return axios
        .get(
        '/user',
        {
            params: {
                ID: 12345
            }
        })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        })
        .then(function () {
            // always executed
        });
}

// later
function createFormData(items) {
    let formData = new FormData();
    console.log('items',items);
    return formData;
}

function fetcher(uri, config) {
    fetch(uri,config)
        .then(function(response) {
            return response;
        });
}

export default {
    initAjax,
    createFormData,
    fetcher
}
