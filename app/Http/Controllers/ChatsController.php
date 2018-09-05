<?php

namespace App\Http\Controllers;

use App\Message;
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

    return DB::select(DB::raw("SELECT messages.id, messages.user_id, MAX(messages.created_at) as created_at, users.name, 
                      (SELECT message FROM message WHERE user_id = messages.user_id AND id = messages.id ORDER BY created_at DESC) as message
                      FROM messages 
                      JOIN users ON users.id = messages.user_id 
                      WHERE r_user_id = $user->id
                      GROUP BY messages.user_id"));

    /* return Message::select('messages.user_id', 'users.name')
          ->join('users', 'users.id', '=', 'messages.user_id')
          ->where('r_user_id', '=', $user->id)
          ->groupBy('messages.user_id')
          ->get(); */
  }

  /**
   * Fetch all messages
   *
   * @return Message
   */
  public function fetchMessages(Request $request)
  {
    $user = Auth::user();

    return Message::with('user')
          ->where('r_user_id','=',$user->id)
          ->where('user_id', '=', $request->input('user_id'))
          ->get();

    //get messages for logged user
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
