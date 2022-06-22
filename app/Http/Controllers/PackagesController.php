<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Illuminate\Http\Request;

class PackagesController extends Controller
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
        $data = Packages::orderBy('id','DESC')->get();
    
        return view('packages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('packages.create');
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
            'package_name' => 'required',
            'description' => 'required',
            'package_price' => 'required',
            'package_price_type' => 'required',
            'package_limit' => 'required',
        ]);

        $package = new Packages();
        $package->package_name = $request->package_name;
        $package->description = $request->description;
        $package->price = $request->package_price;
        $package->price_type = $request->package_price_type;
        $package->package_limit = $request->package_limit;
        $package->status = isset($request->status)?$request->status:0;
        
        $package->save();
     
        return redirect()->route('packages.index')
                        ->with('success','Package created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($package_id)
    {
        $package = Packages::findOrFail($package_id);

        if($package != "") {

            return view('packages.edit',compact('package'));

        } else {
            return redirect()->route('packages.index')
                        ->with('danger','Something went wrong. Please try again later.!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $package_id)
    {
        $package = Packages::findOrFail($package_id);

        if($package != "") { 

            $request->validate([
                'package_name' => 'required',
                'description' => 'required',
                'package_price' => 'required',
                'package_price_type' => 'required',
                'package_limit' => 'required',
            ]);

            $package->package_name = $request->package_name;
            $package->description = $request->description;
            $package->price = $request->package_price;
            $package->price_type = $request->package_price_type;
            $package->package_limit = $request->package_limit;
            $package->status = isset($request->status)?$request->status:0;
            
            $package->save();
         
            return redirect()->route('packages.index')
                        ->with('success','Package updated successfully.');
        } else {
            return redirect()->route('packages.index')->with('danger','Something went wrong.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($package_id)
    {
        $package = Packages::findOrFail($package_id);
        
        if($package != "") {
            
            $package->delete();

            return redirect()->route('packages.index')->with('success','Package deleted successfully');
        } else { 
            return redirect()->route('packages.index')->with('danger','Something went wrong.!');
        }
        
    }
}
