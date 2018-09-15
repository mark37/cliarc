<template>
  <div>
    <div class="headind_srch">
      <div class="recent_heading">
        <h4>Recent</h4>
      </div>
      <div class="srch_bar">
        <div class="stylish-input-group">
          <input type="text" class="search-bar" v-model="filterText" placeholder="Search">
          <!-- <span class="input-group-addon">
          <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button> -->
          <!-- </span> --> </div>
      </div>
    </div>
    
    <div class="inbox_chat">
      <div v-for="list in message_list">
        <div class="chat_list" v-bind:class="{ active_chat : list.user_id == r_user_id }" @click="selectMessage(list.user_id, list.r_user_id)">
          <div class="chat_people">
            <!-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> -->
            <div class="chat_ib">
              <h5>{{ list.name }}, {{ list.first_name }}  <span class="chat_date"> <p v-if="list.message">{{ list.created_at }}</p></span></h5>
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
    props: ['message_list', 'r_user_id', 'filter'],

    data() {
      return {
        filterText: ''
      }
    },


    watch: {
      // whenever question changes, this function will run
      filterText: function (newFilterText, oldFilterText) {
        // this.answer = 'Waiting for you to stop typing...'
        this.debouncedGetAnswer()
      }
    },

    created: function () {
      this.debouncedGetAnswer = _.debounce(this.getList, 500)
    },
    methods: {
      selectMessage(user_id, r_user_id) {
        this.$emit('selectmessage', {
          user_id: user_id,
          r_user_id: r_user_id
        });
      },

      getList() {
        console.log(this.filterText)
        this.$emit('getlist', {
          filter: this.filterText,
        });
      },

      getAnswer:  function () {
        this.message_list = 'Searching...'
        var vm = this

        axios.get('/messages/list', {params: {filter: filter}}).then(response => {
          console.log(response.data);
          this.message_list = response.data;
          this.r_user_id = this.message_list[0].r_user_id;
          // this.fetchMessages(this.message_list[0]);
        });
        /* axios.get('https://yesno.wtf/api')
          .then(function (response) {
            vm.message_list = response.data.answer
          })
          .catch(function (error) {
            vm.message_list = 'Error! Could not reach the API. ' + error
          }) */
      }
    }
  };
</script>