<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Conver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Conver::where('user1', Auth::id())->orWhere('user2', Auth::id())->get();

        return view('supervisor.chat', [
            'chats'=>$chats
        ]);
    }

    public function single($id)
    {
        $chats = Conver::where('user1', Auth::id())->orWhere('user2', Auth::id())->get();
        $messages = Chat::where('conver_id', $id)->get();
        Chat::where('conver_id', $id)
            ->update(['read' => true]);
        $convo = Conver::find($id);
        $chat_with = "";
        if($convo->user1 == Auth::id()){
            $chat_with = $convo->user2;
        }else{
            $chat_with = $convo->user1;
        }

        return view('supervisor.single', [
            'chats'=>$chats,
            'messages' => $messages,
            'chat_with' => $chat_with,
            'conver_id' => $id
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => ['required', 'numeric'],
            'message' => ['required', 'string'],
            'conver_id' => ['required', 'numeric']
        ]);

        $msg = new Chat();
        $msg->conver_id = $request->conver_id;
        $msg->user_id = Auth::id();
        $msg->receiver_id = $request->receiver_id;
        $msg->message = $request->message;
        $msg->read = false;

        $msg->save();

        return redirect()->back()->with('success', 'successfully sent');
    }

    public function new(Request $request)
    {
        $request->validate([
            'new_chat_id' => ['required', 'numeric']
        ]);

        $already = Conver::where('user1', Auth::id())
        ->where('user2', $request->new_chat_id)
        ->first();
        if(is_null($already))
        {
            $already2 = Conver::where('user2', Auth::id())
                ->where('user1', $request->new_chat_id)
                ->first();
            if(is_null($already2))
            {
                $convo = new Conver();
                $convo->user1 = Auth::id();
                $convo->user2 = $request->new_chat_id;
                $convo->save();

                return redirect()->route('supervisor-chat', $convo->id);
            }else{
                return redirect()->route('supervisor-chat', $already2->id);
            }
        }else{
            return redirect()->route('supervisor-chat', $already->id);
        }
    }
}
