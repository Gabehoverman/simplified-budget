/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./enums/TransactionCategories');

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

import TransactionCategories from './enums/TransactionCategories';
import TransactionCategoryColors from './enums/TransactionCategoryColors';
import transactionCategoryIcons from './enums/TransactionCategoryIcons';

Vue.prototype.$transactionCategories = TransactionCategories
Vue.prototype.$transactionCategoryColors = TransactionCategoryColors
Vue.prototype.$transactionCategoryIcons = transactionCategoryIcons

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import Notifications from 'vue-notification'
Vue.use(Notifications);

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import VueMask from 'vue-jquery-mask';
Vue.use(VueMask);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.use(require('vue-moment'));

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
            switch( parseInt(transaction.type) ) {
                case 3:
                    return 'badge-warning'
                case 2:
                    return 'badge-primary'
                case 1:
                    return 'badge-success'
                case 0:
                default:
                    return 'badge-danger'
            }
        },
        getFormattedDate( timestamp ) {
            let formattedDate = new Date( timestamp )
            formattedDate.setDate( formattedDate.getDate() + 1)
            return formattedDate.toDateString()
        },
        getMonthDayYear( timestamp ) {
            let formattedDate = new Date( timestamp )
            formattedDate.setDate( formattedDate.getDate() + 1)
            return formattedDate.getMonth()+1+'/'+formattedDate.getDate() +'/'+formattedDate.getFullYear()
        },
        getAccountLabel( type ) {
            switch( parseInt( type ) ) {
                case 1:
                    return 'Savings'
                case 0:
                default:
                    return 'Checkings'
            }
        },
        getTrackingLabel( type ) {
            switch( parseInt( type ) ) {
                case 2:
                    return 'Expenses Only'
                case 1:
                    return 'Income Only'
                case 0:
                default:
                    return 'Income & Expenses'
            }
        },
        getTransactionType( type ) {
            switch( parseInt( type ) ) {
                case 3:
                    return "Fee"
                case 2:
                    return 'Transfer'
                case 1:
                    return 'Income'
                case 0:
                default:
                    return 'Expense'
            }
        },
        getTrackingTypeLabel( type ) {
            switch( parseInt( type ) ) {
                case 1:
                    return 'Automatic'
                case 0:
                default:
                    return 'Manual'
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
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase()
        },
        formatCurrency ( currency ) {
            currency = parseFloat(currency).toFixed(2);
            return currency.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        formatLogName( name ) {
            var i, frags = name.split('_');
            for (i=0; i<frags.length; i++) {
                frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
            }
            return frags.join(' ');
        },
        asset( url ) {
            return url;
        },
        showNotification( type, message ) {
            Vue.notify({
                group: "notification",
                type: type,
                title: this.formatString(type)+'!',
                text: message,
                duration: 3000
            });
        },
        getLogIcon( log_name ) {
            switch( log_name ) {
                case 'budgets':
                    return '<svg viewBox="0 0 24 24" width="20" height="20" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>'
                default:
                    return '<svg viewBox="0 0 24 24" width="19" height="19" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>';
            }
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
