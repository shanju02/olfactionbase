require('./bootstrap');
//import Vue from 'vue/dist/vue';
//import swal from 'sweetalert';

Vue.component('chemical-search', require('./components/ChemicalSearch').default);
Vue.component('obp-search', require('./components/ObpSearch').default);
Vue.component('odor-search', require('./components/OdorSearch').default);
Vue.component('or-odorant-search', require('./components/OrOdorantPairSearch').default);
Vue.component('receptor-search', require('./components/ReceptorSearch').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            searchType: null
        }
    },
    methods: {
        changeSearchType(event) {
            this.searchType = event.target.value
        }
    }
})
