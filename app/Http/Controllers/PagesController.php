<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;

class PagesController extends Controller
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
        $data = Pages::get();

        $page_types = Pages::$page_types;
    
        return view('pages.index',compact('data','page_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $page_types = Pages::$page_types;

        return view('pages.create',compact('page_types'));
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
            'page_type' => 'required',
            'title' => 'required',
            'contents' => 'required',
        ]);

        $page = Pages::where('page',$request->page_type)->first();

        if($page != "") {
            $page->page = $request->page_type;
            $page->title = $request->title;
            $page->contents = $request->contents;
            $page->status = isset($request->status)?$request->status:0;
            $page->save();
            return redirect()->route('pages.index')->with('success','Page updated successfully.');
        } else { 
            $page = new Pages();
            $page->page = $request->page_type;
            $page->title = $request->title;
            $page->contents = $request->contents;
            $page->status = isset($request->status)?$request->status:0;
            $page->save();
            return redirect()->route('pages.index')->with('success','Page created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_types = Pages::$page_types;
        $data = Pages::where('id',$id)->firstOrFail();
        
        return view('pages.edit',compact('data','page_types'));
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
            'page_type' => 'required',
            'title' => 'required',
            'contents' => 'required',
        ]);

        $page = Pages::where('id',$id)->firstOrFail();
        $page->page = $request->page_type;
        $page->title = $request->title;
        $page->contents = $request->contents;
        $page->status = isset($request->status)?$request->status:0;
        $page->save();
        return redirect()->route('pages.index')->with('success','Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pages::findOrFail($id)->delete();
    
        return redirect()->route('pages.index')->with('danger','CMS Page deleted successfully');
    }

    public function pagedetails($page_type)
    {
        $data = Pages::where('page',$page_type)->firstOrFail();
        
        return $data;
    }
}
