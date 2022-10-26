import Vue from 'vue'
require('./vue-assets');
Vue.component('create-stock', require('./components/backend/stock/create-stock.vue').default);
var app = new Vue({
    el: '#app',
});

