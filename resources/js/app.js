import Vue from 'vue';
import CommentComponent from "./views/CommentComponent";

require('bootstrap');

new Vue({
    el: '#blog',
    components:{
        'comment': CommentComponent,
    }
});
