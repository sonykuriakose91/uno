<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipts;

class ReceiptsController extends Controller
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
        $data = Receipts::orderBy('id','DESC')->get();
    
        return view('receipts.index',compact('data'));
    }

}
