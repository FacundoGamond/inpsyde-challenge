import Axios from 'axios';

/*
 * Create a Api object with Axios and
 * configure it for the WordPress Rest Api.
 *
 * The 'mynamespace' object is injected into the page
 * using the WordPress wp_localize_script function.
 */
const Api = Axios.create({
    baseURL: inpsydeChallenge.rootapiurl,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': inpsydeChallenge.nonce
    }
});

export default Api;