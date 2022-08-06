import { createApp } from 'vue'
import './registerServiceWorker'
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/css/style.css';
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'

axios.defaults.baseURL = 'http://localhost:8000';

createApp(App)
    .use(VueAxios, axios)
    .use(store)
    .use(router)
    .mount('#app');

import 'bootstrap/dist/js/bootstrap.min.js';