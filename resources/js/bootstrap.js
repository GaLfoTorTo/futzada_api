window._ = require('lodash');
import axios from 'axios';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// Defina o objeto Laravel com as configurações necessárias ANTES de usar axios
/* window.Laravel = {
    token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
    echo_address: window.location.hostname + ':6001' // Ajuste a porta conforme sua configuração
};

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

if (Laravel.token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = Laravel.token;
} else {
    console.error('CSRF token não encontrado: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Echo from 'laravel-echo';

window.io = require('socket.io-client');
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: Laravel.echo_address,
}); */
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';