<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Providers;
use App\Models\Customers;
use App\Models\Bazaar;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $traders_count = Providers::count();

        $customers_count = Customers::count();

        $bazaar = Bazaar::count();

        $jobs = Jobs::count();

        return view('home',compact('traders_count','customers_count','bazaar','jobs'));
    }

    public function profile()
    {
        $data = Admin::where('id',Auth::user()->id)->firstOrFail();

        return view('profile',compact('data'));
    }

    public function updateprofile(Request $request)
    {
        $data = Admin::where('id',Auth::user()->id)->firstOrFail();
        $profile_pic = $data->profile_pic;

        $request->validate([
            'name' => 'required',
        ]);

        $data->name = $request->name;
        if($request->profile_image != "") {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            if($profile_pic != "") {
                unlink(public_path('uploads/admin/profile/'.$profile_pic));
            }            
            $fileName = time().'_'.$request->profile_image->getClientOriginalName(); 
            $request->profile_image->move(public_path('uploads/admin/profile'), $fileName);
            $data->profile_pic = $fileName;
        } else {
            $data->profile_pic = $profile_pic;
        }

        $data->save();

        return redirect()->route('profile')->with('success','Profile updated successfully.');
    }

    public function changepassword()
    {
        $data = Admin::where('id',Auth::user()->id)->firstOrFail();

        return view('changepassword',compact('data'));
    }

    public function updatepassword(Request $request)
    {
        $data = Admin::where('id',Auth::user()->id)->firstOrFail();

        if (Hash::check($request->current_password, $data->password)) {
            $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
            ]);

            $data->password = Hash::make($request->password);
            $data->save();

            return redirect()->route('changepassword')->with('success','Password updated successfully.');
        } else {
            return redirect()->route('changepassword')->with('danger','Current password entered is incorrect.');
        }
        
    }
}
