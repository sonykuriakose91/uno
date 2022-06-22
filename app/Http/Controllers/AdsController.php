<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use Image;

class AdsController extends Controller
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
        $data = Ads::orderBy('id','DESC')->get();

        $page_types = Ads::$page_types;
    
        return view('ads.index',compact('data','page_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_types = Ads::$page_types;

        return view('ads.create',compact('page_types'));
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
            'page' => 'required',
            'ad_image' => 'required|image|mimes:jpg,jpeg,png,svg|max:5120',
        ]);
        try {
            $ads = new Ads();
            $ads->page = $request->page;
            $ads->status = isset($request->status)?$request->status:0;
            $fileName = time().'_'.$request->ad_image->getClientOriginalName(); 
            // $request->ad_image->move(public_path('uploads/ads'), $fileName);

            $img = Image::make($request->ad_image->path());

            $img->resize(325, 165, function ($const) {
                $const->aspectRatio();
            })->save(public_path('uploads/ads') . '/' . $fileName);

            $ads->ad_image = $fileName;
            $ads->save();
            return redirect()->route('ads.index')->with('success','Ad Banner created successfully.');
        } catch(Exception $e) {
            return redirect()->route('ads.index')->with('danger',$e->getMessage());
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
        $page_types = Ads::$page_types;
        $data = Ads::where('id',$id)->firstOrFail();
        
        return view('ads.edit',compact('data','page_types'));
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
            'page' => 'required',
        ]);
        try {
            $ads = Ads::findOrFail($id);
            $ad_img = $ads->ad_image;
            $ads->page = $request->page;
            $ads->status = isset($request->status)?$request->status:0;
            if($request->ad_image != "") {
                $request->validate([
                    'ad_image' => 'required|image|mimes:jpg,jpeg,png,svg|max:5120',
                ]);
                unlink(public_path('uploads/ads/'.$ad_img));
                $fileName = time().'_'.$request->ad_image->getClientOriginalName(); 
                // $request->ad_image->move(public_path('uploads/ads'), $fileName);
                
                $img = Image::make($request->ad_image->path());

                $img->resize(325, 165, function ($const) {
                    $const->aspectRatio();
                })->save(public_path('uploads/ads') . '/' . $fileName);

                $ads->ad_image = $fileName;
            } else {
                $ads->ad_image = $ad_img;
            }
            $ads->save();
            return redirect()->route('ads.index')->with('success','Ad banner updated successfully.');
        } catch(Exception $e) {
            return redirect()->route('ads.index')->with('danger',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Ads::where('id',$id)->firstOrFail();
        unlink(public_path('uploads/ads/'.$ads->ad_image));
        $ads->delete();

        return redirect()->route('ads.index')->with('danger','Banner deleted successfully');
    }
}
