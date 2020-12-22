<template>
    <div class="container" id="admin-message">
        <div class="d-flex justify-content-between">
            <i class="fas fa-arrow-circle-left fa-2x d-none" id="btn-back-msg"></i>
            <h3 class=" text-center">Messaging</h3>
        </div>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
<!--                        start-->
                        <template v-for="(chat,index) in chats">
                            <div class="chat_list active_chat" @click="clicked(index)">
                                <div class="chat_people">
                                    <div class="chat_img">
                                        <img v-if="chat.avatar === '' || chat.avatar === null" src="/img/avatar_default.png"
                                             alt="sunil">
                                        <img v-else :src="'/storage/avatar/'+chat.avatar"
                                                                alt="sunil">
                                    </div>
                                    <div class="chat_ib">
                                        <h5>{{chat.username}} <span class="chat_date">{{formatTime(chat.messages[chat.messages.length - 1].created_at)}}</span></h5>
                                        <span class="chat_date">{{chat.messages[chat.messages.length - 1].message}}
                                            <div v-if="chat.newMessage" style="height: 20px;width: 20px;background-color: #1b4b72;border-radius: 50%;display:inline-block; float:right;"></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
<!--                        end-->
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history" ref="feed">
<!--                        start-->
                        <template v-for="message in messages">
                            <div class="outgoing_msg" v-if="message.sender.id === parseInt(user)">
                                <div class="sent_msg">
                                    <p>{{message.message}}</p>
                                    <span class="time_date">{{formatDate(message.created_at)}}</span>
                                </div>
                            </div>
                            <div class="incoming_msg" v-else>
                                <div class="incoming_msg_img">
                                    <img v-if="message.sender.avatar === null || message.sender.avatar === ''" src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                    <img v-else :src="'/storage/avatar/'+avatar" alt="sunil"> </div>
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p>{{message.message}}</p>
                                        <span class="time_date">{{formatDate(message.created_at)}}</span>
                                    </div>
                                </div>
                            </div>
                        </template>
<!--                        end-->
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" placeholder="Type a message" v-model="input" @keydown.enter="pushMessage" />
                            <button class="msg_send_btn" type="button" @click="pushMessage"><i class="fa fa-paper-plane-o"
                                                                          aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AdminChatComponent",
        props:['user','avatar'],
        created() {
            Echo.private('chat.'+this.user)
                .listen(".chat", result =>{
                    let message = result;
                    let index = 0;
                    let found = false;
                    for (let chat of this.chats){
                        if (chat.userId === parseInt(message.sender.id)){
                            this.chats[index].messages.push(message);
                            this.chats[index].newMessage = true;
                            found = true;
                            break;
                        }
                        index++;
                    }
                    if (!found){
                        this.chats.push({
                            userId: message.sender.id,
                            username: message.sender.name,
                            avatar: message.sender.avatar,
                            newMessage: true,
                            messages:new Array(message)
                        })
                    }
                });
        },
        mounted() {
            this.fetchMessage();
        },
        data(){
            return{
                indexSelected:0,
                chats:[

                ],
                messages:[],
                input:'',
            }
        },
        methods:{
            formatDate(date){
                let format = new Date(date);
                return format.getDate()+'-'+(format.getMonth()+1)+'-'+format.getFullYear()+' | '+format.getHours()+':'+format.getMinutes()
            },
            formatTime(date){
                let format = new Date(date);
                return format.getHours()+':'+format.getMinutes()
            },
            pushMessage(){
                if (this.input === '')
                    return;
                let component = {
                    sender:{id:parseInt(this.user), avatar:this.avatar},
                    receiver:{
                        id:this.chats[this.indexSelected].messages[0].sender.id,
                        avatar:this.chats[this.indexSelected].messages[0].sender.avatar
                    },
                    message:this.input,
                    created_at:new Date()
                };
                axios.post('/send/message',component).then(result => {
                    console.log(result.data)
                }).catch(err => {
                    console.log(err)
                })
                this.chats[this.indexSelected].messages.push(component);
                this.input = '';
            },
            fetchMessage(){
                axios.get('/admin/chat/fetch/'+this.user).then(result => {
                    this.chats = result.data.data
                }).catch(err => {
                    toastr.error("error")
                })
            },
            scrollBottom(){
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },
            clicked(index){
                this.indexSelected = index;
                this.chats[index].newMessage = false;
                this.messages = this.chats[index].messages;
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
