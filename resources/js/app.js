import Vue from 'vue';
import CommentComponent from "./views/CommentComponent";
import ProductComponent from "./components/ProductComponent";

require('bootstrap');

Vue.component('product', require('./components/ProductComponent.vue').default);

new Vue({
    el: '#app',
    components:{
        'comment': CommentComponent,
    }
});
