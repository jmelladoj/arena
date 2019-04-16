
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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('atleta', require('./components/Atleta.vue').default);
Vue.component('individual', require('./components/Individual.vue').default);
Vue.component('duplas', require('./components/Duplas.vue').default);
Vue.component('trios', require('./components/Trios.vue').default);
Vue.component('categoria', require('./components/Categoria.vue').default);
Vue.component('venta', require('./components/Venta.vue').default);
Vue.component('polera', require('./components/Polera.vue').default);
Vue.component('home', require('./components/Home.vue').default);
Vue.component('pendiente', require('./components/Pendiente.vue').default);
Vue.component('invitado', require('./components/Invitado.vue').default);
Vue.component('todos', require('./components/Todos.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
