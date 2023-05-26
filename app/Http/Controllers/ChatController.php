<?php

namespace App\Http\Controllers;

use App\Events\ChatBroadcast;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Paparkan halaman chatting
    public function index()
    {
        return view('chat.index');
    }

    // Hantar mesej chat ke pusher
    public function send(Request $request)
    {
        $message = $request->input('message');

        broadcast(new ChatBroadcast($message))->toOthers();

        return view('chat.send', compact('message'));
    }


    // Terima response daripada pusher
    public function receive(Request $request)
    {
        $message = $request->input('message');

        return view('chat.receive', compact('message'));
    }
}
