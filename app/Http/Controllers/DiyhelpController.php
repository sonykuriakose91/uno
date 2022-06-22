<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiyHelp;
use App\Models\DiyHelpComments;

class DiyhelpController extends Controller
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
        $data = DiyHelp::with('diyhelpcommentsall')->orderBy('id','DESC')->get();
    
        return view('diy-help.index',compact('data'));
    }

    public function show($id)
    {
        $data = DiyHelp::with('diyhelpcommentsall')->where('id',$id)->firstOrFail();

        if($data != "") {
        
            return view('diy-help.view',compact('data'));

        } else {

            return  abort(404);
        }
    }

    public function approve($id)
    {
        $data = DiyHelp::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','DIY Help approved successfully');

        } else {

            return  abort(404);
        }
    }

    public function reject($id)
    {
        $data = DiyHelp::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 0;
            $data->save();
            
            return redirect()->back()->with('danger','DIY Help rejected successfully');

        } else {

            return  abort(404);
        }
    }

    public function approvecomment($id)
    {
        $data = DiyHelpComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','Comment approved successfully');

        } else {

            return  abort(404);
        }
    }

    public function rejectcomment($id)
    {
        $data = DiyHelpComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 0;
            $data->save();
            
            return redirect()->back()->with('danger','Comment rejected successfully');

        } else {

            return  abort(404);
        }
    }

}
