require('./bootstrap');
window.Vue = require('vue').default;

import App from './components/App.vue';
import router from './routes';
import Vue from 'vue';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    router,
    el: '#app',
    components: {
        'app-component': App
    }
});
