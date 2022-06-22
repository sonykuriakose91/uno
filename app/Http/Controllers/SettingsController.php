<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
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
        $data = Settings::first();

        return view('settings.index',compact('data'));
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
        $request->validate([
            'site_title' => 'required',
            'phone_number' => 'required',
            'site_url' => 'required',
            'email' => 'required|email',
            'google_map_api' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);

        $settings = Settings::firstOrFail();
        $settings->site_title = $request->site_title;
        $settings->description = $request->description;
        $settings->phone_number = $request->phone_number;
        $settings->url = $request->site_url;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->facebook_url = isset($request->facebook_url)?$request->facebook_url:NULL;
        $settings->twitter_url = isset($request->twitter_url)?$request->twitter_url:NULL;
        $settings->instagram_url = isset($request->instagram_url)?$request->instagram_url:NULL;
        $settings->google_plus_url = isset($request->google_plus_url)?$request->google_plus_url:NULL;
        $settings->linkedin_url = isset($request->linkedin_url)?$request->linkedin_url:NULL;
        $settings->google_map_api = $request->google_map_api;
        $settings->save();
     
        return redirect()->route('settings.index')
                        ->with('success','Settings updated successfully.');
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
        //
    }
}
