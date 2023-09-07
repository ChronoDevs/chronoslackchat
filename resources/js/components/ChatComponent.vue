<template>
    <div class="messages-container flex-1">
        <div class="row gx-0 flex-column h-100">
            <div class="col">
                <div class="overflow-messages h-100">
                    <div class="message-list">
                        <div class="message-content p-3 d-flex">
                            <div class="user-image pe-2">
                                <div class="row gx-0">
                                    <div class="col">
                                        <img :src="'/storage/img/default-profile-pic.jpg'" width="50" height="50" class="user-avatar rounded-circle" alt="User Avatar">
                                    </div>
                                </div>
                            </div>
                            <div class="message-details d-flex flex-column">
                                <div class="row gx-0 row-cols-auto align-items-center">
                                    <div class="user-full name fw-semibold col pe-2">Ian John Baid</div>
                                    <div class="message-date-time col">1:37 PM</div>
                                </div>
                                <div class="user-message">
                                    <div class="row gx-0 flex-column">
                                        <div class="col">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean 
                                            commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus 
                                            et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, 
                                            ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis 
                                            enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim 
                                            justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede 
                                            mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean 
                                            vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, 
                                            enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="send-message-container flex-0-3">
        <div class="row gx-0 flex-column h-100">
            <div class="col p-4">
                <div class="texteditor-container d-flex flex-column h-100 rounded-3">
                    <div class="custom-toolbar border-0 flex-0-5" id="custom-toolbar">
                        <div class="row gx-0 align-items-center h-100">
                            <div class="col">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                            </div>
                        </div>
                    </div>
                    <div class="quill-container flex-1">
                        <div class="row gx-0 align-items-center h-100">
                            <div class="col">
                                <QuillEditor toolbar="#custom-toolbar" v-model:content="inputMessage" :placeholder="placeholderText"/>
                            </div>
                        </div>
                    </div>
                    <div class="custom-footer flex-0-5">
                        <div class="row gx-0 align-items-center h-100">
                            <div class="col p-2"><!--  --></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex flex-column h-100">
        <div class="message-content-container" style="flex: 1;">
            <div class="messages-overflow">
                <div class="chat-items ms-3 mb-3 d-flex">
                    <div class="chat-user-img p-2">
                        <div class="row">
                            <div class="col-auto">
                                <img :src="'/storage/img/default-profile-pic.jpg'" width="50" height="50" class="user-avatar rounded-circle" alt="User Image">
                            </div>
                        </div>
                    </div>
                    <div class="chat-user-info d-flex flex-column p-2">
                        <div class="row align-items-center">
                            <div class="col-auto fw-semibold">
                                Ian John Baid
                            </div>
                            <div class="chat-date-time col-auto">
                                1:37 PM
                            </div>
                        </div>
                        <div class="row flex-column">
                            <div class="col-auto">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean 
                                commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus 
                                et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, 
                                ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis 
                                enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim 
                                justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede 
                                mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean 
                                vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, 
                                enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="send-message-container" style="flex: 0.2;">
            <div class="row h-100">
                <div class="col h-100">
                    <div class="ql-container-test">
                        <div class="ql-color">
                            <QuillEditor toolbar="snow"/>
                            <span class="buttonSend"><i class="bi bi-send"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>
<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    components: {
        QuillEditor
    },
    data() {
        return {
            inputMessage: '',
            placeholderText: 'Message Channel'
        }
    }
}   
</script>
<style scoped>
    .overflow-messages {
        max-height: calc(100vh - 266px);
        overflow-y: auto;
    }
    .message-date-time {
        font-size: 10px;
    }
    .texteditor-container {
        background-color: #848383;
        border: 2px solid #FFFFFF;
    }
    .quill-container {
        border-width: 2px 0px 2px 0px;
        border-style: solid;
        border-color: #FFFFFF;
    }
    .flex-1 {
        flex: 1;
    }
    .flex-0-5 {
        flex: 0.5;
    }
    .flex-0-3 {
        flex: 0.3;
    }
</style>

<!-- <style scoped>
    .ql-container-test {
        height: inherit;
        padding: 20px;
    }
    .ql-container-test .ql-color {
        position: relative;
        background-color: grey;
        color: #fff;
        border: 1px solid #fff;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .ql-container-test .ql-color .ql-container.ql-snow {
        border: 1px solid #fff;
        border-bottom-left-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }

    .buttonSend {
        position: absolute;
        right: 10px;
        top: 55%;
        transform: translateX(-50%);
        font-size: 20px;
    }
    .ql-container-test .ql-color .ql-container.ql-snow .ql-editor {
        border-radius: 20px !important;
    }
    .messages-overflow {
        max-height: 621px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .chat-date-time {
        font-size: 10px;
    }
    .quill-text-area.ql-container {
        width: calc(100vw - 410px);
    }
    .send-message-button.input-group-text {
        background-color: #848383;
        border-radius: 0;
    }
</style> -->


<!-- Old code -->

<!-- <template>
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
                                <div class="col" v-html="message.message" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer h-200px">
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="inputMessage" @keyup.enter="sendMessage" name="message" :placeholder="placeholderText">
                    <button class="btn btn-secondary btn-send-custom" @click="sendMessage" type="button" id="button-addon2"><i class="bi bi-send-fill"></i></button>
                </div>

                <div class="input-group input-group-custom">
                    <QuillEditor v-model:content="inputMessage" contentType="html" :options="editorOptions" class="quill-custom"/>
                    <input type="text" class="form-control" v-model="inputMessage" @keyup.enter="sendMessage" name="message" :placeholder="placeholderText">

                    <button class="btn btn-secondary btn-send-custom" @click="sendMessage" type="button" id="button-addon2"><i class="bi bi-send-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
    
    
</template> -->

<!-- <script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
export default {
    components: {
        QuillEditor
    },
    props: ['channel', 'currentUser'],
    data() {
        return {
            messages: [],
            inputMessage: '',
            placeholderText: '',
            editorOptions: {
                modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ],
                toolbar: 'none'
                },
                theme: 'snow'
            },
            isEditorDisabled: false
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
</script> -->

<!-- <style scoped>
#chat-container {
    background-color: #D9D9D9;
    height: calc(100% - 86px);
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

</style> -->