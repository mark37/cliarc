<template>
  <div class="inbox_people">
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
    
    <div class="inbox_chat" v-for="list in message_list">
      <div class="chat_list active_chat">
        <div class="chat_people">
          <!-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> -->
          <div class="chat_ib">
            <h5>{{ list.name }} <span class="chat_date">Dec 25</span></h5>
            <p>Test, which is a new approach to have all solutions 
              astrology under one roof.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['message_list'],
  };
</script>