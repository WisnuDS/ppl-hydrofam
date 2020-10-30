import Vue from 'vue';
import AllPosts from "./views/AllPosts";

require('bootstrap');

new Vue({
    el: '#blog',
    components:{
        'post' : AllPosts
    }
});
