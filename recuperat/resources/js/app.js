
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
import VueCarousel from 'vue-carousel';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
Vue.use(VueCarousel);
Vue.component('terapeutic-plan-component', require('./components/TerapeuticPlan/TerapeuticPlanComponent.vue').default);
Vue.component('home-physiotherapy-program-component', require('./components/HomePhysiotherapyProgram/HomePhysiotherapyProgramComponent.vue').default);
Vue.component('job-analysis-component', require('./components/JobAnalysis/Create.vue').default);
Vue.component('decision-component', require('./components/Decision/DecisionComponent.vue').default);
Vue.component('session-component', require('./components/Session/SessionComponent.vue').default);
Vue.component('weight-lifting-component', require('./components/WeightLifting/WeightLiftingComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/themes/base/all.css';
import 'jquery-ui/ui/widgets/autocomplete.js';
