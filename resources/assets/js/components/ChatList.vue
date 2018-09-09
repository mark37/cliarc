<template>
  <div>
    <div class="headind_srch">
      <div class="recent_heading">
        <h4>Recent</h4>
      </div>
      <div class="srch_bar">
        <div class="stylish-input-group">
          <input type="text" class="search-bar"  placeholder="Search" >
          <span class="input-group-addon">
          <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
          </span> </div>
      </div>
    </div>
    
    <div class="inbox_chat">
      <div v-for="list in message_list">
        <div class="chat_list" v-bind:class="{ active_chat : list.user_id == r_user_id }" @click="selectMessage(list.user_id, list.r_user_id)">
          <div class="chat_people">
            <!-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> -->
            <div class="chat_ib">
              <h5>{{ list.name }}, {{ list.first_name }}  <span class="chat_date"> {{ list.created_at }}</span></h5>
              <p v-if="list.message != null">{{ list.message }}</p>
              <p><a v-if="list.filename != null">{{ list.filename }}</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['message_list', 'r_user_id'],

    methods: {
      selectMessage(user_id, r_user_id) {
        this.$emit('selectmessage', {
          user_id: user_id,
          r_user_id: r_user_id
        });
      },
    }
  };
</script>