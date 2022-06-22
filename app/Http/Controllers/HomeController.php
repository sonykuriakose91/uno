<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Services;
use App\Models\Providers;
use App\Models\Customers;
use App\Models\User;
use App\Models\Banners;
use App\Models\Ads;
use App\Models\Faq;
use App\Models\Pages;
use App\Models\ProviderDocuments;
use App\Models\ProviderServicesLocations;
use App\Models\ProviderCategories;
use App\Models\ProviderServices;
use App\Models\ProviderWorks;
use App\Models\TraderPosts;
use App\Models\TraderPostsImages;
use App\Models\TraderPostsLikes;
use App\Models\TraderOfferLikes;
use App\Models\TraderOffers;
use App\Models\TraderOffersImages;
use App\Models\TraderReviewComments;
use App\Models\TraderPostsComments;
use App\Models\TraderOffersComments;
use App\Models\Reviews;
use App\Models\BazaarCategory;
use App\Models\Bazaar;
use App\Models\BazaarImages;
use App\Models\Appointments;
use App\Models\Jobs;
use App\Models\JobsImages;
use App\Models\JobQuotes;
use App\Models\ProductsWishlist;
use App\Models\TraderPostsReports;
use App\Models\Receipts;
use App\Models\Messages;
use App\Models\Follows;
use App\Models\Favourites;
use App\Models\SearchHistory;
use App\Models\ProfileVisits;
use App\Models\DiyHelp;
use App\Models\DiyHelpComments;
use App\Models\Block;
use App\Models\Packages;
use App\Models\Newsletter;
use App\Models\DiyHelpImages;
use App\Models\Notifications;
use App\Models\JobQuoteDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterMail;
use App\Mail\NewsletterMail;
use App\Mail\ForgotPasswordMail;
use App\Mail\SeekquoteMail;
use App\Mail\BookappointmentMail;
use App\Mail\ChangeappointmentMail;
use App\Mail\ChangeappointmenttraderMail;
use App\Mail\ContactuserMail;
use App\Mail\ContactadminMail;
use App\Mail\AcceptjobquoteMail;
use App\Mail\RejectjobquoteMail;
use Mail;
use QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Image;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $about = Pages::where(['status' => 1, 'page' => "about-us"]);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $banner = Banners::where('status',1)->first();

        $ads = Ads::where(['status' => 1, 'page' => 'home'])->get();

        $servicecategories = Categories::with('subcategories')->where(['main_category' => 'Service', 'status' => 1,'parent_category' => 0])->get();
        
        $salescategories = Categories::with('subcategories')->where(['main_category' => 'Seller', 'status' => 1,'parent_category' => 0])->get();

        return view('web-ui.home',compact('servicecategories', 'salescategories', 'banner', 'ads'));
    }

    public function getcmspages() 
    {
        $page = request()->path();

        if($page == "about-us" || $page == "privacy-policy" || $page == "terms-and-conditions")
        {
            if($page == "about-us") {

                $about_us = Pages::where(['page' => $page, 'status' => 1])->first();
                $mission = Pages::where(['page' => "mission", 'status' => 1])->first();
                $vision = Pages::where(['page' => "vision", 'status' => 1])->first();

                if($about_us != "") {

                    return view('web-ui.pages.about-us',compact('about_us','mission','vision'));

                } else {

                    return view('web-ui.errors.404');

                }                

            } else {

                $page_data = Pages::where(['page' => $page, 'status' => 1])->first();

                if($page_data != "") {

                    return view('web-ui.pages.page',compact('page_data'));

                } else {

                    return view('web-ui.errors.404');

                }
            }

        } elseif ($page == "contact-us") {
            
            return view('web-ui.pages.contact-us');
        }
    }

    public function contactus(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $email = $request->email;

        if($email != "") {

            $contactuser = [
                'title' => 'Contact Us',
                'name' => $request->name
            ];

            $contactadmin = [
                'title' => 'Contact Us',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
      
            Mail::to($email)->send(new ContactuserMail($contactuser));
      
            Mail::to(config('site_settings')->email)->send(new ContactadminMail($contactadmin));

            return redirect()->route('contact-us')->with('success','Your query has been submitted.!');

        } else {

            return redirect()->route('contact-us')->with('danger','Something went wrong.Please try again later.!!');

        }
    }

    public function traderdetails($username)
    { 
        $provider = Providers::with('providerdocuments','providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers','providerfollows','providerfavourites')->where(['username' => $username,'status' => 1])->first();

        $job_quote_count = JobQuotes::where(['trader_id' => $provider->id,'status' => 'Requested'])->count();

        $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

        $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

        $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

        $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

        if($provider != "") {

            if(Auth::guard('web')->check()) {

                $profile_visits = new ProfileVisits();
                $profile_visits->trader_id = $provider->id;
                $profile_visits->user_type = Auth::guard('web')->user()->user_type;
                $profile_visits->user_id = Auth::guard('web')->user()->user_id;
                $profile_visits->contacted = 0;
                $profile_visits->save();
            }

            return view('web-ui.trader.trader-details',compact('provider','job_quote_count','job_count'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function traderdashboard($username)
    {

        if(Auth::guard('web')->user()->user_type == "provider")
        {
            $id = Auth::guard('web')->user()->user_id;
            $username = Auth::guard('web')->user()->username;
            
            $provider = Providers::with('providerdocuments','providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers')->where(['username' => $username,'status' => 1])->firstOrFail();

            $job_quote_count = JobQuotes::where(['trader_id' => $id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            if($provider != "") {

                return view('web-ui.trader.trader-details',compact('provider','job_quote_count','job_count'));

            } else {

                return view('web-ui.errors.404');

            }
        } else {
            return view('web-ui.errors.404');
        }
    }

    public function getalltraders() {

        $categories = Categories::where(['status' => 1,'parent_category' => 0])->get();

        $providers = Providers::with('providercategories','providerreviews')->where(['status' => 1,'handyman' => 0])->orderBy('id', 'desc')->get(); 

        return view('web-ui.trader.traders-list',compact('providers','categories'));
    }

    public function getallhandyman() {

        $categories = Categories::where(['status' => 1,'parent_category' => 0])->get();

        $providers = Providers::with('providercategories','providerreviews')->where(['status' => 1,'handyman' => 1])->orderBy('id', 'desc')->get();

        return view('web-ui.trader.handyman',compact('providers','categories'));
    }

    public function tradersbycategory($category) {

        $categories = Categories::where(['status' => 1,'parent_category' => 0])->get();

        $providers = Providers::select('providers.*')->with('providercategories','providerreviews')->leftjoin('provider_categories','providers.*.id', '=', 'provider_categories.provider_id')->where('providers.status',1)->whereIN('provider_categories.category_id',[$category])->groupBy('providers.id')->orderBy('providers.id', 'desc')->get();

        return view('web-ui.trader.traders-list',compact('providers','categories'));
    }

    public function tradersbysubcategory($category,$subcategory) {

        $categories = Categories::where(['status' => 1,'parent_category' => 0])->get();

        $providers = Providers::select('providers.*')->with('providercategories','providerreviews')->leftjoin('provider_categories','providers.id', '=', 'provider_categories.provider_id')->where('providers.status',1)->whereIN('provider_categories.sub_category_id',[$subcategory])->groupBy('providers.id')->orderBy('providers.id', 'desc')->get();

        return view('web-ui.trader.traders-list',compact('providers','categories'));

    }

    public function get_provider(Request $request) 
    {  
        $user_id = $request->user_id;

        if($user_id != "")
        {
            $providers = Providers::with('providercategories','providerreviews')->where(['status' => 1,'handyman' => 0])->where('name','like', '%' . $user_id . '%')->orWhere('username','like', '%' . $user_id . '%')->get();

            return view('web-ui.trader.trader-search',compact('providers'));

        } else {

            $providers = Providers::with('providercategories','providerreviews')->where(['status' => 1, 'handyman' => 0])->get();

            return view('web-ui.trader.trader-search',compact('providers'));
        }
    }

    public function get_provider_list(Request $request)
    { 
        $providers = [];
        $rating = $request->rating;
        $sort_by = $request->sort_by;
        if($sort_by == 1) {
            $sort_key = 'providers.id';
            $sort_value = 'desc'; 
        } elseif ($sort_by == 2) {
            $sort_key = 'providers.name';
            $sort_value = 'asc'; 
        } elseif ($sort_by == 3) {
            $sort_key = 'providers.name';
            $sort_value = 'desc'; 
        }

        if($request->category != "" && $request->rating != "")
        {
            $providers = Providers::select('providers.*')->selectRaw('(avg(`reviews`.`reliability`+`reviews`.`tidiness`+`reviews`.`response`+`reviews`.`accuracy`+`reviews`.`pricing`+`reviews`.`overall_exp`)/6) as `finalrating`')->with('providercategories')->leftjoin('provider_categories','providers.id', '=', 'provider_categories.provider_id')->leftjoin('reviews','providers.id', '=', 'reviews.trader_id')->where(['providers.status' => 1,'providers.handyman' => 0])->having('finalrating', '>=', $rating)->whereIn('provider_categories.category_id', [$request->category])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->orderBy('finalrating', 'desc')->get();

        } else if ($request->category != "" && $request->rating == "") {

            $providers = Providers::select('providers.*')->with('providercategories')->leftjoin('provider_categories','providers.id', '=', 'provider_categories.provider_id')->where(['providers.status' => 1,'providers.handyman' => 0])->whereIn('provider_categories.category_id', [$request->category])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->get();

        } else if ($request->category == "" && $request->rating != "") {

            $providers = Providers::select('providers.*')->selectRaw('(avg(`reviews`.`reliability`+`reviews`.`tidiness`+`reviews`.`response`+`reviews`.`accuracy`+`reviews`.`pricing`+`reviews`.`overall_exp`)/6) as `finalrating`')->with('providercategories')->leftjoin('reviews','providers.id', '=', 'reviews.trader_id')->where(['providers.status' => 1,'providers.handyman' => 0])->having('finalrating', '>=', $rating)->groupBy('providers.id')->orderBy($sort_key, $sort_value)->orderBy('finalrating', 'desc')->get();
        } else {
            $providers = Providers::select('providers.*')->with('providercategories')->where(['providers.status' => 1,'providers.handyman' => 0])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->get();
        }
        
        return view('web-ui.trader.trader-search',compact('providers'));
    }

    public function get_handyman(Request $request) 
    {  
        $user_id = $request->user_id;

        if($user_id != "")
        {
            $providers = Providers::with('providercategories','providerreviews')->where(['id' => $user_id,'status' => 1,'handyman' => 1])->get();

            return view('web-ui.trader.trader-search',compact('providers'));

        } else {

            $providers = Providers::with('providercategories','providerreviews')->where(['status' => 1, 'handyman' => 1])->get();

            return view('web-ui.trader.trader-search',compact('providers'));
        }
    }

    public function get_handyman_list(Request $request)
    { 
        $providers = [];
        $rating = $request->rating;
        $sort_by = $request->sort_by;
        if($sort_by == 1) {
            $sort_key = 'providers.id';
            $sort_value = 'desc'; 
        } elseif ($sort_by == 2) {
            $sort_key = 'providers.name';
            $sort_value = 'asc'; 
        } elseif ($sort_by == 3) {
            $sort_key = 'providers.name';
            $sort_value = 'desc'; 
        }

        if($request->category != "" && $request->rating != "")
        {
            $providers = Providers::select('providers.*')->selectRaw('(avg(`reviews`.`reliability`+`reviews`.`tidiness`+`reviews`.`response`+`reviews`.`accuracy`+`reviews`.`pricing`+`reviews`.`overall_exp`)/6) as `finalrating`')->with('providercategories')->leftjoin('provider_categories','providers.id', '=', 'provider_categories.provider_id')->leftjoin('reviews','providers.id', '=', 'reviews.trader_id')->where(['providers.status' => 1,'providers.handyman' => 1])->having('finalrating', '>=', $rating)->whereIn('provider_categories.category_id', [$request->category])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->orderBy('finalrating', 'desc')->get();

        } else if ($request->category != "" && $request->rating == "") {

            $providers = Providers::select('providers.*')->with('providercategories')->leftjoin('provider_categories','providers.id', '=', 'provider_categories.provider_id')->where(['providers.status' => 1,'providers.handyman' => 1])->whereIn('provider_categories.category_id', [$request->category])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->get();

        } else if ($request->category == "" && $request->rating != "") {

            $providers = Providers::select('providers.*')->selectRaw('(avg(`reviews`.`reliability`+`reviews`.`tidiness`+`reviews`.`response`+`reviews`.`accuracy`+`reviews`.`pricing`+`reviews`.`overall_exp`)/6) as `finalrating`')->with('providercategories')->leftjoin('reviews','providers.id', '=', 'reviews.trader_id')->where(['providers.status' => 1,'providers.handyman' => 1])->having('finalrating', '>=', $rating)->groupBy('providers.id')->orderBy($sort_key, $sort_value)->orderBy('finalrating', 'desc')->get();
        } else {
            $providers = Providers::select('providers.*')->with('providercategories')->where(['providers.status' => 1,'providers.handyman' => 1])->groupBy('providers.id')->orderBy($sort_key, $sort_value)->get();
        }
        
        return view('web-ui.trader.trader-search',compact('providers'));
    }

    public function register(Request $request) {

        $request->validate([
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'country_code' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try{
            $token = Str::random(32);
            if($request->user_type == "customer") {
                $customer = new Customers();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->username = $request->username;
                $customer->country_code = $request->country_code;
                $customer->mobile = $request->mobile;
                $customer->status = 0;

                $customer->save();

                if($customer->id != "") {
                    $user = new User();
                    $user->user_type = 'customer';
                    $user->user_id = $customer->id;
                    $user->name = $customer->name;
                    $user->email = $customer->email;
                    $user->username = $customer->username;
                    $user->mobile = $customer->mobile;
                    $user->password = Hash::make($request->password);
                    $user->profile_pic = '';
                    $user->status = 0;
                    $user->email_verify_token = $token;
                    $user->save();                
                }

                $email = $customer->email;

                $register = [
                    'title' => 'Registration',
                    'name' => $customer->name,
                    'url' => route('verifyaccount',['email'=>Crypt::encryptString($email),'verifytoken'=>Crypt::encryptString($token)]) 
                ];
          
                Mail::to($email)->send(new RegisterMail($register));

            } elseif ($request->user_type == "trader") {
                $provider = new Providers();
                $provider->type = $request->trader_type;
                $provider->name = $request->name;
                $provider->email = $request->email;
                $provider->username = $request->username;
                $provider->country_code = $request->country_code;
                $provider->mobile = $request->mobile;
                $provider->is_available = 0;
                $provider->status = 0;
                $provider->featured = 0;
                $provider->reference = 0;
                $provider->rating = 0;

                $provider->save();
                
                $qr_code = time().'_'.$provider->id.'.svg';
                $qrcode = QrCode::size(67)->generate(route('traderdetails',$provider->username), '../public/uploads/providers/qrcode/'.$qr_code);
                $provider->qrcode = $qr_code;
                $provider->save();

                if($provider->id != "") {
                    $user = new User();
                    $user->user_type = 'provider';
                    $user->user_id = $provider->id;
                    $user->name = $provider->name;
                    $user->email = $provider->email;
                    $user->username = $provider->username;
                    $user->mobile = $provider->mobile;
                    $user->password = Hash::make($request->password);
                    $user->profile_pic = '';
                    $user->status = 0;
                    $user->email_verify_token = $token;
                    $user->save();                
                }

                if($provider->id != "") {
                    $providerDocuments = new ProviderDocuments();
                    $providerDocuments->provider_id = $provider->id;
                    $providerDocuments->proof_type = "ID Proof";
                    $providerDocuments->verified = 0;
                    $providerDocuments->status = 0;
                    $providerDocuments->save();
                    $providerDocuments1 = new ProviderDocuments();
                    $providerDocuments1->provider_id = $provider->id;
                    $providerDocuments1->proof_type = "Address Proof";
                    $providerDocuments1->verified = 0;
                    $providerDocuments1->status = 0;
                    $providerDocuments1->save();
                }

                $email = $provider->email;
   
                $register = [
                    'title' => 'Registration',
                    'name' => $provider->name,
                    'url' => route('verifyaccount',['email'=>Crypt::encryptString($email),'verifytoken'=>Crypt::encryptString($token)]) 
                ];
          
                Mail::to($email)->send(new RegisterMail($register));
            }

            DB::commit();

            return TRUE;

        } catch(Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

    }

    public function verifyaccount($email, $token) {
        $decrypt_email =  Crypt::decryptString($email);
        $decrypt_token = Crypt::decryptString($token);

        $user = User::where(['email' => $decrypt_email])->firstOrFail();

        if($user != "") {
            if($user->email_verify_token == $decrypt_token) {

                $user->status = 1;
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();

                if($user->user_type == "customer") {
                    $customer = Customers::where(["id" => $user->user_id])->firstOrFail();
                    $customer->status = 1;
                    $customer->save();
                } else if($user->user_type == "provider") {
                    $trader = Providers::where(["id" => $user->user_id])->firstOrFail();
                    $trader->status = 1;
                    $trader->save();
                }

                $message = "Your account has been verified.!Please login.!";

            } else {

                $message = "Token mismatch..!Please try again later.!!";

            }
        } else {

            $message = "Sorry.!!The user doesn't exists.";

        }
        return view('web-ui.account-verify',compact('message'));
    }

    public function forgot_password() {

        return view('web-ui.forgot-password');

    }

    public function reset_password_link(Request $request) {

        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        $user = User::where(['email' => $email])->firstOrFail();

        if($user != "") {

            $token = Str::random(32);
            $user->password_reset_token = $token;
            $user->save();

            $reset_password_link = [
                'title' => 'Reset Password Link',
                'name' => $user->name,
                'url' => route('reset-password',['email'=>Crypt::encryptString($email),'verifytoken'=>Crypt::encryptString($token)]) 
            ];
      
            Mail::to($email)->send(new ForgotPasswordMail($reset_password_link));

            return redirect()->route('forgot-password')->with('success','Password reset link has been sent to your email.');

        } else {

            return redirect()->route('forgot-password')->with('danger','This email id is invalid.!!');

        }
    }

    public function resetpassword($email, $token) {
        
        $decrypt_email =  Crypt::decryptString($email);
        $decrypt_token = Crypt::decryptString($token);

        $user = User::where(['email' => $decrypt_email])->firstOrFail();

        if($user != "") {
            if($user->password_reset_token == $decrypt_token) {

                return view('web-ui.reset-password',compact('email','decrypt_token'));

            } else {

                $message = "Token mismatch..!Please try again later.!!";

            }
        } else {

            $message = "Sorry.!!The user doesn't exists.";

        }
        return view('web-ui.account-verify',compact('message'));
    }

    public function reset_password(Request $request) {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = Crypt::decryptString($request->email);
        $token = $request->retoken;

        $user = User::where(['email' => $email])->firstOrFail();

        if($user != "") {

            if($user->password_reset_token == $token) { 

                $user->password = Hash::make($request->password);
                $user->password_reset_token = "";
                $user->save();

                $message = "Password reset done successfully.!";

            } else {

                $message = "Token mismatch..!Please try again later.!!";

            }

        } else {

            $message = "Sorry.!!The user doesn't exists.";

        }

        return view('web-ui.password-change',compact('message'));
    }

    public function changepassword() {

        if(Auth::guard('web')->check()) {

            return view('web-ui.change-password');
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function update_password(Request $request) {

        if(Auth::guard('web')->check()) {

            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user_id = Auth::guard('web')->user()->user_id;
            $user_type = Auth::guard('web')->user()->user_type;

            $user = User::where(['user_type' => $user_type,'user_id' => $user_id])->firstOrFail();

            if($user != "") {

                $user->password = Hash::make($request->password);
                $user->save();

                $message["status"] = "success";
                $message["message"] = "Password updated successfully..!!";
            } else {

                $message["status"] = "danger";
                $message["message"] = "Something went wrong.PLease try again.!!";
            }

            return view('web-ui.change-password',compact('message'));

        } else {

            return view('web-ui.errors.404');
        }
    }

    public function search_providers(Request $request) {
        
        $categories = Categories::where('status',1)->get();

        if($request->lat != "" || $request->long != "") {
            // $providers = Providers::select('providers.*','categories.category', '( 6371 * acos( cos( radians('.$request->lat.') ) * cos( radians( `loc_latitude` ) ) * cos( radians( `loc_longitude` ) - radians('.$request->long.') ) + sin( radians('.$request->lat.') ) * sin( radians(`loc_latitude`) ) ) ) AS distance')->join('provider_categories','providers.id', '=', 'provider_categories.provider_id')->join('categories','provider_categories.category_id','=','categories.id')->having('distance', '<', 10)->having('providers.status', '=', 1)->having('categories.category', 'LIKE', "'%$request->trade%'")->orderBy('providers.rating', 'desc')->get();
            $providers = DB::SELECT("select distinct(`providers`.`id`),`providers`.*, `categories`.`category`, ( 6371 * acos( cos( radians('$request->lat') ) * cos( radians( `loc_latitude` ) ) * cos( radians( `loc_longitude` ) - radians('$request->long') ) + sin( radians('$request->lat') ) * sin( radians(`loc_latitude`) ) ) ) as `distance` from `providers` inner join `provider_categories` on `providers`.`id` = `provider_categories`.`provider_id` inner join `categories` on `provider_categories`.`sub_category_id` = `categories`.`id` having `distance` < '$request->distance' and `providers`.`status` = 1 and `categories`.`category` LIKE '%$request->trade%' order by `providers`.`id` desc");

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
                foreach($providers as $key => $provider) {
                    $search_history = new SearchHistory();
                    $search_history->trader_id = $provider->id;
                    $search_history->user_type = Auth::guard('web')->user()->user_type;
                    $search_history->user_id = Auth::guard('web')->user()->user_id;
                    $search_history->search_history = json_encode(["latitude" => $request->lat,"longitude" => $request->long,"trade_search" => $request->trade]);
                    $search_history->save();
                }
            }
            
        } else {

            return view('web-ui.errors.404');
        }

        return view('web-ui.trader.search-result',compact('providers','categories'));
    }

    public function getfaq() {

        $faqs = Faq::where('status',1)->get();

        return view('web-ui.pages.faq',compact('faqs'));
    }

    public function addtraderpost(Request $request) {

        $request->validate([
            'post_title' => 'required',
            'post_content' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderpost = new TraderPosts();
            $traderpost->trader_id = $request->trader_id;
            $traderpost->title = $request->post_title;
            $traderpost->post_content = $request->post_content;
            $traderpost->status = 1;
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

            return redirect()->route('traderdetails',$traderpost->getprovider->username)->with('success','Post added successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderdetails',$traderpost->getprovider->username)->with('danger','Something went wrong. Please try again later.!');
        }

    }

    public function addtraderoffer(Request $request) {

        $request->validate([
            'product_title' => 'required',
            'description' => 'required',
            'full_price' => 'required',
            'discount_price' => 'required',
            'valid_from_date' => 'required',
            'valid_from_time' => 'required',
            'valid_to_date' => 'required',
            'valid_to_time' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $traderoffer = new TraderOffers();
            $traderoffer->trader_id = $request->trader_id;
            $traderoffer->title = $request->product_title;
            $traderoffer->description = $request->description;
            $traderoffer->full_price = $request->full_price;
            $traderoffer->discount_price = $request->discount_price;
            $traderoffer->valid_from = date('d-m-Y',strtotime($request->valid_from_date)).' '.date('h:i A',strtotime($request->valid_from_time));
            $traderoffer->valid_to = date('d-m-Y',strtotime($request->valid_to_date)).' '.date('h:i A',strtotime($request->valid_to_time));
            $traderoffer->status = 1;
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

            return redirect()->route('traderdetails',$traderoffer->getprovider->username)->with('success','Offer created successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderdetails',$traderoffer->getprovider->username)->with('danger','Something went wrong. Please try again later.!');
        }

    }

    public function addtraderreview(Request $request) {

        $request->validate([
            'work_completed' => 'required',
            'review' => 'required',
            'reliability' => 'required',
            'cleanliness' => 'required',
            'response' => 'required',
            'accuracy' => 'required',
            'overall_experience' => 'required',
            'quotation' => 'required',
            'recommend' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $review = new Reviews();
            $review->trader_id = $request->trader_id;
            $review->user_id = $request->user_id;
            $review->work_completed = $request->work_completed;
            $review->service_id = isset($request->service_provided)?$request->service_provided:0;
            $review->service_date = isset($request->service_date)?date('d-m-Y',strtotime($request->service_date)):"";
            $review->review = $request->review;
            $review->reliability = $request->reliability;
            $review->tidiness = $request->cleanliness;
            $review->response = $request->response;
            $review->accuracy = $request->accuracy;
            $review->pricing = $request->quotation;
            $review->overall_exp = $request->overall_experience;
            $review->recommend = $request->recommend;
            $review->status = 0;
            $review->save();

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                $profile_visits = new ProfileVisits();
                $profile_visits->trader_id = $review->trader_id;
                $profile_visits->user_type = Auth::guard('web')->user()->user_type;
                $profile_visits->user_id = Auth::guard('web')->user()->user_id;
                $profile_visits->contacted = 1;
                $profile_visits->save();

                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $review->trader_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "reviewed your profile.";
                $notifications->reference_url = route('traderdetails',$review->getprovider->username);
                $notifications->status = 0;
                $notifications->save();
            }

            DB::commit();

            return redirect()->route('traderdetails',$review->getprovider->username)->with('success','Review added successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderdetails',$review->getprovider->username)->with('danger','Something went wrong. Please try again later.!');
        }

    }

    public function addreviewcomment(Request $request) {

        $request->validate([
            'review_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $reviewcomment = new TraderReviewComments();
            $reviewcomment->review_comment_id = $request->review_comment_id;
            $reviewcomment->review_id = $request->review_id;
            $reviewcomment->user_id = $request->user_id;
            $reviewcomment->user_type = $request->user_type;
            $reviewcomment->comment = $request->review_comment;
            $reviewcomment->status = 1;
            $reviewcomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "made a comment on your review.";
            $notifications->reference_url = route('traderdetails',$reviewcomment->gettraderreview->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.review-comments',compact('reviewcomment','commentsCount'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addreviewcommentreply(Request $request) {

        $request->validate([
            'review_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $reviewcomment = new TraderReviewComments();
            $reviewcomment->review_comment_id = $request->review_comment_id;
            $reviewcomment->review_id = $request->review_id;
            $reviewcomment->user_id = $request->user_id;
            $reviewcomment->user_type = $request->user_type;
            $reviewcomment->comment = $request->review_comment;
            $reviewcomment->status = 1;
            $reviewcomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "made a comment on your review.";
            $notifications->reference_url = route('traderdetails',$reviewcomment->gettraderreview->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.review-comments-reply',compact('reviewcomment'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function traderpostreaction(Request $request) {
        if($request->trader_post_id != "" && $request->user_type != "" && $request->user_id != "") {
            
            $post_like = TraderPostsLikes::where(["trader_post_id" => $request->trader_post_id,"user_type" => $request->user_type,"user_id" => $request->user_id])->first();
            if($post_like != "") {
                $post_like->reaction = $request->data_reaction;
                $post_like->save();
            } else {
                $postreaction = new TraderPostsLikes();
                $postreaction->trader_post_id = $request->trader_post_id;
                $postreaction->user_type = $request->user_type;
                $postreaction->user_id = $request->user_id;
                $postreaction->reaction = $request->data_reaction;
                $postreaction->save();

                $traderpost = TraderPosts::where(["id" => $request->trader_post_id])->first();
                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $traderpost->trader_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "reacted on your post.";
                $notifications->reference_url = route('traderdetails',$traderpost->getprovider->username);
                $notifications->status = 0;
                $notifications->save();
            }
        }

        $post_likes_count = TraderPostsLikes::where(["trader_post_id" => $request->trader_post_id])->count();

        return $post_likes_count;
        
    }

    public function traderofferreaction(Request $request) {
        if($request->trader_offer_id != "" && $request->user_type != "" && $request->user_id != "") {
            
            $offer_like = TraderOfferLikes::where(["trader_offer_id" => $request->trader_offer_id,"user_type" => $request->user_type,"user_id" => $request->user_id])->first();
            if($offer_like != "") {
                $offer_like->reaction = $request->data_reaction;
                $offer_like->save();
            } else {
                $offerreaction = new TraderOfferLikes();
                $offerreaction->trader_offer_id = $request->trader_offer_id;
                $offerreaction->user_type = $request->user_type;
                $offerreaction->user_id = $request->user_id;
                $offerreaction->reaction = $request->data_reaction;
                $offerreaction->save();

                $traderoffer = TraderOffers::where(["id" => $request->trader_offer_id])->first();
                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $traderoffer->trader_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "reacted on your offer.";
                $notifications->reference_url = route('traderdetails',$traderoffer->getprovider->username);
                $notifications->status = 0;
                $notifications->save();
            }
        }

        $offer_likes_count = TraderOfferLikes::where(["trader_offer_id" => $request->trader_offer_id])->count();

        return $offer_likes_count;
        
    }

    public function post_a_job() { 

        if(Auth::guard('web')->user()->user_type == "customer") {

            $categories = Categories::where(['parent_category' => 0, 'status' => 1])->get();

            return view('web-ui.jobs.post-job',compact('categories'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function getcategory(Request $request) {

        $categoryData = "";

        $maincategory = $request->maincategory;

        $categories = Categories::where(['parent_category' => 0, 'main_category' => $maincategory,'status' => 1])->get();

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

    public function getsubcategorytrader(Request $request) {

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

    public function getsubcategory(Request $request) {

        $categoryData = "";

        $categories = Categories::where(['parent_category' => $request->category,'status' => 1])->get();

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

    public function getjobssubcategory(Request $request) {

        $categoryData = "";

        $categories = Categories::where(['parent_category' => $request->category,'status' => 1])->get();

        if($categories != "") {
            $categoryData.='<option value="">Sub Category</option>';
            foreach($categories as $key => $cate) {
                $categoryData.='<option value="'.$cate->id.'">'.$cate->category.'</option>';
            }

        } else {
            $categoryData.='<option value="">Sub Category</option>';
        }

        return $categoryData;
    }

    public function postjob(Request $request) {

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
        
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'budget' => 'required',
                'job_completion' => 'required',
                'job_location' => 'required'
            ]);
            DB::beginTransaction();
            try{
                $jobs = new Jobs();
                $jobs->user_type = "customer";
                $jobs->user_id = $request->user_id;
                $jobs->category_id = $request->category_id;
                $category_id = $jobs->category_id;
                $jobs->sub_category_id = $request->sub_category_id;
                $sub_category_id = $jobs->sub_category_id;
                $jobs->title = $request->title;
                $jobs->description = $request->description;
                $jobs->budget = $request->budget;
                $jobs->job_completion = $request->job_completion;
                $jobs->status = 1;
                $jobs->job_status = $request->postjob;
                $jobs->job_location = $request->job_location;
                $jobs->latitude = $request->loc_latitude;
                $jobs->longitude = $request->loc_longitude;
                $jobs->material_purchased = isset($request->material_purchased)?1:0;
                $jobs->job_views = 0;
                $jobs->quote_provided = 0;
                $jobs->save();

                if(isset($request->job_images)) {
                    $request->validate([
                        'job_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->job_images as $key => $images) {
                        if($images != "") {
                            $jobsimage = new JobsImages();
                            $jobsimage->job_id = $jobs->id;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/jobs'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(350, 250, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/jobs') . '/' . $workFile);

                            $jobsimage->job_image = $workFile;
                            $jobsimage->save();
                        }
                    }
                }

                DB::commit();

                if($jobs->job_status == "Seek Quote") {
                    
                    return redirect()->route('customerseekquote',[$jobs->id,$category_id,$sub_category_id]);

                } elseif($jobs->job_status == "Published") {

                    return redirect()->route('jobsbystatus','published');

                } elseif($jobs->job_status == "Saved") {

                    return redirect()->route('jobsbystatus','draft');

                }

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('post-job');
            }
        }
    }

    public function trader_profile_postjob(Request $request) {

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {
        
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'budget' => 'required',
                'job_completion' => 'required',
                'job_location' => 'required'
            ]);
            DB::beginTransaction();
            try{
                $jobs = new Jobs();
                $jobs->user_type = "customer";
                $jobs->user_id = $request->user_id;
                $jobs->category_id = $request->category_id;
                $category_id = $jobs->category_id;
                $jobs->sub_category_id = $request->sub_category_id;
                $sub_category_id = $jobs->sub_category_id;
                $jobs->title = $request->title;
                $jobs->description = $request->description;
                $jobs->budget = $request->budget;
                $jobs->job_completion = $request->job_completion;
                $jobs->job_location = $request->job_location;
                $jobs->latitude = $request->loc_latitude;
                $jobs->longitude = $request->loc_longitude;
                $jobs->status = 1;
                $jobs->job_status = $request->postjob;
                $jobs->material_purchased = isset($request->material_purchased)?1:0;
                $jobs->job_views = 0;
                $jobs->quote_provided = 0;
                $jobs->save();

                if(isset($request->job_images)) {
                    $request->validate([
                        'job_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->job_images as $key => $images) {
                        if($images != "") {
                            $jobsimage = new JobsImages();
                            $jobsimage->job_id = $jobs->id;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/jobs'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(350, 250, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/jobs') . '/' . $workFile);

                            $jobsimage->job_image = $workFile;
                            $jobsimage->save();
                        }
                    }
                }

                $jobQuote = new JobQuotes();
                $jobQuote->job_id = $jobs->id;
                $jobQuote->trader_id = $request->trader_id;
                $jobQuote->customer_id = $request->user_id;
                $jobQuote->status = "Requested";
                $jobQuote->save();

                $traderDetails = Providers::where(['id' => $request->trader_id,'status' => 1])->first();

                $email = $traderDetails->email;

                $customerName = Auth::guard('web')->user()->name;

                $seekquote = [
                    'title' => 'New Job Quote Request Received',
                    'customer' => $customerName,
                    'trader' => $traderDetails->name
                ];
          
                Mail::to($email)->send(new SeekquoteMail($seekquote));

                DB::commit();

                return redirect()->route('traderdetails',$traderDetails->username)->with('success','Job posted successfully.');

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('traderdetails',$traderDetails->username)->with('danger','Something went wrong.Please try again later.!');
            }
        }
    }

    public function customerseekquote($job_id,$category_id,$sub_category_id) {
        
        $job = Jobs::where(['id' => $job_id])->firstOrFail();

        $providers = Providers::select('providers.*')->leftjoin('provider_categories','providers.id','=','provider_categories.provider_id')->where(['providers.status' => 1,'providers.is_available' => 1,'provider_categories.category_id' => $category_id,'provider_categories.sub_category_id' => $sub_category_id])->orderBy('id', 'desc')->get();

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

            if($providers != "") {
                foreach($providers as $key => $provider) {
                    $search_history = new SearchHistory();
                    $search_history->trader_id = $provider->id;
                    $search_history->user_type = Auth::guard('web')->user()->user_type;
                    $search_history->user_id = Auth::guard('web')->user()->user_id;
                    $search_history->search_history = json_encode(["category" => $category_id,"sub_category" => $sub_category_id,"job" => $job_id]);
                    $search_history->save();
                }
            }
        } 

        return view('web-ui.customer.seek-quote-traders-list',compact('providers','job'));
    }

    public function getbazaarproducts() {

        $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

        $products = Bazaar::with('bazaarimages')->where('status',1)->orderBy('id','desc')->get();

        return view('web-ui.bazaar.index',compact('categories','products'));
    }

    public function getbazaarproductsbycategory($category) {

        $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

        $products = Bazaar::with('bazaarimages')->where(['status'=> 1,'category_id' => $category])->orderBy('id','desc')->get();

        return view('web-ui.bazaar.index',compact('categories','products'));
    }

    public function bazaarsearch(Request $request) {

        // $products = Bazaar::with('bazaarimages')->where('status',1)->where('category_id', $request->category)->where('sub_category_id', $request->subcategory)->where('product','like', '%' . $request->product . '%')->orderBy('id','desc')->get();

        $products = DB::SELECT("select distinct(`bazaar`.`id`),`bazaar`.*, ( 6371 * acos( cos( radians('$request->latitude') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians(`latitude`) ) ) ) as `distance` from `bazaar` having `distance` < '$request->distance' and `bazaar`.`category_id` = '$request->category' and `bazaar`.`sub_category_id` = '$request->subcategory' AND `bazaar`.`product` LIKE '%$request->product%' AND `bazaar`.`status` = 1 order by `bazaar`.`id` desc");

        $search = ["product" => $request->product,"category" => $request->category,"subcategory" => $request->subcategory];

        return view('web-ui.bazaar.bazaar-search',compact('products','search'));
    }

    public function bazaarsortsearch(Request $request) {

        $sort_by = $request->sort_by;
        $search_product = $request->search_product;
        $search_cat = $request->search_cat;
        $search_sub_cat = $request->search_sub_cat;

        if($sort_by == 1) {
            $sort_key = 'id';
            $sort_value = 'desc'; 
        } elseif ($sort_by == 2) {
            $sort_key = 'price';
            $sort_value = 'asc'; 
        } elseif ($sort_by == 3) {
            $sort_key = 'id';
            $sort_value = 'asc'; 
        } elseif ($sort_by == 4) {
            $sort_key = 'price';
            $sort_value = 'desc'; 
        }

        if($sort_by != "" && $search_product != "" && $search_cat != "" && $search_sub_cat != "") {

            $products = Bazaar::with('bazaarimages')->where('status',1)->where('category_id', $search_cat)->where('sub_category_id', $search_sub_cat)->where('product','like', '%' . $search_product . '%')->orderBy($sort_key,$sort_value)->get();

            
        } else if ($sort_by != "" && $search_product == "" && $search_cat == "" && $search_sub_cat == "") {

            $products = Bazaar::with('bazaarimages')->where('status',1)->orderBy($sort_key,$sort_value)->get();

        }

        $search = ["product" => $search_product,"category" => $search_cat,"subcategory" => $search_sub_cat];

        return view('web-ui.bazaar.bazaar-search',compact('products','search'));
    }

    public function userbazaarbycategory($category) {

        if(Auth::guard('web')->check()) {

            $user_type = Auth::guard('web')->user()->user_type;
            $user_id = Auth::guard('web')->user()->user_id;

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $products = Bazaar::with('bazaarimages')->where(['status' => 1,'category_id' => $category,'added_usertype' => $user_type,'added_by' => $user_id])->orderBy('id','desc')->get();

            if(Auth::guard('web')->user()->user_type == "provider") {

                return view('web-ui.trader.bazaar',compact('categories','products'));

            } elseif (Auth::guard('web')->user()->user_type == "customer") {

                return view('web-ui.customer.bazaar',compact('categories','products'));
            }

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function userbazaarsearch(Request $request) {

        if(Auth::guard('web')->check()) {

            $user_type = Auth::guard('web')->user()->user_type;
            $user_id = Auth::guard('web')->user()->user_id;

            $products = DB::SELECT("select distinct(`bazaar`.`id`),`bazaar`.*, ( 6371 * acos( cos( radians('$request->latitude') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians(`latitude`) ) ) ) as `distance` from `bazaar` having `distance` < '$request->distance' and `bazaar`.`category_id` = '$request->category' and `bazaar`.`sub_category_id` = '$request->subcategory' AND `bazaar`.`product` LIKE '%$request->product%' AND `bazaar`.`status` = 1 order by `bazaar`.`id` desc");

            $search = ["product" => $request->product,"category" => $request->category,"subcategory" => $request->subcategory];

            if(Auth::guard('web')->user()->user_type == "provider") {

                return view('web-ui.trader.bazaar-search',compact('products','search'));

            } elseif (Auth::guard('web')->user()->user_type == "customer") {

                return view('web-ui.customer.bazaar-search',compact('products','search'));
            }

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function userbazaarsortsearch(Request $request) {

        if(Auth::guard('web')->check()) {

            $user_type = Auth::guard('web')->user()->user_type;
            $user_id = Auth::guard('web')->user()->user_id;

            $sort_by = $request->sort_by;
            $search_product = $request->search_product;
            $search_cat = $request->search_cat;
            $search_sub_cat = $request->search_sub_cat;

            if($sort_by == 1) {
                $sort_key = 'id';
                $sort_value = 'desc'; 
            } elseif ($sort_by == 2) {
                $sort_key = 'price';
                $sort_value = 'asc'; 
            } elseif ($sort_by == 3) {
                $sort_key = 'id';
                $sort_value = 'asc'; 
            } elseif ($sort_by == 4) {
                $sort_key = 'price';
                $sort_value = 'desc'; 
            }

            if($sort_by != "" && $search_product != "" && $search_cat != "" && $search_sub_cat != "") {

                $products = Bazaar::with('bazaarimages')->where('status',1)->where('category_id', $search_cat)->where('sub_category_id', $search_sub_cat)->where(['added_usertype' => $user_type,'added_by' => $user_id])->where('product','like', '%' . $search_product . '%')->orderBy($sort_key,$sort_value)->get();

                
            } else if ($sort_by != "" && $search_product == "" && $search_cat == "" && $search_sub_cat == "") {

                $products = Bazaar::with('bazaarimages')->where(['status' => 1,'added_usertype' => $user_type,'added_by' => $user_id])->orderBy($sort_key,$sort_value)->get();

            }

            $search = ["product" => $search_product,"category" => $search_cat,"subcategory" => $search_sub_cat];

            if(Auth::guard('web')->user()->user_type == "provider") {

                return view('web-ui.trader.bazaar-search',compact('products','search'));

            } elseif (Auth::guard('web')->user()->user_type == "customer") {

                return view('web-ui.customer.bazaar-search',compact('products','search'));
            }

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function badreviews(Request $request) {

        $provider = Providers::where(['status' => 1,'id' => $request->trader_id])->first();

        $reviews = Reviews::select('*')->selectRaw('((`reliability`+`tidiness`+`response`+`accuracy`+`pricing`+`overall_exp`)/6) as `finalrating`')->where(['status' => 1,'trader_id' => $request->trader_id])->having('finalrating', '<=', 1)->orderBy('id','DESC')->get();

        return view('web-ui.trader.bad-reviews',compact('reviews','provider'));
    }

    public function productdetails($id) {

        $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

        $product = Bazaar::with('bazaarimages')->where(['status' => 1,'id' => $id])->first();

        $related_products = Bazaar::where(['status' => 1,'category_id' => $product->category_id])->whereNotIn('id',[$product->id])->get();


        if($product != "") {

            return view('web-ui.bazaar.details',compact('product','related_products','categories'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function bookappointment(Request $request) {
        $request->validate([
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $appointment = new Appointments();
            $appointment->user_id = $request->user_id;
            $appointment->trader_id = $request->trader_id;
            $appointment->appointment_date = date('Y-m-d',strtotime($request->appointment_date));
            $appointment->appointment_time = date('H:i:s',strtotime($request->appointment_time));
            $appointment->remarks = "";
            $appointment->status = "Booked";
            $appointment->save();

            $traderDetails = Providers::where(['id' => $appointment->trader_id,'status' => 1])->first();

            $email = $traderDetails->email;

            $customerName = Auth::guard('web')->user()->name;

            $bookappointment = [
                'title' => 'Book Appointment',
                'customer' => $customerName,
                'trader' => $traderDetails->name
            ];
      
            Mail::to($email)->send(new BookappointmentMail($bookappointment));

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                $profile_visits = new ProfileVisits();
                $profile_visits->trader_id = $appointment->trader_id;
                $profile_visits->user_type = Auth::guard('web')->user()->user_type;
                $profile_visits->user_id = Auth::guard('web')->user()->user_id;
                $profile_visits->contacted = 1;
                $profile_visits->save();

                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $appointment->trader_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "booked an appointment.";
                $notifications->reference_url = route('trader-appointments');
                $notifications->status = 0;
                $notifications->save();
            }

            DB::commit();

            return redirect()->route('traderdetails',$traderDetails->username)->with('success','Booked appointment successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('traderdetails',$traderDetails->username)->with('danger','Something went wrong. Please try again later.!');
        }
    }

    public function sellatbazaar(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product' => 'required',
            'price' => 'required',
            'description' => 'required',
            'product_location' => 'required'
        ]);
        DB::beginTransaction();
        try{
            $product = new Bazaar();
            $product->category_id = $request->category_id;
            $product->sub_category_id = isset($request->sub_category_id)?$request->sub_category_id:0;
            $product->product = $request->product;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->status = 1;
            $product->product_location = $request->product_location;
            $product->latitude = $request->loc_latitude;
            $product->longitude = $request->loc_longitude;

            $product->added_usertype = Auth::guard('web')->user()->user_type;
            $product->added_by = Auth::guard('web')->user()->user_id;
            $product->save();

            if(isset($request->product_images)) {
                $request->validate([
                    'product_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->product_images as $key => $images) {
                    if($images != "") {
                        $bazaarimage = new BazaarImages();
                        $bazaarimage->bazaar_id = $product->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/bazaar/products'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 240, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/bazaar/products') . '/' . $workFile);

                        $bazaarimage->product_image = $workFile;
                        $bazaarimage->save();
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success','Product added successfully.');;

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger','Something went wrong.Please try again later.');;
        }
    }

    public function getbazaarsubcategory(Request $request) {

        $categoryData = "";

        $categories = BazaarCategory::where(['parent_category' => $request->category,'status' => 1])->get();

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

    public function getbazaar_subcategory(Request $request) {

        $categoryData = "";

        $categories = BazaarCategory::where(['parent_category' => $request->category,'status' => 1])->get();

        if($categories != "") {
            $categoryData.='<option value="">Sub Category</option>';
            foreach($categories as $key => $cate) {
                $categoryData.='<option value="'.$cate->id.'">'.$cate->category.'</option>';
            }

        } else {
            $categoryData.='<option value="">Sub Category</option>';
        }

        return $categoryData;
    }

    public function edittraderprofile($trader_id) { 

        if(Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $services = Services::where('status',1)->get();

            $trader = Providers::where(['id' => $trader_id,'status' => 1])->first();

            $categories = Categories::where(['status' => 1, 'parent_category' => 0, 'main_category' => $trader->main_category])->get();

            // $providerservicelocations = ProviderServicesLocations::where('provider_id',$trader_id)->groupBy('location')->get();

            $subcategories = Categories::where(['status' => 1, 'main_category' => $trader->main_category])->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $trader_id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $trader->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $trader->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $trader->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $trader->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.edit-profile',compact('trader','categories','subcategories','services','job_quote_count','job_count')); 

        } else {

            return view('web-ui.errors.404');

        }
        
    }

    public function updatetraderprofile($id,Request $request) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $provider = Providers::where('id',$id)->first();

            $request->validate([
                'type' => 'required',
                'category' => 'required',
                'main_category' => 'required',
                'name' => 'required',
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
                $provider->web_url = $request->web_url;
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
                $provider->status = 1;
                $provider->featured = isset($request->featured)?$request->featured:0;
                $provider->reference = isset($request->reference)?$request->reference:0;
                // $provider->rating = isset($request->rating)?$request->rating:0;
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
                    $user = User::where(['user_id' => $provider->id,'user_type' => 'provider'])->first();
                    if($user != "") {
                        $user->name = $provider->name;
                        $user->email = $provider->email;
                        $user->mobile = $provider->mobile;
                        $user->save();
                    }

                    $document_status = [];
                    if($request->proof_type != "") {

                        $request->validate([
                            'document[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                        ]);
                        foreach($request->proof_type as $key => $proofType) {
                            if($proofType != "") {                 
                                $providerDocument = ProviderDocuments::where('id',$request->provider_doc_id[$key])->first();
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
                                $providerDocument->upload_later = isset($request->upload_later[$key])?$request->upload_later[$key]:0;
                                $providerDocument->verified = 1;
                                $providerDocument->status = 1;
                                $providerDocument->save();

                                $document_status[$proofType] = ($providerDocument->verified == 1) ? 1 : 0;
                            }
                        }
                    }

                    // if($document_status['ID Proof'] == 0 || $document_status['Address Proof'] == 0 || $provider->reference == 0)
                    // {
                    //     $provider->status = 0;
                    //     $provider->save();
                    // }
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

                    // if(isset($request->removeImg)) {
                    //     foreach ($request->removeImg as $key => $img) {
                    //         $removeWork = ProviderWorks::where('id',$img)->firstOrFail();
                    //         unlink(public_path('uploads/providers/works/'.$removeWork->image));
                    //         $removeWork->delete();
                    //     }
                    // }

                    if(isset($request->completed_images) && $request->completed_images != "") { 
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
                }

                DB::commit();

                return redirect()->route('traderdetails',$provider->username)->with('success','Profile updated successfully');

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger','Something went wrong.Please try again later.');
            }

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function traderprofileupdate(Request $request) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $provider = Providers::where('id',$request->trader_id)->first();

            if ($request->step == 1) {
                   $request->validate([
                    'type' => 'required',
                    'main_category' => 'required',
                    'name' => 'required',
                    'country_code' => 'required',
                    'service_location_radius' => 'required',
                    'available_time_from' => 'required',
                    'available_time_to' => 'required',
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

            } elseif ($request->step == 2) {
                $request->validate([
                    'location' => 'required',
                    'landmark' => 'required',
                    'landmark_desc' => 'required',
                ]);
            } elseif ($request->step == 4) {
                $request->validate([
                    'category' => 'required',
                    'services' => 'required',
                ]);
            }

            if ($provider != "") {
                if($request->step == 1) {
                    $profile_pic = $provider->profile_pic;
                    $provider->type = $request->type;
                    $provider->main_category = $request->main_category;
                    $provider->handyman = isset($request->handyman)?$request->handyman:0;
                    $provider->name = $request->name;
                    $provider->email = $request->email;
                    $provider->web_url = $request->web_url;
                    $provider->country_code = $request->country_code;
                    $provider->mobile = $request->mobile;
                    $provider->address = $request->address;

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

                    $provider->service_location_radius = $request->service_location_radius;
                    $provider->available_time_from = strtotime($request->available_time_from);
                    $provider->available_time_to = strtotime($request->available_time_to);
                    $provider->is_available = isset($request->is_available)?$request->is_available:0;
                    $provider->appointment = isset($request->appointment)?$request->appointment:0;
                    $provider->status = 1;
                    $provider->reference = isset($request->reference)?$request->reference:0;

                    $provider->save();

                    $user = User::where(['user_id' => $provider->id,'user_type' => 'provider'])->first();
                    if($user != "") {
                        $user->name = $provider->name;
                        $user->email = $provider->email;
                        $user->mobile = $provider->mobile;
                        $user->save();
                    }

                } elseif ($request->step == 2) {
                    $provider->location = $request->location;
                    $provider->loc_latitude = $request->loc_latitude;
                    $provider->loc_longitude = $request->loc_longitude;
                    $provider->landmark = $request->landmark;
                    $provider->land_latitude = $request->land_latitude;
                    $provider->land_longitude = $request->land_longitude;
                    $provider->landmark_data = $request->landmark_desc;

                    $provider->save();
                } elseif ($request->step == 3) {
                    $document_status = [];
                    if($request->proof_type != "") {
                        $request->validate([
                            'document[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                        ]);
                        foreach($request->proof_type as $key => $proofType) {
                            if($proofType != "") {                 
                                $providerDocument = ProviderDocuments::where('id',$request->provider_doc_id[$key])->first();
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
                                $providerDocument->upload_later = isset($request->upload_later[$key])?$request->upload_later[$key]:0;
                                $providerDocument->verified = 1;
                                $providerDocument->status = 1;
                                $providerDocument->save();

                                $document_status[$proofType] = ($providerDocument->verified == 1) ? 1 : 0;
                            }
                        }
                    }

                    if(isset($request->removeImg)) {
                        foreach ($request->removeImg as $key => $img) {
                            $removeWork = ProviderWorks::where('id',$img)->first();
                            unlink(public_path('uploads/providers/works/'.$removeWork->image));
                            $removeWork->delete();
                        }
                    }

                    if(isset($request->completed_images) && $request->completed_images != "") {
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
                    
                    $provider->completed_works = isset($request->completed_works)?$request->completed_works:"";
                    $provider->save();

                } elseif ($request->step == 4) {
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
                        foreach($request->services as $key => $service) {
                            if($service != "") {
                                $providerService = new ProviderServices();
                                $providerService->provider_id = $provider->id;
                                $providerService->service_id = $service;
                                $providerService->status = 1;
                                $providerService->save();
                            }
                        }
                    }
                }
            } else {
                return false;
            }
            
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function getjobs() {

        $categories = Categories::where(['parent_category' => 0, 'status' => 1])->get();

        $jobs = Jobs::with('jobimages')->where(['status' => 1])->whereNotIn('job_status',['Unpublished','Completed','Saved','Ongoing'])->orderBy('id','desc')->get();

        return view('web-ui.jobs.index',compact('categories','jobs'));
    }

    public function get_jobs_list(Request $request) {

        $jobs = Jobs::with('jobimages')->where(['status' => 1])->whereIn('category_id', [$request->category])->whereNotIn('job_status',['Unpublished','Completed','Saved','Ongoing'])->orderBy('id','desc')->get();

        return view('web-ui.jobs.jobs-search',compact('jobs'));
    }

    public function jobssearch(Request $request) {

        // $jobs = Jobs::with('jobimages')->where('status', 1)->where('category_id', $request->category)->where('sub_category_id', $request->subcategory)->where('title','like', '%' . $request->keyword . '%')->whereNotIn('job_status',["'Unpublished','Completed','Saved'"])->orderBy('id','desc')->get();

        $jobs = DB::SELECT("select distinct(`jobs`.`id`),`jobs`.*, ( 6371 * acos( cos( radians('$request->latitude') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians(`latitude`) ) ) ) as `distance` from `jobs` having `distance` < '$request->distance' and `jobs`.`category_id` = '$request->category' and `jobs`.`sub_category_id` = '$request->subcategory' AND `jobs`.`title` LIKE '%$request->keyword%' AND `jobs`.`job_status` NOT IN ('Unpublished','Completed','Saved','Ongoing') order by `jobs`.`id` desc");

        return view('web-ui.jobs.jobs-search',compact('jobs'));
    }

    public function traderappointments() {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $provider = Providers::where(['id' => $trader_id,'status' => 1])->first();

            $appointments = Appointments::where(['trader_id' => $trader_id])->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $trader_id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $trader->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.appointments',compact('appointments','provider','job_quote_count','job_count'));
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function addpostcomment(Request $request) {

        $request->validate([
            'post_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $postcomment = new TraderPostsComments();
            $postcomment->post_comment_id = $request->post_comment_id;
            $postcomment->trader_post_id = $request->trader_post_id;
            $postcomment->user_id = $request->user_id;
            $postcomment->user_type = $request->user_type;
            $postcomment->comment = $request->post_comment;
            $postcomment->status = 1;
            $postcomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "commented on your post.";
            $notifications->reference_url = route('traderdetails',$postcomment->gettraderpost->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.post-comments',compact('postcomment','commentsCount'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addpostcommentreply(Request $request) {

        $request->validate([
            'post_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $postcomment = new TraderPostsComments();
            $postcomment->post_comment_id = $request->post_comment_id;
            $postcomment->trader_post_id = $request->trader_post_id;
            $postcomment->user_id = $request->user_id;
            $postcomment->user_type = $request->user_type;
            $postcomment->comment = $request->post_comment;
            $postcomment->status = 1;
            $postcomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "replied to your comment.";
            $notifications->reference_url = route('traderdetails',$postcomment->gettraderpost->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            return view('web-ui.trader.post-comments-reply',compact('postcomment'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addpostcommentcustomer(Request $request) {

        $request->validate([
            'post_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $postcomment = new TraderPostsComments();
            $postcomment->post_comment_id = $request->post_comment_id;
            $postcomment->trader_post_id = $request->trader_post_id;
            $postcomment->user_id = $request->user_id;
            $postcomment->user_type = $request->user_type;
            $postcomment->comment = $request->post_comment;
            $postcomment->status = 1;
            $postcomment->save();

            $notifications = new Notifications();
            $traderpost = TraderPosts::where(["id" => $request->trader_post_id])->first();
            $notifications->user_type = "trader";
            $notifications->user_id = $traderpost->trader_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "commented on your post.";
            $notifications->reference_url = route('traderdetails',$postcomment->gettraderpost->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.post-comments',compact('postcomment','commentsCount'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addpostcommentcustomerreply(Request $request) {

        $request->validate([
            'post_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $postcomment = new TraderPostsComments();
            $postcomment->post_comment_id = $request->post_comment_id;
            $postcomment->trader_post_id = $request->trader_post_id;
            $postcomment->user_id = $request->user_id;
            $postcomment->user_type = $request->user_type;
            $postcomment->comment = $request->post_comment;
            $postcomment->status = 1;
            $postcomment->save();

            $notifications = new Notifications();
            $traderpost = TraderPosts::where(["id" => $request->trader_post_id])->first();
            $notifications->user_type = "trader";
            $notifications->user_id = $traderpost->trader_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "replied to your comment.";
            $notifications->reference_url = route('traderdetails',$postcomment->gettraderpost->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            

            return view('web-ui.trader.post-comments-reply',compact('postcomment'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addoffercomment(Request $request) {

        $request->validate([
            'offer_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $offercomment = new TraderOffersComments();
            $offercomment->offer_comment_id = $request->offer_comment_id;
            $offercomment->trader_offer_id = $request->trader_offer_id;
            $offercomment->user_id = $request->user_id;
            $offercomment->user_type = $request->user_type;
            $offercomment->comment = $request->offer_comment;
            $offercomment->status = 1;
            $offercomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "commented on your offer.";
            $notifications->reference_url = route('traderdetails',$offercomment->gettraderoffer->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.offer-comments',compact('offercomment','commentsCount'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addoffercommentreply(Request $request) {

        $request->validate([
            'offer_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $offercomment = new TraderOffersComments();
            $offercomment->offer_comment_id = $request->offer_comment_id;
            $offercomment->trader_offer_id = $request->trader_offer_id;
            $offercomment->user_id = $request->user_id;
            $offercomment->user_type = $request->user_type;
            $offercomment->comment = $request->offer_comment;
            $offercomment->status = 1;
            $offercomment->save();

            $notifications = new Notifications();
            $notifications->user_type = "trader";
            $notifications->user_id = $request->provider_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "replied to your comment.";
            $notifications->reference_url = route('traderdetails',$offercomment->gettraderoffer->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            return view('web-ui.trader.offer-comments-reply',compact('offercomment'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addoffercommentcustomer(Request $request) {

        $request->validate([
            'offer_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $offercomment = new TraderOffersComments();
            $offercomment->offer_comment_id = $request->offer_comment_id;
            $offercomment->trader_offer_id = $request->trader_offer_id;
            $offercomment->user_id = $request->user_id;
            $offercomment->user_type = $request->user_type;
            $offercomment->comment = $request->offer_comment;
            $offercomment->status = 1;
            $offercomment->save();

            $notifications = new Notifications();
            $traderoffer = TraderOffers::where(["id" => $request->trader_offer_id])->first();
            $notifications->user_type = "trader";
            $notifications->user_id = $traderoffer->trader_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "commented on your offer.";
            $notifications->reference_url = route('traderdetails',$offercomment->gettraderoffer->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            $commentsCount = $request->allcomments;

            return view('web-ui.trader.offer-comments',compact('offercomment','commentsCount'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function addoffercommentcustomerreply(Request $request) {

        $request->validate([
            'offer_comment' => 'required',
        ]);

        DB::beginTransaction();

        try{
            $offercomment = new TraderOffersComments();
            $offercomment->offer_comment_id = $request->offer_comment_id;
            $offercomment->trader_offer_id = $request->trader_offer_id;
            $offercomment->user_id = $request->user_id;
            $offercomment->user_type = $request->user_type;
            $offercomment->comment = $request->offer_comment;
            $offercomment->status = 1;
            $offercomment->save();

            $notifications = new Notifications();
            $traderoffer = TraderOffers::where(["id" => $request->trader_offer_id])->first();
            $notifications->user_type = "trader";
            $notifications->user_id = $traderoffer->trader_id;
            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
            $notifications->notification = "replied to your comment.";
            $notifications->reference_url = route('traderdetails',$offercomment->gettraderoffer->getprovider->username);
            $notifications->status = 0;
            $notifications->save();

            DB::commit();

            return view('web-ui.trader.offer-comments-reply',compact('offercomment'));

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function customerhome()
    {
        if(Auth::guard('web')->user()->user_type == "customer")
        {
            $id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $id,'status' => 1])->firstOrFail();

            $posts = TraderPosts::with('traderpostimages','traderpostcomments','traderpostreports')->where(['status' => 1])->orderBy('id','desc')->get();

            $offers = TraderOffers::with('traderofferimages','traderoffercomments')->where(['status' => 1])->orderBy('id','desc')->get();

            $bazaar = Bazaar::with('bazaarimages')->where(['status' => 1])->orderBy('id','desc')->get();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $id])->count();

            if($customer != "") {

                return view('web-ui.customer.home',compact('customer','posts','offers','bazaar','categories','job_count','following','favorites'));

            } else {

                return view('web-ui.errors.404');

            }

        } else {
            return view('web-ui.errors.404');
        }
    }

    public function customerappointments() {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $customer_id,'status' => 1])->first();

            $appointments = Appointments::where(['user_id' => $customer_id])->get();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            return view('web-ui.customer.appointments',compact('appointments','customer','categories','job_count','following','favorites'));
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function shortlistproduct(Request $request) {
        if($request->product_id != "" && $request->user_type != "" && $request->user_id != "") {

            $wishlist = new ProductsWishlist();
            $wishlist->user_type = $request->user_type;
            $wishlist->user_id = $request->user_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->shortlist = 1;
            $wishlist->save();

        }
        return $wishlist->id;
        
    }

    public function removeshortlistproduct(Request $request) {
        if($request->product_id != "" && $request->user_type != "" && $request->user_id != "") {

            $wishlist = ProductsWishlist::where(["product_id" => $request->product_id,"user_type" => $request->user_type,"user_id" => $request->user_id])->first();

            $wishlist->delete();

        }
        return TRUE;
        
    }

    public function customerwishlistproducts() {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $customer_id,'status' => 1])->first();

            $products = Bazaar::select('bazaar.*')->leftjoin('products_wishlist','bazaar.id', '=', 'products_wishlist.product_id')->where(['user_type' => 'customer','user_id' => $customer_id,'status' => 1])->get();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            return view('web-ui.customer.wishlist',compact('customer','products','categories','job_count','following','favorites'));
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function editcustomerprofile() { 

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $customer_id,'status' => 1])->first();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            return view('web-ui.customer.edit-profile',compact('customer','categories','job_count','following','favorites')); 

        } else {

            return view('web-ui.errors.404');

        }
        
    }

    public function updatecustomerprofile(Request $request, $id) {

        $customer = Customers::where('id',$id)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'country_code' => 'required',
            'mobile' => 'required', 
            'location' => 'required',
        ]);

        if($request->email != $customer->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email',
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

            return redirect()->route('customerhome')->with('success','Profile updated successfully.');

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->route('customerhome')->with('danger','Something went wrong. Please try again later.!!');
        }

    }

    public function addpostreport(Request $request) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $request->validate([
                'reason' => 'required',
            ]);
            DB::beginTransaction();

            try{
                $reportdata = TraderPostsReports::where(['trader_post_id' => $request->trader_post_id,'customer_id' => $request->user_id])->first();

                if($reportdata == "") {

                    $report = new TraderPostsReports();
                    $report->trader_post_id = $request->trader_post_id;
                    $report->customer_id = $request->user_id;
                    $report->description = $request->reason;
                    $report->save();

                    $notifications = new Notifications();
                    $traderpost = TraderPosts::where(["id" => $request->trader_post_id])->first();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $traderpost->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "reported on your post.";
                    $notifications->reference_url = route('traderdetails',$traderpost->getprovider->username);
                    $notifications->status = 0;
                    $notifications->save();

                    DB::commit();

                    return redirect()->route('customerhome');
                } else {

                    return redirect()->route('customerhome');

                }

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('customerhome');
            }
        }

    }

    public function jobsbystatus($job_status) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $categories = Categories::where(['parent_category' => 0, 'status' => 1])->get();

            $user_id = Auth::guard('web')->user()->user_id;

            if($job_status == "draft") {

                $title = 'Draft Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Saved'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "published") {

                $title = 'Live/ Posted Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Published'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "seekquote") {

                $title = 'Seeking Quote Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Seek Quote'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "completed") {

                $title = 'Completed Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Completed'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "unpublished") {

                $title = 'Unpublished Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Unpublished'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "accepted") {

                $title = 'Accepted Jobs';

                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $user_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->groupBy('jobs.id')->orderBy('jobs.id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "rejected") {

                $title = 'Rejected Jobs';

                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $user_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->orderBy('jobs.id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } elseif($job_status == "ongoing") {

                $title = 'Ongoing Jobs';

                $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Ongoing'])->orderBy('id','desc')->get();

                return view('web-ui.customer.jobs',compact('categories','jobs','title','job_status'));

            } else {

                return view('web-ui.errors.404');

            }

        } else {

            return view('web-ui.errors.404');

        }
    }


    public function jobsbystatusbycategory(Request $request) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $user_id = Auth::guard('web')->user()->user_id;

            $job_status = $request->job_status;

            $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Saved'])->whereIn('category_id', [$request->category])->orderBy('id','desc')->get();

            return view('web-ui.customer.jobs-search',compact('jobs','job_status'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function custjobssearch(Request $request) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $user_id = Auth::guard('web')->user()->user_id;

            $job_status = $request->job_status;

            // $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Saved'])->where('category_id', $request->category)->where('sub_category_id', $request->subcategory)->where('title','like', '%' . $request->keyword . '%')->orderBy('id','desc')->get();

            $jobs = DB::SELECT("select distinct(`jobs`.`id`),`jobs`.*, ( 6371 * acos( cos( radians('$request->latitude') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('$request->longitude') ) + sin( radians('$request->latitude') ) * sin( radians(`latitude`) ) ) ) as `distance` from `jobs` having `distance` < '$request->distance' and `jobs`.`user_id` = '$user_id' and `jobs`.`category_id` = '$request->category' and `jobs`.`sub_category_id` = '$request->subcategory' AND `jobs`.`title` LIKE '%$request->keyword%' order by `jobs`.`id` desc");

            return view('web-ui.customer.jobs-search',compact('jobs','job_status'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function changejobstatus($jobId,$job_status) { 

        if(Auth::guard('web')->user()->user_type == "customer") {

            if($job_status == "postjob") {

                $data = Jobs::where('id',$jobId)->firstOrFail();

                $data->job_status = "Published";
                $data->save();

            } elseif($job_status == "unpublish") {

                $data = Jobs::where('id',$jobId)->firstOrFail();

                $data->job_status = "Unpublished";
                $data->save();

            } elseif($job_status == "completed") {

                $data = Jobs::where('id',$jobId)->firstOrFail();

                $data->job_status = "Completed";
                $data->save();

            } else {

                return view('web-ui.errors.404');

            }

            return redirect()->back();

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function deletejob($id) { 

        if(Auth::guard('web')->user()->user_type == "customer") {

            $job = Jobs::with('jobimages')->where('id',$id)->firstOrFail();
        
            if($job != "") {
                if($job->jobimages != "") {
                    foreach($job->jobimages as $key => $image) {
                        if($image->job_image != "") {
                            unlink(public_path('uploads/jobs/'.$image->job_image));
                        }
                        $image->delete();
                    }
                }
                
                $job->delete();
            }

            return redirect()->back();

        } else {

            return view('web-ui.errors.404');

        }

    }

    public function editcustomerjob($id) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $job = Jobs::with('jobimages')->where('id',$id)->firstOrFail();

            $categories = Categories::where(['parent_category' => 0, 'status' => 1])->get();

            $subcategories = Categories::where(['parent_category' => $job->category_id, 'status' => 1])->get();

            if($job != "") {

                return view('web-ui.jobs.edit-job',compact('categories','job','subcategories'));

            } else {

                return view('web-ui.errors.404');

            }

        } else {

            return view('web-ui.errors.404');
            
        }
    }

    public function updatecustomerjob(Request $request,$id) {
        
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'job_completion' => 'required',
            'job_location' => 'required'
        ]);
        $jobs = Jobs::where('id',$id)->first();
        DB::beginTransaction();
        try{
            $jobs->category_id = $request->category_id;
            $jobs->sub_category_id = $request->sub_category_id;
            $jobs->title = $request->title;
            $jobs->description = $request->description;
            $jobs->budget = $request->budget;
            $jobs->job_completion = $request->job_completion;
            $jobs->job_location = $request->job_location;
            $jobs->latitude = $request->loc_latitude;
            $jobs->longitude = $request->loc_longitude;
            $jobs->material_purchased = isset($request->material_purchased)?1:0;
            $jobs->save();

            if(isset($request->job_images)) {
                $request->validate([
                    'job_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                ]);
                foreach ($request->job_images as $key => $images) {
                    if($images != "") {
                        $jobsimage = new JobsImages();
                        $jobsimage->job_id = $jobs->id;
                        $workFile = time().'_'.$images->getClientOriginalName(); 
                        // $images->move(public_path('uploads/jobs'), $workFile);

                        $img = Image::make($images->path());

                        $img->resize(350, 250, function ($const) {
                            $const->aspectRatio();
                        })->save(public_path('uploads/jobs') . '/' . $workFile);

                        $jobsimage->job_image = $workFile;
                        $jobsimage->save();
                    }
                }
            }

            DB::commit();

            if($jobs->job_status == "Saved" || $jobs->job_status == "Unpublished") {

            if($jobs->job_status == "Saved") {
                $status = "draft";
            } else if($jobs->job_status == "Unpublished") {
                $status = "unpublished";
            }

            return redirect()->route('jobsbystatus',$status)->with('success','Job updated successfully.');

        } else if($jobs->job_status == "Seek Quote") {
                return redirect()->route('clarification-requests')->with('success','Job updated successfully.');
        } 

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger','Something went wrong.Please try again later.!');
        }
    }

    public function jobseekquote($job_id) { 

        if($job_id != "") {

            $job = Jobs::where(['id' => $job_id])->firstOrFail();

            if($job != "") {

                $providers = Providers::select('providers.*')->leftjoin('provider_categories','providers.id','=','provider_categories.provider_id')->where(['providers.status' => 1,'providers.is_available' => 1,'provider_categories.category_id' => $job->category_id,'provider_categories.sub_category_id' => $job->sub_category_id])->orderBy('id', 'desc')->get();

                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                    if($providers != "") {
                        foreach($providers as $key => $provider) {
                            $search_history = new SearchHistory();
                            $search_history->trader_id = $provider->id;
                            $search_history->user_type = Auth::guard('web')->user()->user_type;
                            $search_history->user_id = Auth::guard('web')->user()->user_id;
                            $search_history->search_history = json_encode(["category" => $job->category_id,"sub_category" => $job->sub_category_id,"job" => $job_id]);
                            $search_history->save();
                        }
                    }
                }

                return view('web-ui.customer.seek-quote-traders-list',compact('providers','job'));

            } else {

                return view('web-ui.errors.404');

            }
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function traderrequestquote($job_id,$trader_id) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $job_quote = JobQuotes::where(['job_id' => $job_id,'trader_id' => $trader_id,'customer_id' => $customer_id,'status' => 'Requested'])->first();

            if($job_quote == "") {

                $jobQuote = new JobQuotes();
                $jobQuote->job_id = $job_id;
                $jobQuote->trader_id = $trader_id;
                $jobQuote->customer_id = $customer_id;
                $jobQuote->status = "Requested";
                $jobQuote->seek_quote = 1;
                $jobQuote->save();

                $traderDetails = Providers::where(['id' => $trader_id,'status' => 1])->first();

                $email = $traderDetails->email;

                $customerName = Auth::guard('web')->user()->name;

                $seekquote = [
                    'title' => 'New Job Quote Request Received',
                    'customer' => $customerName,
                    'trader' => $traderDetails->name
                ];
          
                Mail::to($email)->send(new SeekquoteMail($seekquote));

                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $trader_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "requested a job quote.";
                $notifications->reference_url = route('traderjobsquoterequests');
                $notifications->status = 0;
                $notifications->save();

                if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                    $profile_visits = new ProfileVisits();
                    $profile_visits->trader_id = $jobQuote->trader_id;
                    $profile_visits->user_type = Auth::guard('web')->user()->user_type;
                    $profile_visits->user_id = Auth::guard('web')->user()->user_id;
                    $profile_visits->contacted = 1;
                    $profile_visits->save();
                }

                return redirect()->back()->with('success','You have successfully sent seek quote request for this job.!');

            } elseif ($job_quote->seek_quote == 1) {
                
                return redirect()->back()->with('danger','You have already sent seek quote request for this job.!');

            } elseif ($job_quote->seek_quote == 0) {

                $job_quote->seek_quote = 1;
                $job_quote->save();
                return redirect()->back()->with('success','You have successfully sent seek quote request for this job.!');

            }

        } else {

            return view('web-ui.errors.404');

        }

    }

    // public function traderseekquote($job_id,$trader_id) {

    //     if(Auth::guard('web')->user()->user_type == "provider") {

    //         // $customer_id = Auth::guard('web')->user()->user_id;

    //         $job = Jobs::where(['id' => $job_id])->first();

    //         $job_quote = JobQuotes::where(['job_id' => $job_id,'trader_id' => $trader_id,'customer_id' => $job->user_id,'status' => 'Requested'])->first();

    //         if($job_quote == "") {

    //             $jobQuote = new JobQuotes();
    //             $jobQuote->job_id = $job_id;
    //             $jobQuote->trader_id = $trader_id;
    //             $jobQuote->customer_id = $job->user_id;
    //             $jobQuote->status = "Requested";
    //             $jobQuote->give_quote = 1;
    //             $jobQuote->save();

    //             $job->job_status = "Seek Quote";
    //             $job->quote_provided = 1;
    //             $job->save();

    //             $customerDetails = Customers::where(['id' => $job->user_id,'status' => 1])->first();

    //             $email = $customerDetails->email;

    //             $traderName = Auth::guard('web')->user()->name;

    //             $seekquote = [
    //                 'title' => 'New Job Quote Request Received',
    //                 'customer' => $traderName,
    //                 'trader' => $customerDetails->name
    //             ];
          
    //             Mail::to($email)->send(new SeekquoteMail($seekquote));

    //             $notifications = new Notifications();
    //             $notifications->user_type = "customer";
    //             $notifications->user_id = $jobQuote->customer_id;
    //             $notifications->from_user_type = Auth::guard('web')->user()->user_type;
    //             $notifications->from_user_id = Auth::guard('web')->user()->user_id;
    //             $notifications->notification = "requested a job quote.";
    //             $notifications->reference_url = route('customerhome');
    //             $notifications->status = 0;
    //             $notifications->save();

    //             // if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

    //             //     $profile_visits = new ProfileVisits();
    //             //     $profile_visits->trader_id = $jobQuote->trader_id;
    //             //     $profile_visits->user_type = Auth::guard('web')->user()->user_type;
    //             //     $profile_visits->user_id = Auth::guard('web')->user()->user_id;
    //             //     $profile_visits->contacted = 1;
    //             //     $profile_visits->save();
    //             // }

    //             return redirect()->back()->with('success','Seek Quote for job success!');

    //         } else { 

    //             return redirect()->back()->with('danger','You have already sent quote request for this job.!');

    //         }

    //     } else {

    //         return view('web-ui.errors.404');

    //     }

    // }

    public function traderjobsbystatus($job_status) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            // $categories = Categories::where(['parent_category' => 0, 'status' => 1])->get();

            $user_id = Auth::guard('web')->user()->user_id;

            $provider = Providers::where(['id' => $user_id,'status' => 1])->first();

            if($job_status == "completed") {

                $title = 'Completed Jobs';

                // $jobs = Jobs::with('jobimages')->where(['status' => 1,'job_status' => 'Completed'])->get();
                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $user_id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->orderBy('jobs.id','desc')->get();

                return view('web-ui.trader.jobs',compact('jobs','title','job_status','provider'));

            } elseif($job_status == "accepted") {

                $title = 'Accepted Jobs';

                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $user_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->groupBy('jobs.id')->orderBy('jobs.id','desc')->get();

                return view('web-ui.trader.jobs',compact('jobs','title'));

            } elseif($job_status == "rejected") {

                $title = 'Rejected Jobs';

                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $user_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->orderBy('jobs.id','desc')->get();

                return view('web-ui.trader.jobs',compact('jobs','title'));

            } elseif($job_status == "ongoing") {

                $title = 'Ongoing Jobs';

                $jobs = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $user_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->orderBy('jobs.id','desc')->get();

                return view('web-ui.trader.jobs',compact('jobs','title'));

            } else {

                return view('web-ui.errors.404');

            }

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function traderjobsquoterequests() {


        if(Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $jobs = Jobs::select('jobs.*','job_quotes.id as job_quote_id','job_quotes.seek_quote','job_quotes.give_quote')->leftjoin('job_quotes','jobs.id','=','job_quotes.job_id')->where(['jobs.status' => 1,'job_quotes.trader_id' => $trader_id,'job_quotes.status' => 'Requested'])->whereIn('jobs.job_status', ['Seek Quote','Published'])->orderBy('job_quotes.id', 'desc')->get();

            return view('web-ui.trader.jobs-quote-requests',compact('jobs'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function addjobrequestdetails(Request $request) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $request->validate([
                'request_details' => 'required',
            ]);
            DB::beginTransaction();

            try{

                $job = Jobs::where(["id" => $request->job_id])->first();

                $job_quote_details = JobQuotes::where(["job_id" => $request->job_id,"trader_id" => Auth::guard('web')->user()->user_id,"customer_id" => $job->user_id])->first();

                if($job_quote_details == "") {
                    $jobQuote = new JobQuotes();
                    $jobQuote->job_id = $request->job_id;
                    $jobQuote->trader_id = Auth::guard('web')->user()->user_id;
                    $jobQuote->customer_id = $job->user_id;
                    $jobQuote->status = "Requested";
                    $jobQuote->save();
                }

                $job_quote_details = new JobQuoteDetails();
                $job_quote_details->job_id = $request->job_id;
                $job_quote_details->job_quote_id = ($request->job_quote_id != 0)?$request->job_quote_id:$jobQuote->id;
                $job_quote_details->job_quote_details_id = $request->job_quote_details_id;
                $job_quote_details->user_type = $request->user_type;
                $job_quote_details->user_id = $request->user_id;
                $job_quote_details->details = $request->request_details;
                $job_quote_details->save();

                $notifications = new Notifications();
                $notifications->user_type = "customer";
                $notifications->user_id = $job->user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "requested more details for the job.";
                $notifications->reference_url = route('clarification-requests');
                $notifications->status = 0;
                $notifications->save();

                DB::commit();

                return redirect()->back()->with('success','Requested more details for the job.!');

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger','Something went wrong.Please try again.');
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function updatejobrequestdetails(Request $request) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $request->validate([
                'message' => 'required',
            ]);
            DB::beginTransaction();

            try{

                $user_id = Auth::guard('web')->user()->user_id;

                $jobquoteDetails = JobQuotes::where(['id' => $request->job_quote_id])->first();

                if($jobquoteDetails != "") {

                    $jobquoteDetails->detail_req_details_reply = $request->message;
                    $jobquoteDetails->save();

                    $notifications = new Notifications();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $jobquoteDetails->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "added more details for the job.";
                    $notifications->reference_url = route('traderjobsquoterequests');
                    $notifications->status = 0;
                    $notifications->save();

                    DB::commit();

                    // return redirect()->route('clarification-requests');
                } else {

                    // return redirect()->route('clarification-requests');

                }

            } catch(Exception $e) {
                DB::rollback();
                // return redirect()->route('clarification-requests');
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function changejobquotestatus($jobId,$quote_status) { 

        if(Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $data = JobQuotes::where(['job_id' => $jobId,'trader_id' => $trader_id])->firstOrFail();

            if($data != "") {

                if($quote_status == "accept") {                

                    $data->status = "Accepted";
                    $data->save();

                    $notifications = new Notifications();
                    $notifications->user_type = "customer";
                    $notifications->user_id = $data->customer_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "accepted your job quote request.";
                    $notifications->reference_url = route('jobsbystatus','seekquote');
                    $notifications->status = 0;
                    $notifications->save();

                    return redirect()->back()->with('success','Job Quote accepted successfully.');

                } elseif($quote_status == "reject") {

                    $data->status = "Rejected";
                    $data->save();

                    $notifications = new Notifications();
                    $notifications->user_type = "customer";
                    $notifications->user_id = $data->customer_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "rejected your job quote request.";
                    $notifications->reference_url = route('jobsbystatus','seekquote');
                    $notifications->status = 0;
                    $notifications->save();

                    return redirect()->back()->with('danger','Job Quote rejected successfully.');;

                } else {

                    return view('web-ui.errors.404');

                }

            } else {

                return view('web-ui.errors.404');

            }

            // return redirect()->back()->with('success','Job Quote status updated successfully.');;

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function customerchangeappointmentstatus(Request $request) {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $request->validate([
                'remarks' => 'required',
            ]);
            DB::beginTransaction();

            try{
                $appDetails = Appointments::where(['id' => $request->appointment_id])->first();

                if($appDetails != "") {

                    if($request->status == "Rescheduled") {

                        $appDetails->appointment_date = date('Y-m-d',strtotime($request->appointment_date));
                        $appDetails->appointment_time = date('H:i:s',strtotime($request->appointment_time));
                        $appDetails->status = "Rescheduled";
                        $appDetails->remarks = $request->remarks;
                        $appDetails->save();

                        $notifications = new Notifications();
                        $notifications->user_type = "trader";
                        $notifications->user_id = $appDetails->trader_id;
                        $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                        $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                        $notifications->notification = "rescheduled the appointment.";
                        $notifications->reference_url = route('trader-appointments');
                        $notifications->status = 0;
                        $notifications->save();

                    } elseif($request->status == "Cancelled") {
                        $appDetails->status = "Cancelled";
                        $appDetails->remarks = $request->remarks;
                        $appDetails->save();

                        $notifications = new Notifications();
                        $notifications->user_type = "trader";
                        $notifications->user_id = $appDetails->trader_id;
                        $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                        $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                        $notifications->notification = "cancelled the appointment.";
                        $notifications->reference_url = route('trader-appointments');
                        $notifications->status = 0;
                        $notifications->save();
                    }

                    $traderDetails = Providers::where(['id' => $appDetails->trader_id,'status' => 1])->first();

                    $email = $traderDetails->email;

                    $customerName = Auth::guard('web')->user()->name;

                    $changeappointment = [
                        'title' => 'Appointment Status Changed',
                        'customer' => $customerName,
                        'trader' => $traderDetails->name,
                        'status' => $appDetails->status,
                        'remarks' => $appDetails->remarks,
                        'appointment_date' => date('d-m-Y',strtotime($appDetails->appointment_date)),
                        'appointment_time'  => date('h:i A',strtotime($appDetails->appointment_time))
                    ];
              
                    Mail::to($email)->send(new ChangeappointmentMail($changeappointment));

                    DB::commit();

                    return redirect()->route('customer-appointments')->with('success','Appointment updated successfully.');;
                } else {

                    return redirect()->route('customer-appointments')->with('danger','Something went wrong. Please try again later.');

                }

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('customer-appointments')->with('danger','Something went wrong. Please try again later.');
            }
        }

    }

    public function traderchangeappointmentstatus(Request $request) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $request->validate([
                'remarks' => 'required',
            ]);
            DB::beginTransaction();

            try{
                $appDetails = Appointments::where(['id' => $request->appointment_id])->first();

                if($appDetails != "") {

                    if($request->status == "Accepted") {

                        $appDetails->status = "Accepted";
                        $appDetails->remarks = $request->remarks;
                        $appDetails->save();

                    } elseif($request->status == "Rejected") {

                        $appDetails->status = "Rejected";
                        $appDetails->remarks = $request->remarks;
                        $appDetails->save();

                    } elseif($request->status == "Cancelled") {

                        $appDetails->status = "Cancelled";
                        $appDetails->remarks = $request->remarks;
                        $appDetails->save();
                    }

                    $notifications = new Notifications();
                    $notifications->user_type = "customer";
                    $notifications->user_id = $appDetails->user_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = lcfirst($appDetails->status)." the appointment.";
                    $notifications->reference_url = route('customer-appointments');
                    $notifications->status = 0;
                    $notifications->save();

                    $customerDetails = Customers::where(['id' => $appDetails->user_id,'status' => 1])->first();

                    $email = $customerDetails->email;

                    $traderName = Auth::guard('web')->user()->name;

                    $changeappointment = [
                        'title' => 'Appointment Status Changed',
                        'customer' => $customerDetails->name,
                        'trader' => $traderName,
                        'status' => $appDetails->status,
                        'remarks' => $appDetails->remarks
                    ];
              
                    Mail::to($email)->send(new ChangeappointmenttraderMail($changeappointment));

                    DB::commit();

                    return redirect()->route('trader-appointments')->with('success','Appointment updated successfully.');
                } else {

                    return redirect()->route('trader-appointments')->with('danger','Something went wrong. Please try again later.');

                }

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->route('trader-appointments')->with('danger','Something went wrong. Please try again later.');
            }
        }

    }

    public function edittraderpost($postId) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $traderPost = TraderPosts::with('traderpostimages')->where(['id' => $postId,'status' => 1])->first();      

            if($traderPost != "") {

                return view('web-ui.trader.edit-trader-post',compact('traderPost'));

            } else {

                return "0";

            }
            
        }

    }

    public function traderupdatetraderpost(Request $request, $id)
    {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $traderpost = TraderPosts::where('id',$id)->firstOrFail();

            $request->validate([
                'post_title' => 'required',
                'post_content' => 'required',
            ]);

            DB::beginTransaction();

            try{
                $traderpost->title = $request->post_title;
                $traderpost->post_content = $request->post_content;
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

                return redirect()->back()->with('success','Post updated successfully.');;

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger','Something went wrong. Please try again later.!');;
            }

        } else {

            return view('web-ui.errors.404');
        }
        
    }

    public function edittraderoffer($offerId) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $traderOffer = TraderOffers::with('traderofferimages')->where(['id' => $offerId,'status' => 1])->first();      

            if($traderOffer != "") {

                return view('web-ui.trader.edit-trader-offer',compact('traderOffer'));

            } else {

                return "0";

            }
            
        } else {

                return view('web-ui.errors.404');

            }

    }

    public function traderupdatetraderoffer(Request $request, $id)
    {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $traderoffer = TraderOffers::where('id',$id)->firstOrFail();

            $request->validate([
                'product_title' => 'required',
                'description' => 'required',
                'full_price' => 'required',
                'discount_price' => 'required',
                'valid_from_date' => 'required',
                'valid_from_time' => 'required',
                'valid_to_date' => 'required',
                'valid_to_time' => 'required',
            ]);

            DB::beginTransaction();

            try{

                $traderoffer->title = $request->product_title;
                $traderoffer->description = $request->description;
                $traderoffer->full_price = $request->full_price;
                $traderoffer->discount_price = $request->discount_price;
                $traderoffer->valid_from = date('d-m-Y',strtotime($request->valid_from_date)).' '.date('h:i A',strtotime($request->valid_from_time));
                $traderoffer->valid_to = date('d-m-Y',strtotime($request->valid_to_date)).' '.date('h:i A',strtotime($request->valid_to_time));
                $traderoffer->save();

                if($traderoffer->id != "") {

                    if(isset($request->removeofferImg)) {
                        foreach ($request->removeofferImg as $key => $img) {
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

                return redirect()->back()->with('success','Offer updated successfully.');;

            } catch(Exception $e) {
                DB::rollback();
                return redirect()->back()->with('danger','Something went wrong. Please try again later.!');;
            }

        } else {

            return view('web-ui.errors.404');
        }
        
    }

    public function gettraderbazaarproducts() {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $products = Bazaar::with('bazaarimages')->where(['status' => 1,'added_usertype' => 'provider','added_by' => $trader_id])->orderBy('id','desc')->get();

            return view('web-ui.trader.bazaar',compact('categories','products'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function getcustomerbazaarproducts() {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $products = Bazaar::with('bazaarimages')->where(['status' => 1,'added_usertype' => 'customer','added_by' => $trader_id])->orderBy('id','desc')->get();

            return view('web-ui.customer.bazaar',compact('categories','products'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function updatebazaarproduct(Request $request, $id)
    {

        $product = Bazaar::where('id',$id)->firstOrFail();

        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product' => 'required',
            'price' => 'required',
            'description' => 'required',
            'product_location' => 'required'
        ]);

        DB::beginTransaction();

        try{

            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->product = $request->product;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->product_location = $request->product_location;
            $product->latitude = $request->loc_latitude;
            $product->longitude = $request->loc_longitude;
            $product->save();

            if($product->id != "") {

                if(isset($request->removeImg)) {
                    foreach ($request->removeImg as $key => $img) {
                        $removeimage = BazaarImages::where('id',$img)->firstOrFail();
                        unlink(public_path('uploads/bazaar/products/'.$removeimage->product_image));
                        $removeimage->delete();
                    }
                }

                if(isset($request->product_images)) {
                    $request->validate([
                        'product_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->product_images as $key => $images) {
                        if($images != "") {
                            $bazaarimage = new BazaarImages();
                            $bazaarimage->bazaar_id = $product->id;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/bazaar/products'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(350, 240, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/bazaar/products') . '/' . $workFile);

                            $bazaarimage->product_image = $workFile;
                            $bazaarimage->save();
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success','Product updated successfully.');;

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger','Something went wrong.Please try again later.');;
        }
        
    }

    public function clarificationrequests() {

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $customer_id,'status' => 1])->first();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $clarification_requests = JobQuoteDetails::groupBy('job_id')->orderBy('id', 'desc')->get();

            $user_id = Auth::guard('web')->user()->user_id;

            $title = 'Draft Jobs';

            $job_status = "";

            $jobs = Jobs::with('jobimages')->where(['status' => 1,'user_id' => $user_id,'job_status' => 'Saved'])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            return view('web-ui.customer.clarification-requests',compact('clarification_requests', 'categories', 'customer', 'job_count','following','favorites'));
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function viewclarificationrequest($quoteId) { 

        if(Auth::guard('web')->user()->user_type == "customer") { 

            $jobQuote = JobQuotes::where(['id' => $quoteId])->first();

            if($jobQuote != "") {

                return $jobQuote;

            } else {

                return "0";

            }
            
        } else {

                return view('web-ui.errors.404');

            }

    }

    public function getreceipts()
    { 
        $user_type = Auth::guard('web')->user()->user_type;

        $user_id = Auth::guard('web')->user()->user_id;

        if(Auth::guard('web')->user()->user_type == "customer") {

            $customer = Customers::where(['id' => $user_id,'status' => 1])->first();

            $receipts = Receipts::where(['user_type' => $user_type,'user_id' => $user_id])->orderBy('id','desc')->get();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $user_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $user_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $user_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $user_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $user_id])->count();

            return view('web-ui.customer.receipts',compact('customer','receipts','categories','job_count','following','favorites'));

        } elseif (Auth::guard('web')->user()->user_type == "provider") {

            $provider = Providers::where(['id' => $user_id,'status' => 1])->first();

            $receipts = Receipts::where(['user_type' => $user_type,'user_id' => $user_id])->orderBy('id','desc')->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $user_id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();
            
            return view('web-ui.trader.receipts',compact('receipts','provider','job_quote_count','job_count'));
        }
    
    }

    public function storereceipt(Request $request) {

        $request->validate([
            'title' => 'required',
            'receipt_image' => 'image|mimes:jpg,jpeg,png|max:4096',
        ]);

        DB::beginTransaction();

        try{
            $receipt = new Receipts();
            $receipt->user_type = $request->user_type;
            $receipt->user_id = $request->user_id;
            $receipt->title = $request->title;
            $receipt->remarks = isset($request->remarks)?$request->remarks:"";
            $receipt->status = 1;

            if($request->receipt_image != "") {
                $image = $request->receipt_image;
                $workFile = time().'_'.$image->getClientOriginalName(); 
                // $image->move(public_path('uploads/receipts'), $workFile);

                $img = Image::make($image->path());

                $img->resize(500, 400, function ($const) {
                    $const->aspectRatio();
                })->save(public_path('uploads/receipts') . '/' . $workFile);

                $receipt->receipt_image = $workFile;
            }
            $receipt->save();

            DB::commit();

            if(Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.receipts.index')->with('success','Receipt added successfully.');

            } elseif (Auth::guard('web')->user()->user_type == "provider") {

                return redirect()->route('trader.receipts.index')->with('success','Receipt added successfully.');        
                
            }

        } catch(Exception $e) {
            DB::rollback();

            if(Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.receipts.index')->with('danger','Something went wrong. Please try again.!');

            } elseif (Auth::guard('web')->user()->user_type == "provider") {
        
                return redirect()->route('trader.receipts.index')->with('danger','Something went wrong. Please try again.!');   
                
            }
        }

    }

    public function destroyreceipt($id) { 

        $receipt = Receipts::where('id',$id)->firstOrFail();
    
        if($receipt != "") {
            unlink(public_path('uploads/receipts/'.$receipt->receipt_image));
            
            $receipt->delete();

            if(Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.receipts.index')->with('danger','Receipt deleted.');

            } elseif (Auth::guard('web')->user()->user_type == "provider") {
        
                return redirect()->route('trader.receipts.index')->with('danger','Receipt deleted.');  
            }
        } else {

            return view('web-ui.errors.404');

        }

    }

    public function storemessage(Request $request) {

        // $request->validate([
        //     'message' => 'required',
        // ]);

        DB::beginTransaction();

        try{

            if(Messages::where(["from_user_type" => $request->from_user_type,"from_user_id" => $request->from_user_id,"to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id,"is_trader" => 1,"trader_id" => $request->to_user_id])->count() == 0) {
                $message = new Messages();
                $message->from_user_type = $request->from_user_type;
                $message->from_user_id = $request->from_user_id;
                $message->to_user_type = $request->to_user_type;
                $message->to_user_id = $request->to_user_id;
                $provider = Providers::where(["id"=>$request->to_user_id])->first();
                $message->message = $provider->name;
                $message->status = 0;
                $message->is_trader = 1;
                $message->trader_id = $request->to_user_id;
                $message->save();   

                DB::commit();
            }                     

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

                return redirect()->route('trader.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            }

        } catch(Exception $e) {
            DB::rollback();

            $provider = Providers::where(["id" => $request->product_id])->first();

            return redirect()->route('traderdetails',$provider->username)->with('danger','Something went wrong.Please try again later.'); 
        }

    }

    public function storemessagefromseekquote(Request $request) {

        // $request->validate([
        //     'message' => 'required',
        // ]);

        DB::beginTransaction();

        try{
            if(Messages::where(["from_user_type" => $request->from_user_type,"from_user_id" => $request->from_user_id,"to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id,"is_job" => 1,"job_id" => $request->job_id])->count() == 0) {
                $message = new Messages();
                $message->from_user_type = $request->from_user_type;
                $message->from_user_id = $request->from_user_id;
                $message->to_user_type = $request->to_user_type;
                $message->to_user_id = $request->to_user_id;
                $job = Jobs::where(["id"=>$request->job_id])->first();
                $message->message = $job->title;
                $message->status = 0;
                $message->is_job = 1;
                $message->job_id = $request->job_id;
                $message->save();    

                DB::commit();   
            }     

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

                return redirect()->route('trader.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            }

        } catch(Exception $e) {
            DB::rollback();

            return redirect()->back()->with('danger','Something went wrong.Please try again later.'); 
        }

    }

    public function storemessagetraderlist(Request $request) {

        // $request->validate([
        //     'message' => 'required',
        // ]);

        DB::beginTransaction();

        try{
            if(Messages::where(["from_user_type" => $request->from_user_type,"from_user_id" => $request->from_user_id,"to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id,"is_trader" => 1,"trader_id" => $request->trader_id])->count() == 0) {
                $message = new Messages();
                $message->from_user_type = $request->from_user_type;
                $message->from_user_id = $request->from_user_id;
                $message->to_user_type = $request->to_user_type;
                $message->to_user_id = $request->to_user_id;
                $provider = Providers::where(["id"=>$request->to_user_id])->first();
                $message->message = $provider->name;
                $message->status = 0;
                $message->is_trader = 1;
                $message->trader_id = $request->trader_id;
                $message->save();    

                DB::commit();
            }  

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

                return redirect()->route('trader.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            }

        } catch(Exception $e) {
            DB::rollback();

            return redirect()->back()->with('danger','Something went wrong.Please try again later.'); 
        }

    }

    public function storemessagereply(Request $request) {

        DB::beginTransaction();

        try{
            $message = new Messages();
            $message->from_user_type = $request->from_user_type;
            $message->from_user_id = $request->from_user_id;
            $message->to_user_type = $request->to_user_type;
            $message->to_user_id = $request->to_user_id;
            $message->message = isset($request->message)?$request->message:"";
            $message->status = 0;
            $message->save();    

            DB::commit();        

            return $message->message;

        } catch(Exception $e) {
            DB::rollback();
        }

    }

    public function bazaarstoremessage(Request $request) { 

        // $request->validate([
        //     'message' => 'required',
        // ]);

        DB::beginTransaction();

        try{
            if(Messages::where(["from_user_type" => $request->from_user_type,"from_user_id" => $request->from_user_id,"to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id,"is_bazaar" => 1,"product_id" => $request->product_id])->count() == 0) {
                $message = new Messages();
                $message->from_user_type = $request->from_user_type;
                $message->from_user_id = $request->from_user_id;
                $message->to_user_type = $request->to_user_type;
                $message->to_user_id = $request->to_user_id;
                $bazaar = Bazaar::where(["id"=>$request->product_id])->first();
                $message->message = $bazaar->product;
                $message->status = 0;
                $message->is_bazaar = 1;
                $message->product_id = $request->product_id;
                $message->save();

                DB::commit();
            }

            if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

                return redirect()->route('trader.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            } elseif(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

                return redirect()->route('customer.messages.index')->with(["to_user_type" => $request->to_user_type,"to_user_id" => $request->to_user_id]); 
                
            }

        } catch(Exception $e) {
            DB::rollback();

            return redirect()->route('product-details',$request->product_id)->with('danger','Something went wrong.Please try again later.'); 
        }

    }

    public function getmessages()
    { 
        $user_type = Auth::guard('web')->user()->user_type;

        $user_id = Auth::guard('web')->user()->user_id;



        if(Auth::guard('web')->user()->user_type == "customer") {

            $from_messages = Messages::where(['from_user_type' => 'customer'])->where(['from_user_id' => $user_id])->groupBy('to_user_type','to_user_id')->orderBy('id','desc')->get();

            $to_messages = Messages::where(['to_user_type' => 'customer'])->where(['to_user_id' => $user_id])->groupBy('from_user_type','from_user_id')->orderBy('id','desc')->get();

            $messages = [];
            $messages1 = [];

            foreach($from_messages as $key => $from) {
                $messages[$key]['user_type'] = $from->to_user_type;
                $messages[$key]['user_id'] = $from->to_user_id;
                // $messages[$key]['message'] = $from->message;
            }

            foreach($to_messages as $k => $to) {
                $messages1[$k]['user_type'] = $to->from_user_type;
                $messages1[$k]['user_id'] = $to->from_user_id;
                // $messages1[$k]['message'] = $to->message;
            }

            $msg = array_unique(array_merge_recursive($messages,$messages1), SORT_REGULAR);

            return view('web-ui.customer.messages',compact('msg'));

        } elseif (Auth::guard('web')->user()->user_type == "provider") {

            $from_messages = Messages::where(['from_user_type' => 'trader'])->where(['from_user_id' => $user_id])->groupBy('to_user_type','to_user_id')->orderBy('id','desc')->get();

            $to_messages = Messages::where(['to_user_type' => 'trader'])->where(['to_user_id' => $user_id])->groupBy('from_user_type','from_user_id')->orderBy('id','desc')->get();

            $messages = [];
            $messages1 = [];

            foreach($from_messages as $key => $from) {
                $messages[$key]['user_type'] = $from->to_user_type;
                $messages[$key]['user_id'] = $from->to_user_id;
                // $messages[$key]['message'] = $from->message;
            }

            foreach($to_messages as $k => $to) {
                $messages1[$k]['user_type'] = $to->from_user_type;
                $messages1[$k]['user_id'] = $to->from_user_id;
                // $messages1[$k]['message'] = $to->message;
            }

            $msg = array_unique(array_merge_recursive($messages,$messages1), SORT_REGULAR);
            
            return view('web-ui.trader.messages',compact('msg'));
        }
    
    }

    public function getmessagesbytype(Request $request)
    { 
        $user_type = Auth::guard('web')->user()->user_type;

        if($user_type == "provider") {
            $user_type = "trader";
        }

        $user_id = Auth::guard('web')->user()->user_id;

        $messages = Messages::where([['from_user_type', '=', $request->user_type],['from_user_id', '=', $request->user_id],['to_user_type', '=', $user_type],['to_user_id', '=', $user_id]])->orWhere([['to_user_type', '=', $request->user_type],['to_user_id', '=', $request->user_id],['from_user_type', '=', $user_type],['from_user_id', '=', $user_id]])->orderBy('id','asc')->get(); 

        if(Auth::guard('web')->user()->user_type == "customer") {         

            if($request->user_type == "trader") {

                $user = Providers::where(['id' => $request->user_id,'status' => 1])->first();
                $req_user_type = "providers";
                // $req_user_id = $request->user_id;

            } else if($request->user_type == "customer") {

                $user = Customers::where(['id' => $request->user_id,'status' => 1])->first();
                $req_user_type = "customers";
                // $req_user_id = $request->user_id;

            } 
            return view('web-ui.customer.messageslist',compact('messages','user','req_user_type','request'));

        } elseif (Auth::guard('web')->user()->user_type == "provider") {   

            if($request->user_type == "trader") {

                $user = Providers::where(['id' => $request->user_id,'status' => 1])->first();
                $req_user_type = "providers";
                // $req_user_id = $request->user_id;

            } else if($request->user_type == "customer") {

                $user = Customers::where(['id' => $request->user_id,'status' => 1])->first();
                $req_user_type = "customers";
                // $req_user_id = $request->user_id;

            } 
            return view('web-ui.trader.messageslist',compact('messages','user','req_user_type','request'));
        }
    
    }

    public function getmessagesbyid($message_id)
    { 
        $user_type = Auth::guard('web')->user()->user_type;

        $message = Messages::where(['id' => $message_id])->first();   

        $message->status = 1;
        $message->save();   

        if(Auth::guard('web')->user()->user_type == "customer") {  

            return view('web-ui.customer.view-message',compact('message'));

        } elseif (Auth::guard('web')->user()->user_type == "provider") {       

            return view('web-ui.trader.view-message',compact('message'));
        }
    
    }

    public function addfollow(Request $request) {

        if(Auth::guard('web')->check()) {  

            $user_type = Auth::guard('web')->user()->user_type;

            $user_id = Auth::guard('web')->user()->user_id;

            $follow = Follows::where(["trader_id" => $request->trader_id,"user_type" => $user_type,"user_id" => $user_id])->first();

            if($follow == "") {

                $follow_trader = new Follows();
                $follow_trader->trader_id = $request->trader_id;
                $follow_trader->user_type = $user_type;
                $follow_trader->user_id = $user_id;
                $follow_trader->follow = 1;
                $follow_trader->save();

                if(Auth::guard('web')->check()) {

                    $profile_visits = new ProfileVisits();
                    $profile_visits->trader_id = $follow_trader->trader_id;
                    $profile_visits->user_type = $user_type;
                    $profile_visits->user_id = $user_id;
                    $profile_visits->contacted = 1;
                    $profile_visits->save();

                    $notifications = new Notifications();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $follow_trader->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "started following you.";
                    $notifications->reference_url = route('traderdetails',$follow_trader->gettrader->username);
                    $notifications->status = 0;
                    $notifications->save();
                }

                return Follows::where(["trader_id" => $request->trader_id])->count();

            } else {

                return FALSE;
            }

        } else {

            return view('web-ui.errors.404');

        }

    }

    public function addfavourite(Request $request) {

        if(Auth::guard('web')->check()) {  

            $user_type = Auth::guard('web')->user()->user_type;

            $user_id = Auth::guard('web')->user()->user_id;

            $favorite = Favourites::where(["trader_id" => $request->trader_id,"user_type" => $user_type,"user_id" => $user_id])->first();

            if($favorite == "") {

                $favorite_trader = new Favourites();
                $favorite_trader->trader_id = $request->trader_id;
                $favorite_trader->user_type = $user_type;
                $favorite_trader->user_id = $user_id;
                $favorite_trader->favourite = 1;
                $favorite_trader->save();

                if(Auth::guard('web')->check()) {

                    $profile_visits = new ProfileVisits();
                    $profile_visits->trader_id = $favorite_trader->trader_id;
                    $profile_visits->user_type = $user_type;
                    $profile_visits->user_id = $user_id;
                    $profile_visits->contacted = 1;
                    $profile_visits->save();

                    $notifications = new Notifications();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $favorite_trader->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "made you favourite.";
                    $notifications->reference_url = route('traderdetails',$favorite_trader->gettrader->username);
                    $notifications->status = 0;
                    $notifications->save();
                }

                return Favourites::where(["trader_id" => $request->trader_id])->count();

            } else {

                return FALSE;
            }

        } else {

            return view('web-ui.errors.404');

        }

    }

    public function profileinsights()
    { 
        if(Auth::guard('web')->user()->user_type == "provider") {

            $id = Auth::guard('web')->user()->user_id;

            $provider = Providers::with('providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers','providerfollows','providerfavourites')->where(['id' => $id,'status' => 1])->firstOrFail();

            $search_history = SearchHistory::where(['trader_id' => $id])->count();

            $profile_visits = ProfileVisits::where(['trader_id' => $id,'contacted' => 0])->count();

            $contacted = ProfileVisits::where(['trader_id' => $id,'contacted' => 1])->count();

            $job_quote_count = JobQuotes::where(['trader_id' => $id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();
            
            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.profile-insights',compact('provider','search_history','profile_visits','contacted','job_quote_count','job_count'));

        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function profilevisits()
    { 
        if(Auth::guard('web')->user()->user_type == "provider") {

            $id = Auth::guard('web')->user()->user_id;

            $provider = Providers::with('providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers','providerfollows','providerfavourites')->where(['id' => $id,'status' => 1])->firstOrFail();

            $profile_visits = ProfileVisits::where(['trader_id' => $id,'contacted' => 0])->orderBy('id','DESC')->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();
            
            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.profile-visits',compact('provider','profile_visits','job_quote_count','job_count'));

        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function customerscontacted()
    { 
        if(Auth::guard('web')->user()->user_type == "provider") {

            $id = Auth::guard('web')->user()->user_id;

            $provider = Providers::with('providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers','providerfollows','providerfavourites')->where(['id' => $id,'status' => 1])->firstOrFail();

            $customerscontacted = ProfileVisits::where(['trader_id' => $id,'contacted' => 1])->orderBy('id','DESC')->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();
            
            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.customers-contacted',compact('provider','customerscontacted','job_quote_count','job_count'));

        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function searchhistory()
    { 
        if(Auth::guard('web')->user()->user_type == "provider") {

            $id = Auth::guard('web')->user()->user_id;

            $provider = Providers::with('providerservices','providerworks','providercategories','providerreviews','providerposts','provideroffers','providerfollows','providerfavourites')->where(['id' => $id,'status' => 1])->firstOrFail();

            $searchhistory = SearchHistory::where(['trader_id' => $id])->orderBy('id','DESC')->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();            
            
            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.search-history',compact('provider','searchhistory','job_quote_count','job_count'));

        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function diyhelp()
    {

        $diyhelp = DiyHelp::with('diyhelpcomments')->where(['status' => 1])->orderBy('id','DESC')->get();

        return view('web-ui.diy-help.diy-help',compact('diyhelp'));
    }

    public function adddiyhelp(Request $request) {

        if(Auth::guard('web')->check()) {

            $request->validate([
                'title' => 'required',
                'diy_help' => 'required',
            ]);

            DB::beginTransaction();

            try{
                $diyhelp = new DiyHelp();
                $diyhelp->user_type = (Auth::guard('web')->user()->user_type == "provider")?"trader":"customer";
                $diyhelp->user_id = Auth::guard('web')->user()->user_id;
                $diyhelp->title = $request->title;
                $diyhelp->comment = $request->diy_help;
                $diyhelp->status = 1;
                $diyhelp->save();

                if(isset($request->diy_help_images)) {
                    $request->validate([
                        'diy_help_images[]' => 'image|mimes:jpg,jpeg,png|max:2048',
                    ]);
                    foreach ($request->diy_help_images as $key => $images) {
                        if($images != "") {
                            $diy_help_image = new DiyHelpImages();
                            $diy_help_image->diy_help_id = $diyhelp->id;
                            $workFile = time().'_'.$images->getClientOriginalName(); 
                            // $images->move(public_path('uploads/diy-help'), $workFile);

                            $img = Image::make($images->path());

                            $img->resize(500, 400, function ($const) {
                                $const->aspectRatio();
                            })->save(public_path('uploads/diy-help') . '/' . $workFile);

                            $diy_help_image->diy_help_image = $workFile;
                            $diy_help_image->save();
                        }
                    }
                }

                DB::commit();

                return redirect()->route('diy-help')->with('success','Diy- Help has been successfully added.!');

            } catch(Exception $e) {
                DB::rollback();

                return redirect()->route('diy-help')->with('danger','Something went wrong.Please try again later.!');
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function adddiyhelpcomment(Request $request) {

        if(Auth::guard('web')->check()) {

            $request->validate([
                'diy_help_comment' => 'required',
            ]);

            DB::beginTransaction();

            try{
                $diyhelpcomment = new DiyHelpComments();
                $diyhelpcomment->diy_help_comment_id = $request->diy_help_comment_id;
                $diyhelpcomment->user_type = (Auth::guard('web')->user()->user_type == "provider")?"trader":"customer";
                $diyhelpcomment->user_id = Auth::guard('web')->user()->user_id;
                $diyhelpcomment->diy_help_id = $request->diy_help_id;
                $diyhelpcomment->comment = $request->diy_help_comment;
                $diyhelpcomment->status = 1;
                $diyhelpcomment->save();

                $notifications = new Notifications();
                $diyhelp = DiyHelp::where(["status" => 1, "id" => $diyhelpcomment->diy_help_id])->first();
                $notifications->user_type = $diyhelp->user_type;
                $notifications->user_id = $diyhelp->user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "commented on your post.";
                $notifications->reference_url = route('diy-help');
                $notifications->status = 0;
                $notifications->save();

                DB::commit();

                $commentsCount = $request->allcomments;

                return view('web-ui.diy-help.diyhelp-comments',compact('diyhelpcomment','commentsCount'));

            } catch(Exception $e) {
                DB::rollback();
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function adddiyhelpcommentreply(Request $request) {

        if(Auth::guard('web')->check()) {

            $request->validate([
                'diy_help_comment' => 'required',
            ]);

            DB::beginTransaction();

            try{
                $diyhelpcomment = new DiyHelpComments();
                $diyhelpcomment->diy_help_comment_id = $request->diy_help_comment_id;
                $diyhelpcomment->user_type = (Auth::guard('web')->user()->user_type == "provider")?"trader":"customer";
                $diyhelpcomment->user_id = Auth::guard('web')->user()->user_id;
                $diyhelpcomment->diy_help_id = $request->diy_help_id;
                $diyhelpcomment->comment = $request->diy_help_comment;
                $diyhelpcomment->status = 1;
                $diyhelpcomment->save();

                $notifications = new Notifications();
                $diyhelp = DiyHelp::where(["status" => 1, "id" => $diyhelpcomment->diy_help_id])->first();
                $notifications->user_type = $diyhelp->user_type;
                $notifications->user_id = $diyhelp->user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "replied to your comment.";
                $notifications->reference_url = route('diy-help');
                $notifications->status = 0;
                $notifications->save();

                DB::commit();

                return view('web-ui.diy-help.diyhelp-comments-reply',compact('diyhelpcomment'));

            } catch(Exception $e) {
                DB::rollback();
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function gettraderfollows($trader_id)
    { 
        if(Auth::guard('web')->user()->user_type == "provider" && Auth::guard('web')->user()->user_id == $trader_id) {

            $follows = Follows::where(['trader_id' => $trader_id])->get(); 

            return view('web-ui.trader.view-followers',compact('follows'));
        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function gettraderfavourites($trader_id)
    { 
        if(Auth::guard('web')->user()->user_type == "provider" && Auth::guard('web')->user()->user_id == $trader_id) {

            $favourites = Favourites::where(['trader_id' => $trader_id])->get(); 

            return view('web-ui.trader.view-favourites',compact('favourites'));
        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function getcustomerfollows($customer_id)
    { 
        if(Auth::guard('web')->user()->user_type == "customer" && Auth::guard('web')->user()->user_id == $customer_id) {

            $follows = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->get(); 

            return view('web-ui.customer.view-followers',compact('follows'));
        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function getcustomerfavourites($customer_id)
    { 
        if(Auth::guard('web')->user()->user_type == "customer" && Auth::guard('web')->user()->user_id == $customer_id) {

            $favourites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->get(); 

            return view('web-ui.customer.view-favourites',compact('favourites'));
        } else {

            return view('web-ui.errors.404');
        }
    
    }

    public function blockuser($user_id) { 

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

            $user_type = Auth::guard('web')->user()->user_type;
            $logged_user_id = Auth::guard('web')->user()->user_id;

            $block = Block::where(['trader_id' => $user_id,'customer_id' => $logged_user_id])->count();

            if($block == 0) {

                $addblock = new Block();
                $addblock->trader_id = $user_id;
                $addblock->customer_id = $logged_user_id;
                $addblock->save();

                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "blocked you.";
                $notifications->reference_url = route('customers-blocked');
                $notifications->status = 0;
                $notifications->save();
            }

            return redirect()->route('traderdetails',$addblock->gettrader->username)->with('danger','You have blocked this trader.!!');

        } else {

            return view('web-ui.errors.404');
        }

    }

    public function unblockuser($user_id) { 

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

            $user_type = Auth::guard('web')->user()->user_type;
            $logged_user_id = Auth::guard('web')->user()->user_id;

            $block = Block::where(['trader_id' => $user_id,'customer_id' => $logged_user_id])->first();

            if($block != "") {

                $block->delete();

                $notifications = new Notifications();
                $notifications->user_type = "trader";
                $notifications->user_id = $user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "unblocked you.";
                $notifications->reference_url = route('traderdetails',$block->gettrader->username);
                $notifications->status = 0;
                $notifications->save();

                return redirect()->route('traderdetails',$block->gettrader->username)->with('success','You have unblocked this trader.!!');

            }

        } else {

            return view('web-ui.errors.404');
        }

    }

    public function getpackages()
    {

        $packages = Packages::where(['status' => 1])->orderBy('price','ASC')->get();

        return view('web-ui.packages.index',compact('packages'));
    }

    public function blockedtraders() {

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

            $customer_id = Auth::guard('web')->user()->user_id;

            $customer = Customers::where(['id' => $customer_id,'status' => 1])->first();

            $categories = BazaarCategory::where(['parent_category' => 0, 'status' => 1])->get();

            $job_count["draft"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Saved'])->count();

            $job_count["published"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Published'])->count();

            $job_count["unpublished"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Unpublished'])->count();

            $job_count["completed"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Completed'])->count();

            $job_count["seekquote"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Seek Quote'])->count();

            $job_count["ongoing"] = Jobs::where(['user_id' => $customer_id,'status' => 1,'job_status' => 'Ongoing'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();
            
            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.user_id' => $customer_id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $following = Follows::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $favorites = Favourites::where(['user_type' => "customer",'user_id' => $customer_id])->count();

            $blocks = Block::where(['customer_id' => $customer_id])->get();

            return view('web-ui.customer.blocked-traders',compact('blocks','customer','categories','job_count','following','favorites'));

        } else {

            return view('web-ui.errors.404');

        }
    }

    public function customersblocked() {

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

            $trader_id = Auth::guard('web')->user()->user_id;

            $provider = Providers::where(['id' => $trader_id,'status' => 1])->first();

            $blocks = Block::where(['trader_id' => $trader_id])->get();

            $job_quote_count = JobQuotes::where(['trader_id' => $trader_id,'status' => 'Requested'])->count();

            $job_count["ongoing"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["accepted"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->count();

            $job_count["rejected"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->count();

            $job_count["completed"] = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['job_quotes.trader_id' => $provider->id,'jobs.status' => 1,'jobs.job_status' => 'Completed','job_quotes.status' => 'Accepted'])->count();

            return view('web-ui.trader.customers-blocked',compact('blocks','provider','job_quote_count','job_count'));
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function removecompletedwork(Request $request) {
        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "provider") {

            if($request->image_id != "") {

                $image = ProviderWorks::where(["id" => $request->image_id,"provider_id" => Auth::guard('web')->user()->user_id])->first();

                if($image != "") {
                    unlink(public_path('uploads/providers/works/'.$image->image));
                    $image->delete();
                }

            }
            return TRUE;
        } else {

            return view('web-ui.errors.404');

        }
        
    }

    public function newsletter(Request $request) {

        $request->validate([
            'email' => 'required|email|unique:newsletter,email',
        ]);

        DB::beginTransaction();

        try{
            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->status = 1;
            $newsletter->save();

            $email = $newsletter->email;

            $register = [
                'title' => 'Newsletter Subscription',
            ];
      
            Mail::to($email)->send(new NewsletterMail($register));

            DB::commit();

            return TRUE;

        } catch(Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

    }

    public function loginwithotp() {

        return view('web-ui.login-with-otp');

    }

    public function generateotp(Request $request) { 

        $request->validate([
            'mobile' => 'required',
        ]);

        $mobile = $request->mobile;

        $user = User::where(['mobile' => $mobile])->first();

        if($user != "") {

            $otp = rand(100000, 999999);
            Session::put('otp', $otp);
            Session::put('mobile', $mobile);
            Session::put('otp_generated_at', now());

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://2factor.in/API/V1/".env('SMS_API')."/SMS/".$mobile."/".$otp,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_POSTFIELDS => "",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            // if ($err) {
            //   echo "cURL Error #:" . $err;
            // } else {
            //   echo $response;
            // }

            return redirect()->route('verify-otp')->with('success','OTP has been sent to your mobile.');

        } else {

            return redirect()->route('login-with-otp')->with('danger','This Mobile number is invalid.!!');

        }
    }

    public function verifyotp() {

        return view('web-ui.verify-otp');

    }

    public function validateotp(Request $request) { 

        $request->validate([
            'otp' => 'required',
        ]);

        $userotp = $request->otp;

        $otp = Session::get('otp');

        $mobile = Session::get('mobile');

        $otp_time = Session::get('otp_generated_at');

        $currentTime = Carbon::now();

        if($currentTime->diffInMinutes($otp_time) < 30) {

            if($userotp == $otp) { 

            $user = User::where(['mobile' => $mobile])->first();

            Auth::guard('web')->login($user);

            $request->session()->forget('otp');

            $request->session()->regenerate();

            if($user->status != 0) { 
                $user->loggedIN = 1;
                $user->save();
            } else {
                
                Auth::guard('web')->logout();
            }

            if(Auth::guard('web')->user()->status == 1 && Auth::guard('web')->user()->user_type == "provider") {
                return redirect()->route('traderdetails',Auth::guard('web')->user()->username);
            } else if(Auth::guard('web')->user()->status == 1 && Auth::guard('web')->user()->user_type == "customer") {
                return redirect()->route('customerhome');
            } else if(Auth::guard('web')->user()->status == 0) {
                return redirect()->route('verify-user');
            }


        } else {

            return redirect()->route('verify-otp')->with('danger','OTP is invalid.!!');

        }

        } else {
            return redirect()->route('verify-otp')->with('danger','OTP expired.!Please try resend OTP.');
        }
    }

    public function resendotp() { 

        $mobile = Session::get('mobile');

        $user = User::where(['mobile' => $mobile])->first();

        if($user != "") {

            $otp = rand(100000, 999999);
            Session::put('otp', $otp);
            Session::put('mobile', $mobile);
            Session::put('otp_generated_at', now());

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://2factor.in/API/V1/".env('SMS_API')."/SMS/".$mobile."/".$otp,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_POSTFIELDS => "",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            return redirect()->route('verify-otp')->with('success','OTP has been sent to your mobile.');

        } else {

            return redirect()->route('login-with-otp')->with('danger','This Mobile number is invalid.!!');

        }
    }

    public function checkusername(Request $request) {

        $request->validate([
            'username' => 'required|unique:users,username',
        ]);

        $username = $request->username;

        if(User::where(['username' => $username])->count() == 0) {
            return "Username is available.!";
        } else {
            return "Username already taken.!";
        }

    }

    public function gettraderpostlikes($postId) {

            $traderPostLikes = TraderPostsLikes::where(['trader_post_id' => $postId])->orderBy('id','DESC')->get();     

            if($traderPostLikes != "") {

                return view('web-ui.trader.post-likes',compact('traderPostLikes'));

            } else {

                return "0";

            }

    }

    public function gettraderofferlikes($offerId) {

            $traderOfferLikes = TraderOfferLikes::where(['trader_offer_id' => $offerId])->orderBy('id','DESC')->get();     

            if($traderOfferLikes != "") {

                return view('web-ui.trader.offer-likes',compact('traderOfferLikes'));

            } else {

                return "0";

            }

    }

    public function gettraderpostcommentreplies(Request $request) {

            $traderpostreplies = TraderPostsComments::where(['status' => 1, 'trader_post_id' => $request->post_id, 'post_comment_id' => $request->post_comment_id])->orderBy('id','ASC')->get();     

            if($traderpostreplies != "") {

                return view('web-ui.trader.post-comments-replies',compact('traderpostreplies'));

            } else {

                return "0";

            }

    }

    public function gettraderoffercommentreplies(Request $request) {

            $traderofferreplies = TraderOffersComments::where(['status' => 1, 'trader_offer_id' => $request->offer_id, 'offer_comment_id' => $request->offer_comment_id])->orderBy('id','ASC')->get();     

            if($traderofferreplies != "") {

                return view('web-ui.trader.offer-comments-replies',compact('traderofferreplies'));

            } else {

                return "0";

            }

    }

    public function gettraderreviewcommentreplies(Request $request) {

            $traderreviewreplies = TraderReviewComments::where(['status' => 1, 'review_id' => $request->review_id, 'review_comment_id' => $request->review_comment_id])->orderBy('id','ASC')->get();     

            if($traderreviewreplies != "") {

                return view('web-ui.trader.review-comments-replies',compact('traderreviewreplies'));

            } else {

                return "0";

            }

    }

    public function viewalltraderpostcomments($postId) {

            $traderPostcomments = TraderPostsComments::where(['trader_post_id' => $postId,'post_comment_id' => 0,'status' => 1])->orderBy('id','DESC')->offset(1)->limit(100)->get();     

            if($traderPostcomments != "") {

                return view('web-ui.trader.view-post-comments',compact('traderPostcomments'));

            } else {

                return "0";

            }

    }

    public function viewalltraderoffercomments($offerId) {

            $traderOffercomments = TraderOffersComments::where(['trader_offer_id' => $offerId,'offer_comment_id' => 0,'status' => 1])->orderBy('id','DESC')->offset(1)->limit(100)->get();     

            if($traderOffercomments != "") {

                return view('web-ui.trader.view-offer-comments',compact('traderOffercomments'));

            } else {

                return "0";

            }

    }

    public function viewalltraderreviewcomments($reviewId) {

            $traderReviewcomments = TraderReviewComments::where(['review_id' => $reviewId,'review_comment_id' => 0,'status' => 1])->orderBy('id','DESC')->offset(1)->limit(100)->get();     

            if($traderReviewcomments != "") {

                return view('web-ui.trader.view-review-comments',compact('traderReviewcomments'));

            } else {

                return "0";

            }

    }

    public function getdiyhelpcommentreplies(Request $request) {

            $diyhelpcommentreplies = DiyHelpComments::where(['status' => 1, 'diy_help_id' => $request->diyhelp_id, 'diy_help_comment_id' => $request->diyhelp_comment_id])->orderBy('id','ASC')->get();     

            if($diyhelpcommentreplies != "") {

                return view('web-ui.diy-help.diy-help-comments-replies',compact('diyhelpcommentreplies'));

            } else {

                return "0";

            }

    }

    public function viewalldiyhelpcomments($diyhelpId) {

            $diyhelpcomments = DiyHelpComments::where(['diy_help_id' => $diyhelpId,'diy_help_comment_id' => 0,'status' => 1])->orderBy('id','DESC')->offset(1)->limit(100)->get();     

            if($diyhelpcomments != "") {

                return view('web-ui.diy-help.view-all-comments',compact('diyhelpcomments'));

            } else {

                return "0";

            }

    }

    public function jobdetails($jobId) {

        $jobdetails = Jobs::where(["id" => $jobId])->first();

        return view('web-ui.jobs.details',compact('jobdetails'));

    }    

    public function traderquotejob(Request $request) {

        if(Auth::guard('web')->user()->user_type == "provider") {

            $job = Jobs::where(['id' => $request->job_id])->first();

            $job_quote = JobQuotes::where(['job_id' => $job->id,'trader_id' => $request->trader_id,'customer_id' => $job->user_id])->first();

            if($job_quote == "") {

                $jobQuote = new JobQuotes();
                $jobQuote->job_id = $request->job_id;
                $jobQuote->trader_id = $request->trader_id;
                $jobQuote->customer_id = $job->user_id;
                $jobQuote->status = "Requested";
                $jobQuote->give_quote = 1;
                $jobQuote->quoted_price = $request->quote_price;
                $jobQuote->quote_reason = $request->quote_reason;
                $jobQuote->save();

                $job->job_status = "Seek Quote";
                $job->quote_provided = 1;
                $job->save();

                $customerDetails = Customers::where(['id' => $job->user_id,'status' => 1])->first();

                $email = $customerDetails->email;

                $traderName = Auth::guard('web')->user()->name;

                $seekquote = [
                    'title' => 'New Job Quote Request Received',
                    'customer' => $traderName,
                    'trader' => $customerDetails->name
                ];
          
                Mail::to($email)->send(new SeekquoteMail($seekquote));

                $notifications = new Notifications();
                $notifications->user_type = "customer";
                $notifications->user_id = $jobQuote->customer_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "provided a quote for your job.";
                $notifications->reference_url = route('job-details',$job->id);
                $notifications->status = 0;
                $notifications->save();

                return redirect()->back()->with('success','You have successfully sent quote request to the job.');

            } elseif ($job_quote->give_quote == 1) {
                
                return redirect()->back()->with('danger','You have already sent seekquote request for this job.!');

            } elseif ($job_quote->give_quote == 0) {

                $job_quote->give_quote = 1;
                $job_quote->quoted_price = $request->quote_price;
                $job_quote->quote_reason = $request->quote_reason;
                $job_quote->save();

                return redirect()->back()->with('success','You have successfully sent quote request to the job.');

            }

        } else {

            return view('web-ui.errors.404');

        }

    }

    public function getjobquotedetails(Request $request) {

            $jobquotedetails = JobQuoteDetails::where(['job_id' => $request->job_id, 'job_quote_id' => $request->job_quote_id, 'job_quote_details_id' => $request->job_quote_details_id])->orderBy('id','DESC')->get();     

            if($jobquotedetails != "") {

                return view('web-ui.jobs.job-quote-details',compact('jobquotedetails'));

            } else {

                return "0";

            }

    }

    public function addjobquotedetailsreply(Request $request) {

        if(Auth::guard('web')->check()) {

            $request->validate([
                'job_quote_details' => 'required',
            ]);

            DB::beginTransaction();

            try{
                $jobquotedetails = new JobQuoteDetails();
                $jobquotedetails->job_id = $request->job_id;
                $jobquotedetails->job_quote_id = $request->job_quote_id;
                $jobquotedetails->job_quote_details_id = $request->job_quote_details_id;
                $jobquotedetails->user_type = Auth::guard('web')->user()->user_type;
                $jobquotedetails->user_id = Auth::guard('web')->user()->user_id;
                $jobquotedetails->details = $request->job_quote_details;
                $jobquotedetails->save();

                $notifications = new Notifications();
                $jobquote = JobQuotes::where(["id" => $jobquotedetails->job_quote_id])->first();
                $notifications->user_type = "customer";
                $notifications->user_id = $jobquotedetails->user_id;
                $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                $notifications->notification = "replied to your comment.";
                $notifications->reference_url = route('job-details',$request->job_id);
                $notifications->status = 0;
                $notifications->save();

                DB::commit();

                return view('web-ui.jobs.job-quote-details-reply',compact('jobquotedetails'));

            } catch(Exception $e) {
                DB::rollback();
            }
        } else {

            return view('web-ui.errors.404');
        }

    }

    public function viewalljobquotedetails($jobquoteid) { 

            $jobquotedetails = JobQuoteDetails::where(['job_quote_id' => $jobquoteid,'job_quote_details_id' => 0])->orderBy('id','DESC')->offset(1)->limit(100)->get();     

            if($jobquotedetails != "") {

                return view('web-ui.jobs.view-all-comments',compact('jobquotedetails'));

            } else {

                return "0";

            }

    }

    public function updatejobquote($jobquoteid,$status) { 

        if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == "customer") {

            $jobquote = JobQuotes::where(["id" => $jobquoteid])->first();

            if($jobquote != "") {

                if($status == "accept") {
                    $jobquote->status = "Accepted";
                    $jobquote->save();

                    $job = Jobs::where(["id" => $jobquote->job_id])->first();
                    $job->job_status = "Ongoing";
                    $job->save();

                    $acceptquote = [
                        'title' => 'You job quote request has been accepted.',
                        'customer' => $jobquote->getcustomer->name,
                        'trader' => $jobquote->gettrader->name,
                        'job' => $jobquote->getjob->title,
                        'job_id' => $jobquote->job_id
                    ];
              
                    Mail::to($jobquote->gettrader->email)->send(new AcceptjobquoteMail($acceptquote));

                    $alljobquotes = JobQuotes::where(["job_id" => $jobquote->job_id,"status" => "Requested"])->get();

                    if($alljobquotes != "") {
                        foreach($alljobquotes as $key => $quote) {
                            $quote->status = "Rejected";
                            $quote->save();

                            $rejectquote = [
                                'title' => 'You job quote request has been rejected.',
                                'customer' => $quote->getcustomer->name,
                                'trader' => $quote->gettrader->name,
                                'job' => $quote->getjob->title,
                                'job_id' => $quote->job_id
                            ];
                      
                            Mail::to($quote->gettrader->email)->send(new RejectjobquoteMail($rejectquote));

                            $notifications = new Notifications();
                            $notifications->user_type = "trader";
                            $notifications->user_id = $jobquote->trader_id;
                            $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                            $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                            $notifications->notification = "rejected your job quote request";
                            $notifications->reference_url = route('job-details',$jobquote->job_id);
                            $notifications->status = 0;
                            $notifications->save();
                        }
                    }

                    $notifications = new Notifications();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $jobquote->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "accepted your job quote request";
                    $notifications->reference_url = route('job-details',$jobquote->job_id);
                    $notifications->status = 0;
                    $notifications->save();

                    return redirect()->back()->with('success','You have successfully accepted job quote request.');

                } elseif ($status == "reject") {
                    $jobquote->status = "Rejected";
                    $jobquote->save();

                    $rejectquote = [
                        'title' => 'You job quote request has been rejected.',
                        'customer' => $jobquote->getcustomer->name,
                        'trader' => $jobquote->gettrader->name,
                        'job' => $jobquote->getjob->title,
                        'job_id' => $jobquote->job_id
                    ];
              
                    Mail::to($jobquote->gettrader->email)->send(new RejectjobquoteMail($rejectquote));

                    $notifications = new Notifications();
                    $notifications->user_type = "trader";
                    $notifications->user_id = $jobquote->trader_id;
                    $notifications->from_user_type = Auth::guard('web')->user()->user_type;
                    $notifications->from_user_id = Auth::guard('web')->user()->user_id;
                    $notifications->notification = "rejected your job quote request";
                    $notifications->reference_url = route('job-details',$jobquote->job_id);
                    $notifications->status = 0;
                    $notifications->save();

                    return redirect()->back()->with('danger','You have rejected job quote request.');
                }

            } else {

                return view('web-ui.errors.404');

            }
        } else {

            return view('web-ui.errors.404');

        }
    }

    public function getchatuser($search) { 

        $users = User::where('name','like', '%' . $search . '%')->get();

        return view('web-ui.messages.chat-users',compact('users'));

    }

}