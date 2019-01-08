<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Events\ChatEvent;

class ChatController extends Controller
{
    public function chat()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        //return $request->all();
        $url = str_replace(url('/'), '', url()->previous());
        $uri_parts = explode('/', $url);
        $uri_tail = end($uri_parts);
        $user = User::find(Auth::id());
        event(new ChatEvent($request->message, $user, $uri_tail));

    }
    /* public function send(){
          $message='hello';
         Request::fullUrl();
          echo('s');
          $user = User::find(Auth::id());
          event(new ChatEvent($message,$user,'1'));
      }*/
}
