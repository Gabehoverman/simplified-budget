/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

/**
 * Mixin global functions
 */

Vue.mixin({
    methods: {
        capitalizeFirstLetter: str => str.charAt(0).toUpperCase() + str.slice(1),
        getInitials(fname, lname) {
            let first = " ";
            let last = " ";
            if (fname != null) {
                first = fname.substring(0, 1).toUpperCase()
            }
            if (lname != null) {
                last = lname.substring(0, 1).toUpperCase()
            }
            return String(first) + String(last);
        },
        getBadgeType( transaction ) {
            switch( transaction.type ) {
                case 2:
                    return 'badge-warning'
                case 1:
                    return 'badge-success'
                case 0:
                default:
                    return 'badge-danger'
            }
        },
        getFormattedDate( timestamp ) {
            let formattedDate = new Date( timestamp )
            return formattedDate.toDateString()
        },
        getAccountLabel( type ) {
            switch( type ) {
                case 1:
                    return 'Savings'
                case 0:
                default:
                    return 'Checkings'
            }
        },
        getTrackingLabel( type ) {
            switch( type ) {
                case 2:
                    return 'Expenses Only'
                case 1:
                    return 'Income Only'
                case 0:
                default:
                    return 'Income & Expenses'
            }
        },
        getInitials( string ) {
            let name = ''
            let sections = string.split(' ');
            sections.forEach( function( section) {
                name = name + section.substring(0,1).toUpperCase()
            })
            return name
        },
        formatString( string ) {
            return string.charAt(0).toUpperCase() + string.slice(1)
        },
        asset( url ) {
            return url;
        },
        async asyncFetchData(url) {
            return await fetch(url, {
                method: 'GET',
                credentials: 'same-origin',
                headers: new Headers({
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }),
            })
            .then(function (response) {
                return response.json();
            })
        },
        async asyncSendData(data, url, method) {
            var response = await fetch(url, {
                method: method,
                credentials: 'same-origin',
                headers: new Headers({
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }),
                body: JSON.stringify(data),
            })
            .then(function (response) {
                return response.json();
            })

            return response
        }
    }
});

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
