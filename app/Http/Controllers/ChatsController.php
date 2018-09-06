<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Input;
use Storage;
use File;
use Response;
use DB;

class ChatsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show chats
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('chat');
  }

  /**
   * Fetch all messages
   *
   * @return Message
   */
  public function fetchMessagesList(Request $request){
    // return env('DB_DATABASE', 'test');
    $user = Auth::user();

    $receive =  Message::join('users','users.id','=','messages.user_id')
                ->where('r_user_id','=',$user->id)
                ->groupBy('messages.user_id')
                ->orderBy('messages.created_at')
                ->get(['messages.id as id', 'users.name as name', 
                        'messages.message as message', 'messages.filename as filename', 
                        'messages.created_at as created_at', 'messages.user_id as user_id', 
                        'messages.r_user_id as r_user_id'])->toArray();

    $message_list = array();
    $send_id = array();

    foreach($receive as $key => $value){
      array_push($message_list, $value);
      array_push($send_id, $value['user_id']);
    }

    $sent =  Message::join('users','users.id','=','messages.r_user_id')
                ->where('user_id','=',$user->id)
                ->whereNotIn('r_user_id', $send_id)
                ->groupBy('messages.r_user_id')
                ->orderBy('messages.created_at')
                ->get(['messages.id as id', 'users.name as name', 
                        'messages.message as message', 'messages.filename as filename', 
                        'messages.created_at as created_at', 'messages.user_id as r_user_id', 
                        'messages.r_user_id as user_id'])->toArray();

    foreach($sent as $key => $value){
      array_push($message_list, $value);
      array_push($send_id, $value['user_id']);
    }

    usort($message_list, array($this, 'date_compare_d'));

   /*  $contact = User::whereNotIn('id', $send_id)
              ->get() */
    return $message_list;
    //     ->orWhere('user_id','=',$user->id) return $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
  }

  /**
   * Fetch all messages
   *
   * @return Message
   */
  public function fetchMessages(Request $request)
  {
    $user = Auth::user();

    $receive =  Message::with('user')
          ->where('r_user_id','=',$user->id)
          ->where('user_id', '=', $request->input('user_id'))
          ->orderBy('created_at', 'DESC')
          ->get()->toArray();
    
    $sent = Message::with('user')
          ->where('user_id','=',$user->id)
          ->where('r_user_id', '=', $request->input('user_id'))
          ->orderBy('created_at', 'DESC')
          ->get()->toArray();

    $messages = array();

    foreach($receive as $key => $value){
      array_push($messages, $value);
    }

    foreach($sent as $key => $value){
      array_push($messages, $value);
    }

    usort($messages, array($this, 'date_compare'));

    return $messages;
    //get messages for logged user
  }

  function date_compare($a, $b)
  {
    $t1 = strtotime($a['created_at']);
    $t2 = strtotime($b['created_at']);
    return $t1 - $t2;
  }    

  function date_compare_d($a, $b)
  {
    $t1 = strtotime($a['created_at']);
    $t2 = strtotime($b['created_at']);
    return $t2 - $t1;
  }
  /**
   * Persist message to database
   *
   * @param  Request $request
   * @return Response
   */
  public function sendMessage(Request $request)
  {
    $user = Auth::user();

    $message = $user->messages()->create([
      'message' => $request->input('message'),
      'r_user_id' => $request->input('r_user_id')
    ]);

    broadcast(new MessageSent($user, $message))->toOthers();
    return ['status' => 'Message Sent!'];
  }

  public function downloadFile(Request $request){
    $path = storage_path().'/files/uploads/'.$request->input('path').'/'.$request->input('filename');
    if(file_exists($path)) {
      return Response::download($path);
    }
  }
  
  public function uploadFile(Request $request) {
    $user = Auth::user();
    $file = Input::file('file');
    $filename = $file->getClientOriginalName();
    $r_user_id = Input::get('r_user_id');
    $user_id = Input::get('user_id');
    $path = hash( 'sha256', time());

    if(Storage::disk('uploads')->put($path.'/'.$filename,  File::get($file))) {
      $message = $user->messages()->create([
        'r_user_id' => $r_user_id,
        'filename' => $filename,
        'user_id' => $user_id,
        'mime' => $file->getClientMimeType(),
        'path' => $path,
        'size' => $file->getClientSize()
      ]); //create new message entry

      return response()->json([
        'success' => true,
        'id' => $message->id,
        'path' => $path,
        'filename' => $filename,
        'created_at' => $message->created_at
      ], 200);

      broadcast(new MessageSent($user, $message))->toOthers();

      return response()->json([
          'success' => false
      ], 500);
    }
  }
}
