import { createApp } from 'vue'
import App from './components/App.vue'
import axios from 'axios'

axios.defaults.headers.common = {
    'X-WP-Nonce': wpApiSettings.nonce
}

const app = createApp(App)
app.provide('wpApiSettings', wpApiSettings)
app.mount('#app')