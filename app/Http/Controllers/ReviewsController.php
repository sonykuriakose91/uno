<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\TraderReviewComments;

class ReviewsController extends Controller
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
        $data = Reviews::orderBy('id','DESC')->get();
    
        return view('reviews.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Reviews::with('traderreviewcommentsall')->where('id',$id)->firstOrFail();
        
        return view('reviews.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reviews::findOrFail($id)->delete();
    
        return redirect()->route('reviews.index')->with('danger','Review deleted successfully');
    }

    public function approve($id)
    {
        $data = Reviews::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('reviews.index')->with('success','Review approved successfully');
    }

    public function reject($id)
    {
        $data = Reviews::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('reviews.index')->with('danger','Review rejected successfully');
    }

    public function approvereviewcomment($id)
    {
        $data = TraderReviewComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','Comment approved successfully');

        } else {

            return abort(404);
        }
    }

    public function rejectreviewcomment($id)
    {
        $data = TraderReviewComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 0;
            $data->save();
            
            return redirect()->back()->with('danger','Comment rejected successfully');

        } else {

            return abort(404);
        }
    }
}
