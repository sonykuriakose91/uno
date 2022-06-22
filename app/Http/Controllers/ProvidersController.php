<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Providers;
use App\Models\ProviderDocuments;
use App\Models\ProviderServices;
use App\Models\ProviderServicesLocations;
use App\Models\ProviderCategories;
use App\Models\ProviderWorks;
use App\Models\Services;
use App\Models\Countries;
use App\Models\TraderPosts;
use App\Models\TraderPostsImages;
use App\Models\TraderOffers;
use App\Models\TraderOffersImages;
use App\Models\TraderPostsComments;
use App\Models\TraderOffersComments;
use App\Models\Appointments;
use Illuminate\Support\Facades\DB;
use QrCode;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Image;

class ProvidersController extends Controller
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
        $data = Providers::with('getuser','providerdocuments')->orderBy('id','DESC')->get();
    
        return view('providers.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::where('status',1)->get();

        $countries = Countries::get();

        return view('providers.create',compact('services','countries'));
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
            'type' => 'required',
            'main_category' => 'required',
            'category' => 'required',
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            // 'web_url' => 'required',
            'country_code' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'location' => 'required',
            'landmark' => 'required',
            'service_location_radius' => 'required',
            'available_time_from' => 'required',
            'available_time_to' => 'required',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'services' => 'required',
            // 'service_location' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $provider = new Providers();
            $provider->type = $request->type;
            $provider->main_category = $request->main_category;
            $provider->handyman = isset($request->handyman)?$request->handyman:0;
            $provider->username = $request->username;
            $provider->name = $request->name;
            $provider->email = $request->email;
            $provider->web_url = isset($request->web_url)?$request->web_url:"";
            $provider->country_code = $request->country_code;
            $provider->mobile = $request->mobile;
            $provider->address = $request->address;
            $provider->location = $request->location;
            $provider->loc_latitude = $request->loc_latitude;
            $provider->loc_longitude = $request->loc_longitude;
            $provider->landmark = $request->landmark;
            $provider->land_latitude = $request->land_latitude;
            $provider->land_longitude = $request->land_longitude;
            $provider->landmark_data = $request->landmark_desc;
            $provider->service_location_radius = $request->service_location_radius;
            $provider->available_time_from = strtotime($request->available_time_from);
            $provider->available_time_to = strtotime($request->available_time_to);
            $provider->is_available = isset($request->is_available)?$request->is_available:0;
            $provider->appointment = isset($request->appointment)?$request->appointment:0;
            $provider->status = isset($request->status)?$request->status:0;
            $provider->featured = isset($request->featured)?$request->featured:0;
            $provider->reference = isset($request->reference)?$request->reference:0;
            $provider->rating = isset($request->rating)?$request->rating:0;
            $fileName = time().'_'.$request->profile_image->getClientOriginalName();  
       
            $request->profile_image->move(public_path('uploads/providers/profile'), $fileName);
            $provider->profile_pic = $fileName;
            $provider->completed_works = isset($request->completed_works)?$request->completed_works:"";
            $provider->save();
            $qr_code = time().'_'.$provider->id.'.svg';
            $qrcode = QrCode::size(67)->generate(route('traderdetails',$provider->username), '../public/uploads/providers/qrcode/'.$qr_code);
            $provider->qrcode = $qr_code;
            $provider->save();
            
            if($provider->id != "") {
                $user = new User();
                $user->user_type = 'provider';
                $user->user_id = $provider->id;
                $user->username = $provider->username;
                $user->name = $provider->name;
                $user->email = $provider->email;
                $user->mobile = $provider->mobile;
                $user->password = "";
                $user->profile_pic = '';
                $user->save();                
            }

            if($request->category != "") {
                foreach ($request->category as $key => $category) {
                    if($category != "") {
                        $providerCategory = new ProviderCategories();
                        $providerCategory->provider_id = $provider->id;
                        $category_detail = Categories::where(['id' => $category])->first();
                        $providerCategory->category_id = $category_detail->parent_category;
                        $providerCategory->sub_category_id = $category;
                        $providerCategory->status = 1;
                        $providerCategory->save();
                    }
                }
            }
            $document_status = [];
            if($request->proof_type != "") {
                $request->validate([
                    'document[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach($request->proof_type as $key => $proofType) {
                    if($proofType != "") {                        
                        $providerDocuments = new ProviderDocuments();
                        $providerDocuments->provider_id = $provider->id;
                        $providerDocuments->proof_type = $proofType;
                        $providerDocuments->id_type = isset($request->id_type[$key]) ? $request->id_type[$key]:"";
                        $providerDocuments->id_number = isset($request->id_number[$key]) ? $request->id_number[$key] : "";
                        $document = isset($request->document[$key])?time().'_'.$request->document[$key]->getClientOriginalName():"";  
                        isset($request->document[$key])?$request->document[$key]->move(public_path('uploads/providers/documents'), $document):"";
                        $providerDocuments->document = $document;
                        $providerDocuments->verified = isset($request->verified[$key])?$request->verified[$key]:0;
                        $providerDocuments->status = isset($request->verified[$key])?1:0;
                        $providerDocuments->save();

                        $document_status[$proofType] = ($providerDocuments->verified == 1) ? 1 : 0;
                    }
                }
            }
            if($document_status['ID Proof'] == 0 || $document_status['Address Proof'] == 0 || $provider->reference == 0)
            {
                $provider->status = 0;
                $provider->save();
            }
            if($request->services != "") {
                foreach($request->services as $key => $service) {
                    if($service != "") {                        
                        $providerService = new ProviderServices();
                        $providerService->provider_id = $provider->id;
                        $providerService->service_id = $service;
                        $providerService->status = 1;
                        $providerService->save();

                        // if($request->service_location != "") {
                        //     foreach($request->service_location as $key => $service_location) {
                        //         if($service_location != "") {                        
                        //             $providerServiceLoc = new ProviderServicesLocations();
                        //             $providerServiceLoc->provider_id = $provider->id;
                        //             $providerServiceLoc->service_id = $service;
                        //             $providerServiceLoc->location = $service_location;
                        //             $providerServiceLoc->latitude = $request->service_loc_latitude[$key];
                        //             $providerServiceLoc->longitude = $request->service_loc_longitude[$key];
                        //             $providerServiceLoc->status = 1;
                        //             $providerServiceLoc->save();
                        //         }
                        //     }
                        // }
                    }
                }
            }
            if(isset($request->completed_images)) {
                $request->validate([
                    'completed_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->completed_images as $key => $images) {
                    if($images != "") {
                        $providerWork = new ProviderWorks();
                        $providerWork->provider_id = $provider->id;
                        $providerWork->service_id = 0;
                        $providerWork->status = 1;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/providers/works'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(500, 450, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/providers/works') . '/' . $workFile);

                        $providerWork->image = $workFile;
                        $providerWork->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('providers.index')->with('success','Provider created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('providers.index')->with('danger',$e->getMessage());
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
        $data = Providers::with('providerdocuments','providerservices','providerworks','providercategories')->where('id',$id)->firstOrFail();
        
        return view('providers.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Services::where('status',1)->get();

        $countries = Countries::get();

        $data = Providers::with('providerdocuments','providerservices','providerworks','providercategories')->where('id',$id)->firstOrFail();

        // $providerservicelocations = ProviderServicesLocations::where('provider_id',$id)->groupBy('location')->get();

        $categories = Categories::where(['status' => 1, 'parent_category' => 0, 'main_category' => $data->main_category])->get();

        $subcategories = Categories::where(['status' => 1, 'main_category' => $data->main_category])->get();
        
        return view('providers.edit',compact('data','categories', 'subcategories', 'services','countries'));
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
        $provider = Providers::where('id',$id)->firstOrFail();

        $request->validate([
            'type' => 'required',
            'category' => 'required',
            'main_category' => 'required',
            'name' => 'required',
            // 'web_url' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'country_code' => 'required',
            'location' => 'required',
            'landmark' => 'required',
            'service_location_radius' => 'required',
            'available_time_from' => 'required',
            'available_time_to' => 'required',
            'services' => 'required',
        ]);

        if($request->email != $provider->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email',
            ]);
        }

        if($request->mobile != $provider->mobile) {
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
            $profile_pic = $provider->profile_pic;
            $provider->type = $request->type;
            $provider->main_category = $request->main_category;
            $provider->handyman = isset($request->handyman)?$request->handyman:0;
            $provider->name = $request->name;
            $provider->email = $request->email;
            $provider->web_url = isset($request->web_url)?$request->web_url:"";
            $provider->country_code = $request->country_code;
            $provider->mobile = $request->mobile;
            $provider->address = $request->address;
            $provider->location = $request->location;
            $provider->loc_latitude = $request->loc_latitude;
            $provider->loc_longitude = $request->loc_longitude;
            $provider->landmark = $request->landmark;
            $provider->land_latitude = $request->land_latitude;
            $provider->land_longitude = $request->land_longitude;
            $provider->landmark_data = $request->landmark_desc;
            $provider->service_location_radius = $request->service_location_radius;
            $provider->available_time_from = strtotime($request->available_time_from);
            $provider->available_time_to = strtotime($request->available_time_to);
            $provider->is_available = isset($request->is_available)?$request->is_available:0;
            $provider->appointment = isset($request->appointment)?$request->appointment:0;
            $provider->status = isset($request->status)?$request->status:0;
            $provider->featured = isset($request->featured)?$request->featured:0;
            $provider->reference = isset($request->reference)?$request->reference:0;
            $provider->rating = isset($request->rating)?$request->rating:0;
            if($request->profile_image != "") {
                $request->validate([
                    'profile_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);
                if($profile_pic != "") {
                    unlink(public_path('uploads/providers/profile/'.$profile_pic));
                }
                $fileName = time().'_'.$request->profile_image->getClientOriginalName(); 
                $request->profile_image->move(public_path('uploads/providers/profile'), $fileName);
                $provider->profile_pic = $fileName;
            } else {
                $provider->profile_pic = $profile_pic;
            }

            $provider->completed_works = isset($request->completed_works)?$request->completed_works:"";
            $provider->save();

            if($provider->id != "") {
                $user = User::where(['user_id' => $provider->id,'user_type' => 'provider'])->firstOrFail();
                if($user != "") {
                    $user->name = $provider->name;
                    $user->email = $provider->email;
                    $user->mobile = $provider->mobile;
                    $user->save();
                }
                $document_status = [];
                if($request->proof_type != "") {
                    $request->validate([
                        'document' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach($request->proof_type as $key => $proofType) {
                        if($proofType != "") {                 
                            $providerDocument = ProviderDocuments::where('id',$request->provider_doc_id[$key])->firstOrFail();
                            $oldDocument = $providerDocument->document;
                            $providerDocument->id_type = $request->id_type[$key];
                            $providerDocument->id_number = $request->id_number[$key];
                            if(isset($request->document[$key])) {
                                if($oldDocument != "") {
                                    unlink(public_path('uploads/providers/documents/'.$oldDocument));   
                                }
                                $document = isset($request->document[$key])?time().'_'.$request->document[$key]->getClientOriginalName():"";  
                                isset($request->document[$key])?$request->document[$key]->move(public_path('uploads/providers/documents'), $document):"";
                                $providerDocument->document = $document;
                            } else {
                                $providerDocument->document = $oldDocument;
                            }
                            $providerDocument->verified = isset($request->verified[$key])?$request->verified[$key]:0;
                            $providerDocument->status = isset($request->verified[$key])?1:0;
                            $providerDocument->save();

                            $document_status[$proofType] = ($providerDocument->verified == 1) ? 1 : 0;
                        }
                    }
                }

                if($document_status['ID Proof'] == 0 || $document_status['Address Proof'] == 0 || $provider->reference == 0)
                {
                    $provider->status = 0;
                    $provider->save();
                }
                if($request->category != "") {
                    ProviderCategories::where('provider_id',$provider->id)->delete();
                    foreach($request->category as $key => $category) {
                        if($category != "") {
                            $providerCategory = new ProviderCategories();
                            $providerCategory->provider_id = $provider->id;
                            $category_detail = Categories::where(['id' => $category])->first();
                            $providerCategory->category_id = $category_detail->parent_category;
                            $providerCategory->sub_category_id = $category;
                            $providerCategory->status = 1;
                            $providerCategory->save();
                        }
                    }
                }

                if($request->services != "") {
                    ProviderServices::where('provider_id',$provider->id)->delete();
                    // ProviderServicesLocations::where('provider_id',$provider->id)->delete();
                    foreach($request->services as $key => $service) {
                        if($service != "") {
                            $providerService = new ProviderServices();
                            $providerService->provider_id = $provider->id;
                            $providerService->service_id = $service;
                            $providerService->status = 1;
                            $providerService->save();

                            // if($request->service_location != "") {
                            //     foreach($request->service_location as $key => $service_location) {
                            //         if($service_location != "") {                        
                            //             $providerServiceLoc = new ProviderServicesLocations();
                            //             $providerServiceLoc->provider_id = $provider->id;
                            //             $providerServiceLoc->service_id = $service;
                            //             $providerServiceLoc->location = $service_location;
                            //             $providerServiceLoc->latitude = $request->service_loc_latitude[$key];
                            //             $providerServiceLoc->longitude = $request->service_loc_longitude[$key];
                            //             $providerServiceLoc->status = 1;
                            //             $providerServiceLoc->save();
                            //         }
                            //     }
                            // }
                        }
                    }
                }

                if(isset($request->removeImg)) {
                    foreach ($request->removeImg as $key => $img) {
                        $removeWork = ProviderWorks::where('id',$img)->firstOrFail();
                        unlink(public_path('uploads/providers/works/'.$removeWork->image));
                        $removeWork->delete();
                    }
                }

                if(isset($request->completed_images)) {
                    $request->validate([
                        'completed_images' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->completed_images as $key => $images) {
                        if($images != "") {
                            $providerWork = new ProviderWorks();
                            $providerWork->provider_id = $provider->id;
                            $providerWork->service_id = 0;
                            $providerWork->status = 1;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/providers/works'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(500, 450, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/providers/works') . '/' . $workFile);

                            $providerWork->image = $workFile;
                            $providerWork->save();
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('providers.index')->with('success','Provider updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('providers.index')->with('danger',$e->getMessage());
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
        $provider = Providers::with('providerdocuments','providerworks')->where('id',$id)->firstOrFail();
        
        if($provider != "") {
            ProviderServices::where('provider_id',$id)->delete();
            ProviderCategories::where('provider_id',$id)->delete();
            // ProviderServicesLocations::where('provider_id',$id)->delete();
            if($provider->providerdocuments != "") {
                foreach($provider->providerdocuments as $key => $doc) {
                    if($doc->document != "") {
                        unlink(public_path('uploads/providers/documents/'.$doc->document));
                    }
                    $doc->delete();
                }
            }
            if($provider->providerworks != "") {
                foreach($provider->providerworks as $key => $work) {
                    if($work->image != "") {
                        unlink(public_path('uploads/providers/works/'.$work->image));
                    }
                    $work->delete();
                }
            }
            if($provider->profile_pic != "") {

                unlink(public_path('uploads/providers/profile/'.$provider->profile_pic));

            }
            if($provider->qrcode != "") {

                unlink(public_path('uploads/providers/qrcode/'.$provider->qrcode));

            }


            User::where(['user_id' => $provider->id, 'user_type' => 'provider'])->firstOrFail()->delete();
            
            $provider->delete();
        }
    
        return redirect()->route('providers.index')
                        ->with('danger','Provider deleted successfully');
    }

    public function approve($id)
    {
        $data = Providers::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->id])->with('success','Provider approved successfully');
    }

    public function reject($id)
    {
        $data = Providers::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->id])->with('danger','Provider rejected successfully');
    }

    public function approvedocument($id)
    {
        $data = ProviderDocuments::where('id',$id)->firstOrFail();

        $data->verified = 1;
        $data->status = 1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('success','Document approved successfully');
    }

    public function rejectdocument($id)
    {
        $data = ProviderDocuments::where('id',$id)->firstOrFail();

        $data->verified = 0;
        $data->status = -1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('danger','Document rejected successfully');
    }

    public function approveservice($id)
    {
        $data = ProviderServices::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('success','Service approved successfully');
    }

    public function rejectservice($id)
    {
        $data = ProviderServices::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('danger','Service rejected successfully');
    }

    public function approvecategory($id)
    {
        $data = ProviderCategories::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('success','Category approved successfully');
    }

    public function rejectcategory($id)
    {
        $data = ProviderCategories::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('providers.show',[$data->provider_id])->with('danger','Category rejected successfully');
    }

    public function category_service(Request $request) {
        $categories = $request->categories;
        $services = [];
        $servicesData = "";
        $services = Services::whereIn('sub_category',$categories)->where('status',1)->get();
                       
        if($services != "") {
            foreach($services as $key => $service) { 
                $servicesData.='<option value="'.$service->id.'">'.$service->service.'</option>';
            }
        }
        
        return $servicesData;
    }

    public function provider_service_locations(Request $request) {
        if($request->provider_id != "" && $request->service_id != "") {
            $provider_id = $request->provider_id;
            $service_id = $request->service_id;
            $service_locations = ProviderServicesLocations::where(['provider_id' => $provider_id,'service_id' => $service_id])->get();

            return view('providers.service-locations',compact('service_locations'));
        }
    }

    public function change_service_locations(Request $request) {
        if($request->service_loc_id != "" && $request->type != "") {
            $service_loc_id = $request->service_loc_id;
            $type = $request->type;
            $service_location = ProviderServicesLocations::where('id',$service_loc_id)->firstOrFail();
            if($type == "enable") {
                $service_location->status = 1;
                $service_location->save();
            } elseif ($type == "disable") {
                $service_location->status = -1;
                $service_location->save();
            }

            return $service_location->status;
        }
    }

    public function gettraderposts()
    { 
        $data = TraderPosts::with('traderpostreports','traderpostimages','traderpostlikes','traderpostcommentsall')->get();
    
        return view('providers.posts',compact('data'));
    }

    public function gettraderpostsreported()
    { 
        $data = TraderPosts::select('trader_posts.*')->join('trader_posts_reports','trader_posts.id','=','trader_posts_reports.trader_post_id')->with('traderpostreports')->get();

        return view('providers.reportedposts',compact('data'));
    }

    public function addtraderpost()
    {
        $data = Providers::where('status',1)->get();

        return view('providers.create-trader-post',compact('data'));
    }

    public function storetraderpost(Request $request) {

        $request->validate([
            'trader_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderpost = new TraderPosts();
            $traderpost->trader_id = $request->trader_id;
            $traderpost->title = $request->post_title;
            $traderpost->post_content = $request->post_content;
            $traderpost->status = isset($request->status)?$request->status:0;
            $traderpost->emoji = "";
            $traderpost->likes = 0;
            $traderpost->reactions = 0;
            $traderpost->save();

            if(isset($request->post_images)) {
                $request->validate([
                    'post_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->post_images as $key => $images) {
                    if($images != "") {
                        $traderpostimages = new TraderPostsImages();
                        $traderpostimages->trader_post_id = $traderpost->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/providers/traderposts'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 250, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/providers/traderposts') . '/' . $workFile);

                        $traderpostimages->post_image = $workFile;
                        $traderpostimages->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('traderposts.index')->with('success','Trader Post created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderposts.index')->with('danger',$e->getMessage());
        }

    }

    public function edittraderpost($id)
    {
        $providers = Providers::where('status',1)->get();

        $data = TraderPosts::with('traderpostimages')->where('id',$id)->firstOrFail();
        
        return view('providers.edit-trader-post',compact('data','providers'));
    }

    public function updatetraderpost(Request $request, $id)
    {
        $traderpost = TraderPosts::where('id',$id)->firstOrFail();

        $request->validate([
            'trader_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderpost->trader_id = $request->trader_id;
            $traderpost->title = $request->post_title;
            $traderpost->post_content = $request->post_content;
            $traderpost->status = isset($request->status)?$request->status:0;
            $traderpost->save();

            if($traderpost->id != "") {

                if(isset($request->removeImg)) {
                    foreach ($request->removeImg as $key => $img) {
                        $removeimage = TraderPostsImages::where('id',$img)->firstOrFail();
                        unlink(public_path('uploads/providers/traderposts/'.$removeimage->post_image));
                        $removeimage->delete();
                    }
                }

                if(isset($request->post_images)) {
                    $request->validate([
                        'post_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->post_images as $key => $images) {
                        if($images != "") {
                            $traderpostimages = new TraderPostsImages();
                            $traderpostimages->trader_post_id = $traderpost->id;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/providers/traderposts'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(350, 250, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/providers/traderposts') . '/' . $workFile);

                            $traderpostimages->post_image = $workFile;
                            $traderpostimages->save();
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('traderposts.index')->with('success','Trader Post updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderposts.index')->with('danger',$e->getMessage());
        }
    }

    public function destroytraderpost($id)
    {
        $post = TraderPosts::with('traderpostimages')->where('id',$id)->firstOrFail();
        
        if($post != "") {
            if($post->traderpostimages != "") {
                foreach($post->traderpostimages as $key => $image) {
                    if($image->post_image != "") {
                        unlink(public_path('uploads/providers/traderposts/'.$image->post_image));
                    }
                    $image->delete();
                }
            }
            
            $post->delete();
        }
    
        return redirect()->route('traderposts.index')
                        ->with('danger','Trader Post deleted successfully');
    }

    public function gettraderoffers()
    { 
        $data = TraderOffers::get();
    
        return view('providers.offers',compact('data'));
    }

    public function addtraderoffer()
    {
        $data = Providers::where('status',1)->get();

        return view('providers.create-trader-offer',compact('data'));
    }

    public function storetraderoffer(Request $request) {

        $request->validate([
            'trader_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'full_price' => 'required',
            'discount_price' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderoffer = new TraderOffers();
            $traderoffer->trader_id = $request->trader_id;
            $traderoffer->title = $request->title;
            $traderoffer->description = $request->description;
            $traderoffer->full_price = $request->full_price;
            $traderoffer->discount_price = $request->discount_price;
            $traderoffer->valid_from = $request->valid_from;
            $traderoffer->valid_to = $request->valid_to;
            $traderoffer->status = isset($request->status)?$request->status:0;
            $traderoffer->likes = 0;
            $traderoffer->reactions = 0;
            $traderoffer->save();

            if(isset($request->offer_images)) {
                $request->validate([
                    'offer_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->offer_images as $key => $images) {
                    if($images != "") {
                        $traderofferimages = new TraderOffersImages();
                        $traderofferimages->trader_offer_id = $traderoffer->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/providers/traderoffers'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 250, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/providers/traderoffers') . '/' . $workFile);

                        $traderofferimages->offer_image = $workFile;
                        $traderofferimages->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('traderoffers.index')->with('success','Trader Offer created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderoffers.index')->with('danger',$e->getMessage());
        }

    }

    public function edittraderoffer($id)
    {
        $providers = Providers::where('status',1)->get();

        $data = TraderOffers::with('traderofferimages')->where('id',$id)->firstOrFail();
        
        return view('providers.edit-trader-offer',compact('data','providers'));
    }

    public function updatetraderoffer(Request $request, $id)
    {
        $traderoffer = TraderOffers::where('id',$id)->firstOrFail();

        $request->validate([
            'trader_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'full_price' => 'required',
            'discount_price' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderoffer->trader_id = $request->trader_id;
            $traderoffer->title = $request->title;
            $traderoffer->description = $request->description;
            $traderoffer->full_price = $request->full_price;
            $traderoffer->discount_price = $request->discount_price;
            $traderoffer->valid_from = $request->valid_from;
            $traderoffer->valid_to = $request->valid_to;
            $traderoffer->status = isset($request->status)?$request->status:0;
            $traderoffer->save();

            if($traderoffer->id != "") {

                if(isset($request->removeImg)) {
                    foreach ($request->removeImg as $key => $img) {
                        $removeimage = TraderOffersImages::where('id',$img)->firstOrFail();
                        unlink(public_path('uploads/providers/traderoffers/'.$removeimage->offer_image));
                        $removeimage->delete();
                    }
                }

                if(isset($request->offer_images)) {
                $request->validate([
                    'offer_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->offer_images as $key => $images) {
                    if($images != "") {
                        $traderofferimages = new TraderOffersImages();
                        $traderofferimages->trader_offer_id = $traderoffer->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/providers/traderoffers'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 250, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/providers/traderoffers') . '/' . $workFile);
                        
                        $traderofferimages->offer_image = $workFile;
                        $traderofferimages->save();
                    }
                }
            }
            }

            DB::commit();

            return redirect()->route('traderoffers.index')->with('success','Trader Offer updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderoffers.index')->with('danger',$e->getMessage());
        }
    }

    public function destroytraderoffer($id)
    {
        $offer = TraderOffers::with('traderofferimages')->where('id',$id)->firstOrFail();
        
        if($offer != "") {
            if($offer->traderofferimages != "") {
                foreach($offer->traderofferimages as $key => $image) {
                    if($image->offer_image != "") {
                        unlink(public_path('uploads/providers/traderoffers/'.$image->offer_image));
                    }
                    $image->delete();
                }
            }
            
            $offer->delete();
        }
    
        return redirect()->route('traderoffers.index')->with('danger','Trader Offer deleted successfully');
    }

    public function getsubcategory(Request $request) {

        $categoryData = "";

        $category = $request->category;

        $categories = Categories::whereIn('parent_category', $category)->where('status',1)->get();

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

    public function getappointments() {

        $data = Appointments::orderBy('id','DESC')->get();
        
        return view('appointments.index',compact('data'));
    }

    public function viewtraderpost($id)
    {
        $data = TraderPosts::with('traderpostimages','traderpostcommentsall','traderpostreports')->where('id',$id)->firstOrFail();

        return view('providers.posts-view',compact('data'));
    }

    public function approvetraderpost($id)
    {
        $data = TraderPosts::where('id',$id)->firstOrFail();

        $data->status = 1;
        $data->save();
        
        return redirect()->route('traderposts.view',[$data->id])->with('success','Trader Post approved successfully');
    }

    public function rejecttraderpost($id)
    {
        $data = TraderPosts::where('id',$id)->firstOrFail();

        $data->status = -1;
        $data->save();
        
        return redirect()->route('traderposts.view',[$data->id])->with('danger','Trader Post rejected successfully');
    }

    public function approvepostcomment($id)
    {
        $data = TraderPostsComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','Comment approved successfully');

        } else {

            return abort(404);
        }
    }

    public function rejectpostcomment($id)
    {
        $data = TraderPostsComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 0;
            $data->save();
            
            return redirect()->back()->with('danger','Comment rejected successfully');

        } else {

            return abort(404);
        }
    }

    public function viewtraderoffer($id)
    {
        $data = TraderOffers::with('traderofferimages','traderoffercommentsall')->where('id',$id)->firstOrFail();

        if($data != "") {
            
            return view('providers.offers-view',compact('data'));

        } else {

            return abort(404);
        }
    }

    public function approvetraderoffer($id)
    {
        $data = TraderOffers::where('id',$id)->firstOrFail();

        if($data != "") {

            $data->status = 1;
            $data->save();
            
            return redirect()->route('traderoffers.view',[$data->id])->with('success','Trader Offer approved successfully');

        } else {

            return abort(404);
        }
    }

    public function rejecttraderoffer($id)
    {
        $data = TraderOffers::where('id',$id)->firstOrFail();

        if($data != "") {
            
            $data->status = 0;
            $data->save();
            
            return redirect()->route('traderoffers.view',[$data->id])->with('danger','Trader Offer rejected successfully');

        } else {

            return abort(404);
        }
    }

    public function approveoffercomment($id)
    {
        $data = TraderOffersComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','Comment approved successfully');

        } else {

            return abort(404);
        }
    }

    public function rejectoffercomment($id)
    {
        $data = TraderOffersComments::where('id',$id)->firstOrFail();

        if($data != "") {
        
            $data->status = 0;
            $data->save();
            
            return redirect()->back()->with('danger','Comment rejected successfully');

        } else {

            return abort(404);
        }
    }
}
