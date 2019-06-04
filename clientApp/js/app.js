/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require("vue");

require("./bootstrap");
import store from "./store";

import Vue from "vue";
import Msg from "vue-message";
import VueLoading from "vue-loading-overlay";
import VueSweetalert2 from "vue-sweetalert2";
import "bootstrap-vue/dist/bootstrap-vue.css";
import VModal from "vue-js-modal";
import VueEvents from "vue-events";
import ToggleButton from "vue-js-toggle-button";

import BootstrapVue from "bootstrap-vue";
Vue.use(VModal, {
  dialog: true
});
Vue.use(ToggleButton);

Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
Vue.use(VueLoading);
Vue.use(VueEvents);
Vue.use(Msg);

Vue.component('chat-list-container', require('./components/Chat-Container'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const app = new Vue({
  el: "#app",
  store
});
