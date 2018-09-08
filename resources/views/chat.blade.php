@extends('layouts.app')

@section('content')

<div class="container">
  <h3 class=" text-center">Messaging</h3>
  <div class="messaging">
    <div class="inbox_msg">
      <div class="inbox_people">
        <chat-list v-on:selectmessage="fetchMessages" :message_list="message_list" :r_user_id="r_user_id"  :user_id="{{ Auth::user()->id }}"></chat-messages>
      </div>
      <div class="mesgs">
        <chat-messages :messages="messages" :user_id="{{ Auth::user()->id }}"></chat-messages>

        <div class="type_msg">
          <chat-form
              v-on:messagesent="addMessage"
              v-on:addfile="uploadFile"
              :user="{{ Auth::user() }}"
              :r_user_id="r_user_id" 
          ></chat-form>
        </div>
      </div>
    </div>      
  </div>
</div>
@endsection