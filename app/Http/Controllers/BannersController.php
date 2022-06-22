<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;
use Image;

class BannersController extends Controller
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
        $data = Banners::orderBy('id','DESC')->get();
    
        return view('banners.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banners.create');
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
            'title' => 'required',
            'link' => 'required',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        try {
            $banner = new Banners();
            $banner->title = $request->title;
            $banner->link = $request->link;
            $banner->status = isset($request->status)?$request->status:0;
            $fileName = time().'_'.$request->banner_image->getClientOriginalName(); 
            // $request->banner_image->move(public_path('uploads/banners'), $fileName);

            $img = Image::make($request->banner_image->path());

            $img->resize(2000, 1008, function ($const) {
                $const->aspectRatio();
            })->save(public_path('uploads/banners') . '/' . $fileName);

            $banner->banner_image = $fileName;
            $banner->save();
            return redirect()->route('banners.index')->with('success','Banner created successfully.');
        } catch(Exception $e) {
            return redirect()->route('banners.index')->with('danger',$e->getMessage());
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
        $data = Banners::where('id',$id)->firstOrFail();
        
        return view('banners.edit',compact('data'));
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
            'title' => 'required',
            'link' => 'required',
        ]);
        try {
            $banner = Banners::findOrFail($id);
            $banner_img = $banner->banner_image;
            $banner->title = $request->title;
            $banner->link = $request->link;
            $banner->status = isset($request->status)?$request->status:0;
            if($request->banner_image != "") {
                $request->validate([
                    'banner_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                ]);
                unlink(public_path('uploads/banners/'.$banner_img));
                $fileName = time().'_'.$request->banner_image->getClientOriginalName(); 
                // $request->banner_image->move(public_path('uploads/banners'), $fileName);

                $img = Image::make($request->banner_image->path());

                $img->resize(2000, 1008, function ($const) {
                    $const->aspectRatio();
                })->save(public_path('uploads/banners') . '/' . $fileName);

                $banner->banner_image = $fileName;
            } else {
                $banner->banner_image = $banner_img;
            }
            $banner->save();
            return redirect()->route('banners.index')->with('success','Banner updated successfully.');
        } catch(Exception $e) {
            return redirect()->route('banners.index')->with('danger',$e->getMessage());
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
        $banner = Banners::where('id',$id)->firstOrFail();
        unlink(public_path('uploads/banners/'.$banner->banner_image));
        $banner->delete();

        return redirect()->route('banners.index')->with('danger','Banner deleted successfully');
    }
}
