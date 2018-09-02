@extends('layouts.app')

@section('content')

<div class="container">
<h3 class=" text-center">Messaging</h3>
  <!-- <div class="card">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Chats</div>
      
          <div class="panel-body">
            <chat-messages :messages="messages"></chat-messages>
          </div>
          <div class="panel-footer">
            <chat-form
                v-on:messagesent="addMessage"
                :user="{{ Auth::user() }}"
            ></chat-form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <div class="messaging">
    <div class="inbox_msg">
      <!-- <div class="inbox_people">
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
          <div class="chat_list active_chat">
            <div class="chat_people">
              <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="chat_ib">
                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                <p>Test, which is a new approach to have all solutions 
                  astrology under one roof.</p>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="mesgs">
        <chat-messages :messages="messages" :user_id="{{ Auth::user()->id }}"></chat-messages>
        <!-- <div class="msg_history">
          <div class="incoming_msg">
            <div class="received_msg">
              <div class="received_withd_msg">
                <p>Test which is a new approach to have all
                  solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span>
              </div>
            </div>
          </div>
          <div class="outgoing_msg">
            <div class="sent_msg">
              <p>Test which is a new approach to have all
                solutions</p>
              <span class="time_date"> 11:01 AM    |    June 9</span>
            </div>
          </div>
        </div> -->

        <div class="type_msg">
          <chat-form
              v-on:messagesent="addMessage"
              :user="{{ Auth::user() }}"
          ></chat-form>
        </div>
      </div>
    </div>      
  </div>
</div>
@endsection