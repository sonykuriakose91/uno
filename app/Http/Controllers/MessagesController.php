<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Messages::get();
    
        return view('messages.index',compact('data'));
    }

}
