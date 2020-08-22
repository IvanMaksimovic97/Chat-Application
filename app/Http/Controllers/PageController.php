<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class PageController extends Controller
{
    private $data;

    public function index(){
        return view('pages.home');
    }

    public function home(){
        //dd(Auth::user());
        $this->data['users'] = User::where('id', '!=', Auth::id())->get();
        return view('pages.auth.home', $this->data);
    }

    public function register(){
        return view('pages.register');
    }

    public function getMessage($id){
        $my_id = Auth::id();
        $messages = Message::where(function ($query) use ($id, $my_id){
            $query->where('from', $my_id)->where('to', $id);
        })->orWhere(function ($query) use ($id, $my_id){
            $query->where('from', $id)->where('to', $my_id);
        })->get();

        $this->data['messages'] = $messages;
        return view('partials.messages', $this->data);
    }

    public function sendMessage(Request $request){
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
