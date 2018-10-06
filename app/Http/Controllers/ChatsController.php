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

    $user = Auth::user();
    $message_list = array();
    $send_id = array();

    if($request->input('filter') != ''){
      $contacts = User::where('id', '<>', $user->id);

      if($user->account_type == 'CL'){
        $contacts = $contacts->where('account_type', '=', 'EM');
      }else if($user->account_type == 'EM'){
        $contacts = $contacts->where('account_type', '=', 'EM');
      }

      $contacts = $contacts->where('name','LIKE','%' . $request->input('filter') . '%')->orWhere('first_name','LIKE','%' . $request->input('filter') . '%')
                  ->get()
                  ->toArray();
      
      foreach($contacts as $key => $value){
        if($value['id'] != $user->id){
          
          $got_one = 0;
          $receive =  Message::join('users','users.id','=','messages.r_user_id')
                    ->where('r_user_id', '=', $value['id'])
                    ->where('user_id', '=', $user->id)
                    // ->groupBy('messages.user_id')
                    ->orderBy('messages.created_at','DESC')
                    ->limit(1)
                    ->get(['messages.id as id', 'users.name as name', 'users.first_name as first_name',
                            'messages.message as message', 'messages.filename as filename', 
                            'messages.created_at as created_at', 'messages.user_id as r_user_id', 
                            'messages.r_user_id as user_id'])->toArray();

          if(sizeof($receive)>0){
            foreach($receive as $key => $value){
              array_push($message_list, $value);
              array_push($send_id, $value['user_id']);
            }
            $got_one = 1;
          }

          $sent =  Message::join('users','users.id','=','messages.user_id')
                      ->where('user_id','=', $value['id'])
                      ->where('r_user_id', '=', $user->id)
                      ->whereNotIn('r_user_id', $send_id)
                      // ->groupBy('messages.r_user_id')
                      ->orderBy('messages.created_at','DESC')
                      
                      ->limit(1)
                      ->get(['messages.id as id', 'users.name as name', 'users.first_name as first_name',
                      'messages.message as message', 'messages.filename as filename', 
                      'messages.created_at as created_at', 'messages.user_id as r_user_id', 
                      'messages.r_user_id as user_id'])->toArray();

          if(sizeof($sent)>0){
            foreach($sent as $key => $value){
              array_push($message_list, $value);
              array_push($send_id, $value['user_id']);
            }
            $got_one = 1;
          }

          usort($message_list, array($this, 'date_compare_d'));
          
          if($got_one == 0){
            $value['user_id'] = $value['id'];
            $value['r_user_id'] = $user->id;
            array_push($message_list, $value);
          } 
        }
      }
      return $message_list;
    }
    /* if($request->input('filter') != ''){
      $contacts = User::leftJoin('messages','users.id','=','messages.r_user_id')
                  ->where('users.id','<>', $user->id);

      if($user->account_type == 'CL'){
        $contacts = $contacts->where('account_type', '=', 'EM');
      }else if($user->account_type == 'EM'){
        $contacts = $contacts->where('account_type', '=', 'EM');
      }

      $contacts = $contacts->where('name','LIKE','%' . $request->input('filter') . '%')->orWhere('first_name','LIKE','%' . $request->input('filter') . '%')
                            ->groupBy('users.id')
                            ->orderBy('messages.created_at')
                            ->get(['messages.id as id', 'users.name as name', 'users.first_name as first_name',
                            'messages.message as message', 'messages.filename as filename', 
                            'messages.created_at as created_at', 'users.id as user_id', 
                            'messages.r_user_id as r_user_id'])
                            ->toArray();
      
      foreach($contacts as $key => $value){
        $value['r_user_id'] = $user->id;
        array_push($message_list, $value);
      }

      return $message_list;
    } */

    $receive =  Message::join('users','users.id','=','messages.user_id')
                ->where('r_user_id','=',$user->id)
                ->groupBy('messages.user_id')
                ->orderBy('messages.created_at')
                ->get(['messages.id as id', 'users.name as name', 'users.first_name as first_name',
                        'messages.message as message', 'messages.filename as filename', 
                        'messages.created_at as created_at', 'messages.user_id as user_id', 
                        'messages.r_user_id as r_user_id'])->toArray();

    

    foreach($receive as $key => $value){
      array_push($message_list, $value);
      array_push($send_id, $value['user_id']);
    }

    $sent =  Message::join('users','users.id','=','messages.r_user_id')
                ->where('user_id','=',$user->id)
                ->whereNotIn('r_user_id', $send_id)
                ->groupBy('messages.r_user_id')
                ->orderBy('messages.created_at')
                ->get(['messages.id as id', 'users.name as name', 'users.first_name as first_name',
                'messages.message as message', 'messages.filename as filename', 
                'messages.created_at as created_at', 'messages.user_id as r_user_id', 
                'messages.r_user_id as user_id'])->toArray();

    foreach($sent as $key => $value){
      array_push($message_list, $value);
      array_push($send_id, $value['user_id']);
    }

    usort($message_list, array($this, 'date_compare_d'));

    $contacts = User::whereNotIn('id', $send_id)
                ->where('id','<>', $user->id);

    if($user->account_type == 'CL'){
      $contacts = $contacts->where('account_type', '=', 'EM');
    }else if($user->account_type == 'EM'){
      $contacts = $contacts->where('account_type', '=', 'EM');
    }else{

    }

    if($request->input('filter') != ''){
      $contacts = $contacts->where('name','LIKE','%' . $request->input('filter') . '%')->orWhere('first_name','LIKE','%' . $request->input('filter') . '%');
    }

    $contacts = $contacts->get(['name','first_name', 'id as user_id'])->toArray();
    
    foreach($contacts as $key => $value){
      $value['r_user_id'] = $user->id;
      array_push($message_list, $value);
    }

    return $message_list;
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
    if($request->input('auto_reply') == 'Y'){
      Message::create([
        'message' => $request->input('message'),
        'r_user_id' => $request->input('r_user_id'),
        'message_seen' => 'N',
        'user_id' => $request->input('user_id')
      ]);

      return ['status' => 'Message Sent!'];
    }

    $user = Auth::user();

    $message = $user->messages()->create([
      'message' => $request->input('message'),
      'r_user_id' => $request->input('r_user_id'),
      'message_seen' => 'N'
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
