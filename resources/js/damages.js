import Vue from 'vue'
require('./vue-assets');
import VueSignaturePad from 'vue-signature-pad';
Vue.use(VueSignaturePad);

Vue.component('create-damages', require('./components/backend/damages/create-damages.vue').default);

var app = new Vue({
    el: '#app',
});

