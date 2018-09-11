<template>
  <div class="msg_history" v-chat-scroll>
    <div v-for="message in messages">
      <div v-if="user_id != message.user.id" class="incoming_msg">
        <div class="received_msg">
        <div class="received_withd_msg">
            <p v-if="message.message != null">{{ message.message }}</p>
            <p><a style="color:#000000" v-if="message.filename != null" :href="route('download_file', {path: message.path, filename: message.filename} )">{{ message.filename }}</a></p>
            <span class="time_date"> {{ message.created_at }} </span>
        </div>
        </div>
      </div>
      <div v-else class="outgoing_msg">
        <div class="sent_msg">
        <p v-if="message.message != null">{{ message.message }}</p>
        <p><a style="color:#000000" v-if="message.filename != null" :href="route('download_file', {path: message.path, filename: message.filename} )">{{ message.filename }}</a></p>
        <span class="time_date"> {{ message.created_at }} </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import VueChatScroll from 'vue-chat-scroll'

  export default {
    props: ['messages', 'user_id'],

    methods: {
      downloadUrl(message) {
        axios.get('download_file', message).then(response => {
          return response.data;
        });
      },
    }
  };
</script>