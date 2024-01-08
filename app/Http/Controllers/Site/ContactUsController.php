<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\StoreMessageRequest;
use App\Models\Message;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.contact');
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $message = new Message;
        $message->name = $request->name;
        $message->message = $request->message;
        $message->phone = $request->phone;
        $message->email = $request->email;
        $message->seen = 0;
        $message->save();
        return back()->with('success' , trans('site.message_send') );
    }

    
}
