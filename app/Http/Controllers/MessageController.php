<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    public function index()
    {

        $messages = Message::where('family_id', auth()->user()->family_id)->orderBy('id', 'DESC')->get();
        return view('dashboard.message.messages')->with(['messages'=>$messages]);
    }
    public function create()
    {
        return view('dashboard.message.create_message');
    }

    public function store(Request $request)
    {
        $data = [
            'message' => $request->message,
            'date' => $this->getToday() . '  ' . $this->getNow(),
            'family_id' => auth()->user()->family_id,
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
        ];
        Message::create($data);
        return Redirect::route('messages.index')->with('status', 'تراکنش با موفقیت اضافه شد');
    }
}
