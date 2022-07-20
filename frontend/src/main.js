import { createApp } from 'vue'
import { createVuestic } from 'vuestic-ui'
import App from './App.vue'
import router from './router'
import store from './store'
import './registerServiceWorker'
import 'vuestic-ui/dist/vuestic-ui.css'

createApp(App)
    .use(store)
    .use(router)
    .use(createVuestic())
    .mount('#app')
