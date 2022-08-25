import { createApp } from 'vue'
import './registerServiceWorker'
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/css/style.css';
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

axios.defaults.baseURL = 'http://localhost:8000';

const options = {
	transition: "Vue-Toastification__bounce",
	maxToasts: 20,
	newestOnTop: false
};

createApp(App)
	.use(VueAxios, axios)
	.use(store)
	.use(router)
	.use(Toast, options)
	.mount('#app');

import 'bootstrap/dist/js/bootstrap.min.js';