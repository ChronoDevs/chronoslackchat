<template>
    <div id="chat-container">
        <div class="row justify-content-center h-100">
            <div class="col" id="chat-messages">
                <div class="text-start my-2" v-for="message in messages" :key="message.id">
                    <div :class="{'right-text': isCurrentUserMessage(message), 'left-text': !isCurrentUserMessage(message)}">
                        <div class="container">
                            <div class="row">
                                <div class="col" v-if="message.user">{{ message.user.username }}</div>
                            </div>
                            <div class="row">
                                <div class="col">{{ message.message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <div class="input-group p-3">
                    <input type="text" class="form-control" v-model="inputMessage" @keyup.enter="sendMessage" name="message" :placeholder="placeholderText">
                    <button class="btn btn-secondary" @click="sendMessage" type="button" id="button-addon2"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['channel', 'currentUser'],
    data() {
        return {
            messages: [],
            inputMessage: '',
            placeholderText: ''
        };
    },
    created() {
        this.fetchMessages();
        this.placeholderText = `Message ${this.channel.name}`;

        window.Echo.private('chat').listen('MessageSent', (e) => {
            const newMessage = {
                message: e.message.message,
                user: e.user
            }

            Notification.requestPermission().then(res => {
                if (res === 'granted') {
                    new Notification(`Message from `+ e.user.username, {
                        body: e.message.message,
                        tag: e.user.username
                    })
                }
            })

            this.messages.push(newMessage);
            this.autoScrollToBottom();
        });
    },
    mounted() {
        this.autoScrollToBottom();
    },
    methods: {
        fetchMessages() {
            axios.get(`/messages/${this.channel.id}`).then(response => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            if (this.inputMessage.trim() === '') return;

            axios.post(`/messages/${this.channel.id}`, { message: this.inputMessage })
                .then(response => {
                    this.messages.push(response.data);
                    this.autoScrollToBottom();
            });

            this.inputMessage = '';
        },
        isCurrentUserMessage(message) {
            return message.user.id === this.currentUser.id;
        },
        autoScrollToBottom() {
            setTimeout(() => {
                var height = document.getElementById('chat-messages').scrollHeight;
                document.getElementById('chat-messages').scroll(0 , height);
            }, 900);
        },
    }
}
</script>
<style scoped>
#chat-container {
    background-color: #D9D9D9;
    height: calc(100% - 84px);
    position: relative;
}
#chat-messages {
    max-height: calc(100vh - 368px);
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    position: absolute;
    bottom: 0;
}
.right-text {
    background-color: #1C6EB5;
    color: #FFFFFF;
    border-radius: 5px;
    width: 300px;
    margin-left: auto;
}

.left-text {
    background-color: #94989B;
    color: #FFFFFF;
    border-radius: 5px;
    width: 300px;
    margin-right: auto;
}
</style>