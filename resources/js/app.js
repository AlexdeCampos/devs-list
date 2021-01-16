window.Vue = require('vue');

import VueRouter from "vue-router"
import routes from "./routes";
import App from './views/App.vue'
import store from './store'
import Vuelidate from "vuelidate";
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import '../css/sass/_spectre.scss'
import '@fortawesome/fontawesome-free/css/all.min.css'
import money from 'v-money'
import components from './components';
import filters from './filters'

Vue.use(filters)
Vue.use(components)
Vue.use(Toaster, { timeout: 5000 })
Vue.use(VueRouter)
Vue.use(Vuelidate)
Vue.use(money, { precision: 2 })

const router = new VueRouter({ routes })

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});