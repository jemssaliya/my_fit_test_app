import Config from './config'

require('./bootstrap');

import Vue from 'vue';
window.Vue = Vue;


const configs = {
    BASE_URL: window.location.origin
}

Vue.use(Config, configs)

Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('page', require('./components/Page.vue').default);
Vue.component('client', require('./views/Client.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('footer', require('./components/Footer.vue').default);
Vue.component('clientform', require('./components/forms/FormClient.vue').default);
Vue.component('test', require('./views/Test.vue').default);
Vue.component('viewtest', require('./views/ViewTest.vue').default);
Vue.component('program', require('./views/Program.vue').default);
Vue.component('viewprogram', require('./views/ViewProgram.vue').default);
Vue.component('comparetest', require('./views/CompareTest.vue').default);
Vue.component('my-vuetable', require('./components/MyVuetable.vue').default);

const app = new Vue({
    el: '#app'
});
