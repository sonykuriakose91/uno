<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\Categories;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data = Services::where('status',1)->orderBy('id','DESC')->get();
    
        return view('services.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Categories::where(['parent_category' => 0,'status' => 1])->get();

        return view('services.create',compact('data'));
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
            'category' => 'required',
            'service' => 'required',
        ]);

        $service = new Services();
        $service->category = $request->category;
        $service->sub_category = $request->sub_category;
        $service->service = $request->service;
        $service->description = isset($request->description)?$request->description:"";
        $service->status = isset($request->status)?$request->status:0;
        $service->save();
     
        return redirect()->route('services.index')
                        ->with('success','Service created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        $service = Services::findOrFail($service_id);

        $categories = Categories::where(['parent_category' => 0,'status' => 1])->get();

        $subcategories = Categories::where(['parent_category' => $service->category,'status' => 1])->get();

        return view('services.edit',compact('service','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service_id)
    {
        $request->validate([
            'category' => 'required',
            'service' => 'required',
        ]);

        $service = Services::findOrFail($service_id);
        $service->category = $request->category;
        $service->sub_category = $request->sub_category;
        $service->service = $request->service;
        $service->description = $request->description;
        $service->status = isset($request->status)?$request->status:0;
        $service->save();
     
        return redirect()->route('services.index')
                        ->with('success','Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id)
    {
        $service = Services::findOrFail($service_id);
        $service->delete();
    
        return redirect()->route('services.index')
                        ->with('danger','Service deleted successfully');
    }

    public function approve($id)
    {
        $data = Services::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('services.index')->with('danger','Service approved successfully');
    }

    public function reject($id)
    {
        $data = Services::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('services.index')->with('danger','Service rejected successfully');
    }

    public function getsubcategory(Request $request) {

        $categoryData = "";

        $category = $request->category;

        $categories = Categories::where(['parent_category' => $category,'status' => 1])->get();

        if($categories != "") {
            $categoryData.='<option value="">Select</option>';
            foreach($categories as $key => $cate) {
                $categoryData.='<option value="'.$cate->id.'">'.$cate->category.'</option>';
            }

        } else {
            $categoryData.='<option value="">Select</option>';
        }

        return $categoryData;
    }
}
