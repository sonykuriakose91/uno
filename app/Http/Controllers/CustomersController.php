<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Countries;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
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
        $data = Customers::orderBy('id','DESC')->get();
    
        return view('customers.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::get();

        return view('customers.create',compact('countries'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'country_code' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'location' => 'required',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        DB::beginTransaction();
        try{
            $customer = new Customers();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->country_code = $request->country_code;
            $customer->mobile = $request->mobile;
            $customer->address = $request->address;
            $customer->location = $request->location;
            $customer->loc_latitude = $request->loc_latitude;
            $customer->loc_longitude = $request->loc_longitude;
            $customer->status = isset($request->status)?$request->status:0;
            $fileName = time().'_'.$request->profile_image->getClientOriginalName();  
       
            $request->profile_image->move(public_path('uploads/customers/profile'), $fileName);
            $customer->profile_pic = $fileName;
            $customer->save();

            if($customer->id != "") {
                $user = new User();
                $user->user_type = 'customer';
                $user->user_id = $customer->id;
                $user->name = $customer->name;
                $user->email = $customer->email;
                $user->mobile = $customer->mobile;
                $user->password = "";
                $user->profile_pic = '';
                $user->save();                
            }

            DB::commit();

            return redirect()->route('customers.index')->with('success','Customer created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('customers.index')->with('danger',$e->getMessage());
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
        $data = Customers::where('id',$id)->firstOrFail();
        
        return view('customers.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Countries::get();

        $data = Customers::where('id',$id)->firstOrFail();
        
        return view('customers.edit',compact('data','countries'));
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
        $customer = Customers::where('id',$id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'country_code' => 'required',
            'location' => 'required',
        ]);

        if($request->email != $customer->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
        }

        if($request->mobile != $customer->mobile) {
            $request->validate([
                'mobile' => 'required|unique:users,mobile',
            ]);
        } else {
            $request->validate([
                'mobile' => 'required',
            ]);
        }

        DB::beginTransaction();

        try{
            $profile_pic = $customer->profile_pic;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->country_code = $request->country_code;
            $customer->mobile = $request->mobile;
            $customer->address = $request->address;
            $customer->location = $request->location;
            $customer->loc_latitude = $request->loc_latitude;
            $customer->loc_longitude = $request->loc_longitude;
            $customer->status = isset($request->status)?$request->status:0;
            if($request->profile_image != "") {
                $request->validate([
                    'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);
                if($profile_pic != "") {
                    unlink(public_path('uploads/customers/profile/'.$profile_pic));
                }
                $fileName = time().'_'.$request->profile_image->getClientOriginalName(); 
                $request->profile_image->move(public_path('uploads/customers/profile'), $fileName);
                $customer->profile_pic = $fileName;
            } else {
                $customer->profile_pic = $profile_pic;
            }

            $customer->save();

            if($customer->id != "") {
                $user = User::where(['user_id' => $customer->id,'user_type' => 'customer'])->firstOrFail();
                if($user != "") {
                    $user->name = $customer->name;
                    $user->mobile = $customer->mobile;
                    $user->save();
                }
            }

            DB::commit();

            return redirect()->route('customers.index')->with('success','Customer updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('customers.index')->with('danger',$e->getMessage());
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
        $customer = Customers::where('id',$id)->firstOrFail();
        
        if($customer != "") {

            if($customer->profile_pic != "") {

                unlink(public_path('uploads/customers/profile/'.$customer->profile_pic));

            }

            User::where(['user_id' => $customer->id, 'user_type' => 'customer'])->firstOrFail()->delete();
            
            $customer->delete();

            return redirect()->route('customers.index')->with('success','Customer deleted successfully');
        } else { 
            return redirect()->route('customers.index')->with('danger','Something went wrong.!');
        }
    }

    public function approve($id)
    {
        $data = Customers::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('customers.index')->with('success','Customer approved successfully');
    }

    public function reject($id)
    {
        $data = Customers::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('customers.index')->with('danger','Customer rejected successfully');
    }
}
