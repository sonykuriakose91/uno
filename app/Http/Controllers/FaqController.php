<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
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
        $data = Faq::orderBy('id','DESC')->get();
    
        return view('faq.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = isset($request->status)?$request->status:0;
        $faq->save();

        return redirect()->route('faq.index')->with('success','Faq created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Faq::where('id',$id)->firstOrFail();
        
        return view('faq.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Faq::where('id',$id)->firstOrFail();
        
        return view('faq.edit',compact('data'));
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
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::where('id',$id)->firstOrFail();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = isset($request->status)?$request->status:0;
        $faq->save();

        return redirect()->route('faq.index')->with('success','Faq updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::where('id',$id)->firstOrFail();
        
        if($faq != "") {
            
            $faq->delete();

            return redirect()->route('faq.index')->with('success','Faq deleted successfully');

        } else { 
            
            return redirect()->route('faq.index')->with('danger','Something went wrong.!');
        }
    }

    public function approve($id)
    {
        $data = Faq::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('faq.index')->with('success','Faq approved successfully');
    }

    public function reject($id)
    {
        $data = Faq::where('id',$id)->firstOrFail();

        $data->status = 0;
        $data->save();
        
        return redirect()->route('faq.index')->with('danger','Faq rejected successfully');
    }
}
