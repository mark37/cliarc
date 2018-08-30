<template>
    <!-- <div class="input-group">
      <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

      <span class="input-group-btn">
        <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
          Send
        </button>
      </span>
    </div> -->

    <div class="input_msg_write">
      <input id="btn-input" type="text" class="write_msg" placeholder="Type a message" v-model="newMessage" @keyup.enter="sendMessage"/>
      
      <button class="msg_attach_btn" id="btn-attach" @click="uploadFile" v-show="files.length > 0"><i class="fa fa-upload" aria-hidden="true"></i></button>
      <button class="msg_send_btn" id="btn-chat" @click="sendMessage"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>

      <div class="card">
        <div class="card-body">
          <input id="files" ref="files" type="file" multiple v-on:change="handleFiles()" />
          <div v-for="(file, key) in files" class="file-listing">
            <i class="fa fa-file" aria-hidden="true"></i> {{ file.name }}
            <div class="success-container" v-if="file.id > 0">
                Success
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import moment from 'moment'

  export default {
    props: ['user'],

    data() {
      return {
        newMessage: '',
        files: []
      }
    },

    methods: {
      sendMessage() {
        this.$emit('messagesent', {
          user: this.user,
          message: this.newMessage,
          created_at: moment().format('YYYY-MM-DD hh:mm:ss')
        });

        this.newMessage = ''
      },

      uploadFile() {
        this.$emit('uploadfile', {
          user: this.user,
          message: this.newMessage,
          created_at: moment().format('YYYY-MM-DD hh:mm:ss')
        });

        this.newMessage = ''
      },

      handleFiles() {
        let uploadedFiles = this.$refs.files.files;

        for(var i = 0; i < uploadedFiles.length; i++) {
            this.files.push(uploadedFiles[i]);
        }
      },

      
    }    
  }
</script>