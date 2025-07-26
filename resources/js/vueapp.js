import Vue from 'vue'
import VueRouter from 'vue-router'
// Components / Views
import App from './components/App'
import Welcome from './components/Welcome'
import Login from './components/Login'
import CreateClient from './components/CreateClient'
import Client from './views/Client'
import AddClient from './views/AddClient'
import Test from './views/Test'
import Program from './views/Program'
// depen
import axios from 'axios'
import VueAxios from 'vue-axios'
// import VueAuth from '@websanova/vue-auth'
import auth from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';
import Config from './config'
import Snotify from 'vue-snotify'
import VueMoment from 'vue-moment'
import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js'
import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js'
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js'  



const configs = {
    BASE_URL: process.env.NODE_ENV === 'development' ? 'http://localhost:8000' : window.location.origin,
    API_KEY: 'NAUbq7RqhxYMwtDbppizZwT733YJFbCoWHYfMA5B'
}


Vue.use(VueRouter);
Vue.use(Config, configs);
Vue.use(Snotify, {
    toast: {timeout: 0, position: 'centerTop'}
});

Vue.use(VueAxios, axios);
Vue.axios.defaults.baseURL = configs.BASE_URL;
Vue.axios.defaults.headers.common['Content-Type'] = 'application/json';
Vue.axios.defaults.headers.common['Accept'] = 'application/json';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login,
            props: {title: "This is the login"},

        },
        {
            path: '/home',
            name: 'welcome',
            component: Welcome,
            props: {title: "This is the home"}
        },
        {
            path: '/clients',
            name: 'Client',
            component: Client,
            props: {
                title: "This is the Second Page",
                author: {
                    name: "huh",
                    role: "Software Engineer",
                    code: "Always keep it clean"
                }
            },
            children: [
                {
                    path: 'create',
                    component: CreateClient
                },
            ]
        },
        {
            path: '/add-client',
            name: 'Add Client',
            component: AddClient,
            props: {title: "This is the home"}
        },
        {
            path: '/test',
            name: 'New Test',
            component: Test,
            props: {title: "Start new test"}
        },
        {
            path: '/program',
            name: 'New Program',
            component: Program,
            props: {title: "Start new program"}
        },
    ],
});

Vue.router = router;

// Vue.use(VueAuth, {
//     auth: driverAuthBearer,
//     http: driverHttpAxios,
//     router: driverRouterVueRouter
    // auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    // http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    // router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
// });

Vue.use(auth, {
  plugins: {
    http: Vue.axios,      // or axios if using axios directly
    router: Vue.router,   // the router you set
  },
  drivers: {
    auth: driverAuthBearer,
    http: driverHttpAxios,
    router: driverRouterVueRouter,
  },
});

Vue.use(VueMoment);

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
