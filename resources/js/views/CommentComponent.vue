<template>
    <div>
        <h3 class="mb-5">{{comments.length}} Comments</h3>
        <ul class="comment-list">
            <li class="comment" v-for="comment in comments">
                <div class="vcard bio" v-if="comment.user.avatar">
                    <img :src="comment.user.avatar" alt="Image placeholder">
                </div>
                <div class="vcard bio" v-else>
                    <img src="/img/avatar_default.png" alt="Image placeholder">
                </div>
                <div class="comment-body">
                    <h3>{{comment.user.name}}</h3>
                    <div class="meta">{{comment.created_at}}</div>
                    <p>{{comment.comment}}</p>
                </div>
            </li>
        </ul>
        <div class="comment-form-wrap pt-5" v-if="!guest">
            <h3 class="mb-5">Leave a comment</h3>
            <div class="form-group">
                <img v-if="user.avatar !== null" :src="'/storage/'+user.avatar" alt="" class="foto_profil_user mr-10">
                <img v-else src="/img/avatar_default.png" alt="" class="foto_profil_user">
                <label> {{user.name}}</label>
            </div>
            <div class="w-100"></div>
            <div class="form-group">
                <label for="message">Write Comment</label>
                <textarea name="" id="message" cols="30" rows="10" class="form-control" v-model="comment"></textarea>
            </div>
            <div class="form-group">
                <button class="btn py-3 px-4 btn-primary" @click="postComment">Post Comment</button>
            </div>
        </div>
        <div v-else>Login or Sign up for comment</div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "CommentComponent",
        props:['postId','guest'],
        data(){
            return {
                user : {},
                comments:[],
                comment:''
            }
        },
        async mounted() {
            let response = await fetch('/blog/api/auth');
            this.user = await response.json();
            this.loadComments()
        },
        methods:{
            async loadComments(){
                this.comments = [];
                let response = await fetch('/blog/api/comment/'+this.postId)
                this.comments = await response.json()
            },
            postComment(){
                axios.post('/blog/api/create-comment',{
                    _token:window.token,
                    comment:this.comment,
                    post_id:this.postId
                }).then(result => {
                    if (result.data.status === 200){
                        let commentResponse = result.data.comment;
                        commentResponse.user = this.user;
                        this.comments.push(commentResponse)
                        this.comment = ''
                    }
                }).catch(error => {

                })
            }
        }
    }
</script>

<style scoped>

</style>
