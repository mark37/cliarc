<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Input;
use Storage;
use File;

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
    public function fetchMessages()
    {
        return Message::with('user')->get();
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

    public function uploadFile(Request $request) {
        $file = Input::file('file');
        $filename = $file->getClientOriginalName();
        $r_user_id = Input::get('r_user_id');
        $user_id = Input::get('user_id');
        $path = hash( 'sha256', time());

        if(Storage::disk('uploads')->put($path.'/'.$filename,  File::get($file))) {
            $input['filename'] = $filename;
            $input['r_user_id'] = $r_user_id;
            $input['user_id'] = $user_id;
            $input['mime'] = $file->getClientMimeType();
            $input['path'] = $path;
            $input['size'] = $file->getClientSize();
            $file = Message::create($input);

            return response()->json([
                'success' => true,
                'id' => $file->id
            ], 200);
        }

        broadcast(new MessageSent($user, 'test'))->toOthers();

        return response()->json([
            'success' => false
        ], 500);
    }
}
