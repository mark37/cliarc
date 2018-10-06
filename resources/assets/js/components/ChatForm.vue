<template>
  <div class="input_msg_write">
    <input id="btn-input" type="text" class="write_msg" placeholder="Type a message" v-model="newMessage" @keyup.enter="sendMessage"/>
    <button class="msg_attach_btn">
      <input id="files" ref="files" type="file" multiple v-on:change="handleFiles()" /><i class="fa fa-upload" aria-hidden="true"></i>
    </button>
    <button class="msg_send_btn" id="btn-chat" @click="sendMessage"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
  </div>
</template>

<script>
  import moment from 'moment'

  export default {
    props: ['user', 'r_user_id'],

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
          r_user_id: this.r_user_id,
          created_at: moment().format('YYYY-MM-DD hh:mm:ss')
        });

        this.newMessage = ''
      },

      uploadFiles() {
        this.$emit('addfile', {
          user: this.user,
          files: this.files,
          r_user_id: this.r_user_id,
          created_at: moment().format('YYYY-MM-DD hh:mm:ss')
        });
      },

      handleFiles() {
        let uploadedFiles = this.$refs.files.files;

        for(var i = 0; i < uploadedFiles.length; i++) {
          this.files.push(uploadedFiles[i]);
        }

        this.uploadFiles();
      },
    }    
  }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 100px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 5px 5px;
        min-height: 100px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        /* padding: 50px 50px 50px 50px; */
    }
    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }
</style>