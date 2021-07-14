<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container
                        :messages="messages"
                    />
                    <input-message
                        :room="currentRoom"
                        v-on:messagesent="getMessages()"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
import MessageContainer from './messageContainer.vue'
import InputMessage from './inputMessage.vue'
import chatRoomSelection from './chatRoomSelection.vue'
    export default {
        components: {
            AppLayout,
            chatRoomSelection,
            MessageContainer,
                InputMessage,
        },
        data: function(){
            return{
                chatRooms:[],
                currentRoom:[],
                messages:[],
            }
        },
        watch:{
            //should have the same variable to trigger
            currentRoom(newVal,oldVal){
                if(oldVal.id){
                    this.disconnect(oldVal.id)
                }
                this.connect();
            }
        },
        methods:{

            //method to connect to pusher
            connect(){
                if(this.currentRoom.id){
                    let vm=this;
                    this.getMessages();
                    //private channel
                    window.Echo.private("chat."+this.currentRoom.id)
                    .listen('.message.new',e=>{
                        vm.getMessages();
                    })
                }
            },
            disconnect(room){
                window.Echo.leave("chat."+room.id);
            },
            getRooms(){
                axios.get('/chat/rooms')
                .then(response=>{
                    console.log(response.data)
                    this.chatRooms=response.data;
                    this.setRoom(response.data[0]);
                })
            },
            setRoom ( room ){
                console.log(room);
                this.currentRoom = room;
            },
            getMessages(){
                axios.get('/chat/room/'+this.currentRoom.id+"/messages")
                .then(response =>{

                    this.messages=response.data;
                })
                .catch(error =>console.log(error));
            }
        },
        created(){
            this.getRooms();

        }
    }
</script>
