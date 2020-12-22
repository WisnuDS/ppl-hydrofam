<template>
    <div class="chat-popup" id="myForm" style="background-color: white!important;">
        <div class="container" id="msg-header">
            <div class="row d-flex justify-content-between pt-2">
                <div class="col">Consultation</div>
                <span id="msg-icons-close"><i class="fas fa-times-circle mr-1" onclick="closeForm()"></i></span>
            </div>
        </div>
        <div class="msg-inbox">
            <div class="chats">
                <div class="msg-page" ref="feed">
                    <template v-for="message in messages">
                        <div v-if="parseInt(message.sender.id) === parseInt(user)" class="outgoing-chats">
                            <div class="outgoing-chats-img">
                                <img v-if="message.sender.avatar === null || message.sender.avatar === ''" class="outgoing-chats-img" src="/img/avatar_default.png" alt="">
                                <img v-else class="outgoing-chats-img" :src="'/storage/avatar/'+message.sender.avatar" alt="">
                            </div>
                            <div class="outgoing-msg">
                                <div class="outgoing-msg-inbox">
                                    <p>{{message.message}}</p>
                                    <span class="msg-time-outgoing">{{formatDate(message.created_at)}}</span>
                                </div>
                            </div>
                        </div>
                        <div v-else class="received-chats">
                            <div class="received-chats-img">
                                <img v-if="message.sender.avatar === null || message.sender.avatar === ''" class="chats-img" src="/img/avatar_default.png" alt="">
                                <img class="chats-img" :src="'/storage/avatar/'+message.sender.avatar" alt="">
                            </div>
                            <div class="received-msg">
                                <div class="received-msg-inbox">
                                    <p>{{message.message}}</p>
                                    <span class="msg-time-received">{{formatDate(message.created_at)}}</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="form-container mt-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="write mesage..." v-model="input" @keydown.enter="pushMessage">
                <div class="input-group-append" style="cursor:pointer;">
                <span class="input-group-text">
                    <i class="fas fa-paper-plane"></i>
                </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "UserConsultationComponent",
        props:['user','avatar','name'],
        data(){
            return {
                messages:[],
                input:'',
                receiver:null
            }
        },
        created() {
            console.log('chat'+this.user)
            Echo.private('chat.'+this.user)
                .listen(".chat", (e) => {
                    this.messages.push(e);
                });
        },
        methods:{
            formatDate(date){
                let format = new Date(date);
                return format.getDate()+'-'+(format.getMonth()+1)+'-'+format.getFullYear()+' | '+format.getHours()+':'+format.getMinutes()
            },
            pushMessage(){
                if (this.input === '')
                    return;

                let component = {
                    sender:{id:this.user, avatar:this.avatar, name:this.name},
                    receiver: this.receiver === null ? null : {id:this.receiver.id,avatar:this.receiver.avatar},
                    message:this.input,
                    created_at:new Date()
                };
                axios.post('/send/message',component).then(result => {
                    this.receiver = result.data.data
                }).catch(err => {
                    console.log(err)
                })
                this.messages.push(component);
                this.input = '';
            },
            scrollBottom(){
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }
        },
        watch:{
            messages(){
                setTimeout(()=>{
                    this.scrollBottom();
                },50);
            }
        }
    }
</script>

<style scoped>

</style>
