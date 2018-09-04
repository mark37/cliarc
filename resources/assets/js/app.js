
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-list', require('./components/Chatlist.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.mixin({
  methods: {
      route: route
  }
});
import moment from 'moment'

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();

        Echo.private('cliarc-development')
        .listen('MessageSent', (e) => {
            this.messages.push({
            message: e.message.message,
            user: e.user
            });
        });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        },

        uploadFile(data) {
          for( let i = 0; i < data.files.length; i++ ){
            if(data.files[i].id) {
                continue;
            }
            let formData = new FormData();
            formData.append('file', data.files[i]);
            formData.append('r_user_id', 1);
            formData.append('user_id', data.user.id);

            axios.post('/messages/upload_file',
                formData,
                {
                  headers: {
                    'Content-Type': 'multipart/form-data'
                  }
                }
            ).then(function(res) {
              data.files[i].id = res['data']['id'];
              data.files.splice(i, 1, data.files[i]);
              this.messages.push({
                message: null,
                user: {'id': data.user.id},
                path: res['data']['path'],
                filename: res['data']['filename'],
                created_at: moment().format('YYYY-MM-DD hh:mm:ss')
              });
              console.log('success');
            }.bind(this)).catch(function(data) {
              console.log(data);
            });
          }
        },
    }
});
