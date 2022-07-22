import { createApp } from 'vue'
import 'element-plus/dist/index.css'
import './registerServiceWorker'
import 'element-plus/theme-chalk/display.css'
import ElementPlus from 'element-plus'
import App from './App.vue'
import router from './router'
import store from './store'

createApp(App)
    .use(ElementPlus)
    .use(store)
    .use(router)
    .mount('#app')
