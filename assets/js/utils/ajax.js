import axios from "axios";

function initAjax(method, formData = null) {
    const headers = new Headers();
    headers.set('Access-Control-Allow-Origin', '*');
    return {
        method,
        headers,
        mode: 'cors',
        body: formData ? formData : null,
        cache: 'default'
    };
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
