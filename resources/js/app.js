import Vue from 'vue';
import axios from 'axios';
import CommentComponent from "./views/CommentComponent";
import ProductComponent from "./components/ProductComponent";

// require('bootstrap');

Vue.component('product', require('./components/ProductComponent.vue').default);
Vue.component('cart', require('./components/CartComponent.vue').default);

new Vue({
    el: '#app',
    components:{
        'comment': CommentComponent,
    },
    data:{
        totalCart : 0,
        role: window.role,
        cart:[]
    },
    mounted(){
        if (this.role === 'user'){
            this.loadCart()
        }
    },
    methods:{
        loadCart(){
            axios.get("/api/cart/all").then(result => {
                if (result.data.status === 200){
                    this.totalCart = result.data.data.length
                    this.cart = result.data.data
                }else {
                    console.log(result.data)
                    toastr.error("Unable to load your cart")
                }
            }).catch(err => {
                toastr.error("Unable to load your cart")
            })
        }
    }
});
