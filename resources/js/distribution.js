import Vue from 'vue'
require('./vue-assets');
import VueSignaturePad from 'vue-signature-pad';
Vue.use(VueSignaturePad);
Vue.component('add-distribution', require('./components/backend/distribution/AddDistribution.vue').default);

var app = new Vue({
    el: '#app',
});
