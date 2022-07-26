import { createApp } from 'vue'
import './registerServiceWorker'
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/css/style.css';
import App from './App.vue'
import router from './router'
import store from './store'

createApp(App)
.use(store)
.use(router)
.mount('#app');

import 'bootstrap/dist/js/bootstrap.min.js';