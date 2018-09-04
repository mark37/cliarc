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
      <chat-list :list="messages" :user_id="{{ Auth::user()->id }}"></chat-messages>

      <div class="mesgs">
        <chat-messages :messages="messages" :user_id="{{ Auth::user()->id }}"></chat-messages>

        <div class="type_msg">
          <chat-form
              v-on:messagesent="addMessage"
              v-on:addfile="uploadFile"
              :user="{{ Auth::user() }}"
          ></chat-form>
        </div>
      </div>
    </div>      
  </div>
</div>
@endsection