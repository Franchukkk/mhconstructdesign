// Функція, щоб отримати параметри з URL

function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

const gclid = getQueryParam('gclid');
if (gclid) {
    localStorage.setItem('gclid', gclid);
}

const clientId = getQueryParam('client_id');
if (clientId) {
    localStorage.setItem('client_id', clientId);
}
