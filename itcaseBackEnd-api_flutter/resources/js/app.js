/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue home_components. It will recursively scan this directory for the Vue
 * home_components and automatically register them with their "basename".
 *
 * Eg. ./home_components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('chat-component', require('./components/ChatComponent.vue').default);

Vue.use(require('vue-chat-scroll'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding home_components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
