/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import {
    Form,
    HasError,
    AlertError
} from 'vform';

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));


import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

let routes = [{
        path: '/dashboard',
        component: require('./components/Dashboard.vue')
    },
    {
        path: '/users',
        component: require('./components/user/Users.vue')
    },
    {
        path: '/penyewa',
        component: require('./components/penyewa/Users.vue')
    },
    {
        path: '/pesewa',
        component: require('./components/pesewa/Users.vue')
    },
    {
        path: '/locations',
        component: require('./components/location/Locations.vue')
    },
    {
        path: '/tenant/:id',
        component: require('./components/locationtenant/Locations.vue')
    },
    {
        path: '/tenants',
        component: require('./components/tenan/Tenant.vue')
    },
    {
        path: '/setor',
        component: require('./components/setor/Setor.vue')
    },
    {
        path: '/daftar-penyewa',
        component: require('./components/daftarpenyewa/DaftarPenyewa.vue')
    },
    {
        path: '/contact-us',
        component: require('./components/contact-us/ContactUs.vue')
    },
    {
        path: '/transaksi',
        component: require('./components/transaksi/Transaksi.vue')
    },
    {
        path: '/pendapatan',
        component: require('./components/pendapatan/Pendapatan.vue')
    },
    {
        path: '/tunggakan',
        component: require('./components/tunggakan/Tunggakan.vue')
    },
    {
        path: '/perusahaan',
        component: require('./components/perusahaan/Users.vue')
    },
    {
        path: '/tarif',
        component: require('./components/tarif/Tarif.vue')
    },
    {
        path: '/kategori',
        component: require('./components/kategori/Kategori.vue')
    },
    {
        path: '/profile',
        component: require('./components/profile/Users.vue')
    },
    {
        path: '*',
        component: require('./components/NotFound.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})



Vue.filter('upText', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate', function (created) {
    return moment(created).format('DD-MM-YYYY');
});


window.Fire = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component(
    'not-found',
    require('./components/NotFound.vue')
);


Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    methods: {
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        }, 1000),

        printme() {
            window.print();
        }
    }
});
