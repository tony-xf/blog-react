import './static/style/common.scss';
import Vue from 'vue';
import vuex from 'vuex';
import VueRouter from 'vue-router'
import App from './App.vue';
import router from './router.js'

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});