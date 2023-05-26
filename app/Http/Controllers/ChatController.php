<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Paparkan halaman chatting
    public function index()
    {
        return view('chat.index');
    }

    // Hantar mesej chat ke pusher
    public function send()
    {

    }


    // Terima response daripada pusher
    public function receive()
    {

    }
}
