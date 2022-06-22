<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
Route::view('/verify-user', 'web-ui.unverified')->name('verify-user');

Route::get('/', 'HomeController@index')->name('ui-home');

// Route::get('/', function ()    {
//         return view('web-ui.home');
// });

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('register', 'HomeController@register')->name('register');

Route::post('check-username', 'HomeController@checkusername')->name('check-username');

Route::get('account/verify/{email}/{verifytoken}', 'HomeController@verifyaccount')->name('verifyaccount');

Route::get('account/reset-password/{email}/{verifytoken}', 'HomeController@resetpassword')->name('reset-password');

Route::get('forgot-password', 'HomeController@forgot_password')->name('forgot-password');

Route::post('forgot_password', 'HomeController@reset_password_link')->name('forgot_password');

Route::get('login-with-otp', 'HomeController@loginwithotp')->name('login-with-otp');

Route::post('generate-otp', 'HomeController@generateotp')->name('generate-otp');

Route::get('verify-otp', 'HomeController@verifyotp')->name('verify-otp');

Route::post('validate-otp', 'HomeController@validateotp')->name('validate-otp');

Route::get('resend-otp', 'HomeController@resendotp')->name('resend-otp');

Route::post('reset_password', 'HomeController@reset_password')->name('reset_password');

Route::get('about-us', 'HomeController@getcmspages')->name('about-us');

Route::get('contact-us', 'HomeController@getcmspages')->name('contact-us');

Route::post('contactus', 'HomeController@contactus')->name('contactus');

Route::get('privacy-policy', 'HomeController@getcmspages')->name('privacy-policy');

Route::get('terms-and-conditions', 'HomeController@getcmspages')->name('terms-and-conditions');

Route::get('faq', 'HomeController@getfaq')->name('faq');

Route::get('trader/profile/{username}', 'HomeController@traderdetails')->name('traderdetails');

Route::get('traders', 'HomeController@getalltraders')->name('traders');

Route::get('handyman', 'HomeController@getallhandyman')->name('handyman');

Route::get('traders/category/{category}', 'HomeController@tradersbycategory')->name('tradersbycategory');

Route::get('traders/category/{category}/subcategory/{subcategory}', 'HomeController@tradersbysubcategory')->name('tradersbysubcategory');

Route::post('get_provider', 'HomeController@get_provider')->name('get_provider');

Route::post('get_provider_list', 'HomeController@get_provider_list')->name('get_provider_list');

Route::post('get_handyman', 'HomeController@get_handyman')->name('get_handyman');

Route::post('get_handyman_list', 'HomeController@get_handyman_list')->name('get_handyman_list');

Route::post('get_jobs_list', 'HomeController@get_jobs_list')->name('get_jobs_list_category');

Route::post('jobs-sub-category', 'HomeController@getjobssubcategory')->name('jobs-sub-category');

Route::post('jobs-search', 'HomeController@jobssearch')->name('jobs-search');

Route::get('search', 'HomeController@search_providers')->name('search_providers');

Route::get('bazaar', 'HomeController@getbazaarproducts')->name('bazaarhome');

Route::get('bazaar/{category}', 'HomeController@getbazaarproductsbycategory')->name('bazaarbycategory');

Route::post('/bazaarsubcategory', 'HomeController@getbazaar_subcategory')->name('bazaar-sub-category');

Route::post('bazaar-search', 'HomeController@bazaarsearch')->name('bazaar-search');

Route::post('bazaar-sort-search', 'HomeController@bazaarsortsearch')->name('bazaar-sort-search');

Route::post('trader/bad-review', 'HomeController@badreviews')->name('bad-reviews');

Route::get('product/details/{id}', 'HomeController@productdetails')->name('product-details');

Route::get('jobs', 'HomeController@getjobs')->name('jobs');

Route::get('diy-help', 'HomeController@diyhelp')->name('diy-help');

Route::get('packages', 'HomeController@getpackages')->name('packages');

Route::post('newsletter', 'HomeController@newsletter')->name('newsletter');

Route::post('trader/post/post-comment-replies', 'HomeController@gettraderpostcommentreplies')->name('trader.get-trader-post-comment-replies');

Route::post('trader/offer/offer-comment-replies', 'HomeController@gettraderoffercommentreplies')->name('trader.get-trader-offer-comment-replies');

Route::post('trader/review/review-comment-replies', 'HomeController@gettraderreviewcommentreplies')->name('trader.get-trader-review-comment-replies');

Route::get('trader/post/view-all-post-comments/{postid}', 'HomeController@viewalltraderpostcomments')->name('trader.view-all-post-comments');

Route::get('trader/offer/view-all-offer-comments/{offerid}', 'HomeController@viewalltraderoffercomments')->name('trader.view-all-offer-comments');

Route::get('trader/review/view-all-review-comments/{reviewid}', 'HomeController@viewalltraderreviewcomments')->name('trader.view-all-review-comments');

Route::post('diy-help/diy-help-comment-replies', 'HomeController@getdiyhelpcommentreplies')->name('get-diy-help-comment-replies');

Route::get('diy-help/view-all-diy-help-comments/{diyhelpid}', 'HomeController@viewalldiyhelpcomments')->name('view-all-diyhelp-comments');

Route::get('jobs/details/{id}', 'HomeController@jobdetails')->name('job-details');

Route::group(['middleware' => 'auth:web'], function () {
	
    Route::post('/logout', 'Auth\LoginController@logout')->name('userlogout');

    Route::get('change-password', 'HomeController@changepassword')->name('change-password');

	Route::post('update-password', 'HomeController@update_password')->name('update-password');

    // Route::get('myaccount/{username}', 'HomeController@traderdashboard')->name('traderdashboard');

    Route::post('/trader-post', 'HomeController@addtraderpost')->name('traderpost');

    Route::post('/trader-offers', 'HomeController@addtraderoffer')->name('traderoffers');

    Route::post('/trader-reviews', 'HomeController@addtraderreview')->name('traderreviews');

    Route::post('/trader-review-comments', 'HomeController@addreviewcomment')->name('addreviewcomment');

    Route::post('/trader-review-comments-reply', 'HomeController@addreviewcommentreply')->name('addreviewcommentreply');

    Route::post('/trader-post-comments', 'HomeController@addpostcomment')->name('addpostcomment');

    Route::post('/trader-post-comments-reply', 'HomeController@addpostcommentreply')->name('addpostcommentreply');

    Route::post('/trader-post-comments-customer', 'HomeController@addpostcommentcustomer')->name('addpostcommentcustomer');

    Route::post('/trader-post-comments-customer-reply', 'HomeController@addpostcommentcustomerreply')->name('addpostcommentreplycustomer');

    Route::post('/trader-offer-comments', 'HomeController@addoffercomment')->name('addoffercomment');

    Route::post('/trader-offer-comments-reply', 'HomeController@addoffercommentreply')->name('addoffercommentreply');

    Route::post('/trader-offer-comments-customer', 'HomeController@addoffercommentcustomer')->name('addoffercommentcustomer');

    Route::post('/trader-offer-comments-customer-reply', 'HomeController@addoffercommentcustomerreply')->name('addoffercommentreplycustomer');

    Route::post('/trader/remove-completed-work', 'HomeController@removecompletedwork')->name('remove-completed-work');

    Route::post('trader/post-reaction', 'HomeController@traderpostreaction')->name('traderpostreaction');

    Route::post('trader/offer-reaction', 'HomeController@traderofferreaction')->name('traderofferreaction');

    Route::post('/book-appointment', 'HomeController@bookappointment')->name('book-appointment');

    Route::post('/sell-at-bazaar', 'HomeController@sellatbazaar')->name('sell-at-bazaar');

	Route::post('/bazaar-subcategory', 'HomeController@getbazaarsubcategory')->name('bazaar-subcategory');

	Route::get('trader/bazaar/{category}', 'HomeController@userbazaarbycategory')->name('traderbazaarbycategory');

	Route::get('customer/bazaar/{category}', 'HomeController@userbazaarbycategory')->name('customerbazaarbycategory');

	Route::post('user-bazaar-search', 'HomeController@userbazaarsearch')->name('user-bazaar-search');

	Route::post('user-bazaar-sort-search', 'HomeController@userbazaarsortsearch')->name('user-bazaar-sort-search');

    Route::get('trader/edit-profile/{id}', 'HomeController@edittraderprofile')->name('edit-trader-profile');

	Route::put('trader/update-profile/{id}', 'HomeController@updatetraderprofile')->name('updatetraderprofile');

	Route::put('trader/update-trader-profile', 'HomeController@traderprofileupdate')->name('trader-profile-update');

    Route::get('trader/appointments', 'HomeController@traderappointments')->name('trader-appointments');

    Route::get('customer/appointments', 'HomeController@customerappointments')->name('customer-appointments');

	Route::get('customer/profile', 'HomeController@customerhome')->name('customerhome');

    Route::get('customer/post-job', 'HomeController@post_a_job')->name('post-job');

	Route::post('sub-category', 'HomeController@getsubcategory')->name('sub-category');

    Route::post('customer/post-job', 'HomeController@postjob')->name('postjob');

	Route::get('trader/profile/{username}/seek-quote/{job_id}', 'HomeController@traderdetails')->name('traderdetails-seekquote');

    Route::post('trader/profile/{username}/post-job', 'HomeController@trader_profile_postjob')->name('trader-profile-postjob');

    Route::post('shortlist-product', 'HomeController@shortlistproduct')->name('shortlist-product');

    Route::post('remove-shortlist-product', 'HomeController@removeshortlistproduct')->name('remove-shortlist-product');

	Route::get('customer/wishlist', 'HomeController@customerwishlistproducts')->name('customer-wishlist-products');

    Route::get('customer/edit-profile', 'HomeController@editcustomerprofile')->name('edit-customer-profile');

	Route::put('customer/update-profile/{id}', 'HomeController@updatecustomerprofile')->name('customer-update-profile');

    Route::post('customer/trader-post-report', 'HomeController@addpostreport')->name('addpostreport');

	Route::get('customer/jobs/{job_status}', 'HomeController@jobsbystatus')->name('jobsbystatus');

	Route::post('customer/jobs/category/search', 'HomeController@jobsbystatusbycategory')->name('jobsbystatuscat');

	Route::post('customer/jobs/search', 'HomeController@custjobssearch')->name('cust-jobs-search');

    Route::get('customer/jobs/{id}/{job_status}', 'HomeController@changejobstatus')->name('changejobstatus');

	Route::delete('customer/jobs/{id}', 'HomeController@deletejob')->name('customerdeletejob');

    Route::get('customer/edit-job/{id}', 'HomeController@editcustomerjob')->name('edit-customer-job');

    Route::put('customer/update-job/{id}', 'HomeController@updatecustomerjob')->name('updatecustomerjob');

    Route::get('customer/seek-quote/job/{job_id}/category/{category_id}/sub_category/{sub_category_id}', 'HomeController@customerseekquote')->name('customerseekquote');

    Route::get('customer/job/seek-quote/{job_id}', 'HomeController@jobseekquote')->name('getjobseekquote');

    Route::get('customer/jobs/{job_id}/trader-request-quote/{trader_id}', 'HomeController@traderrequestquote')->name('traderrequestquote');

    // Route::get('trader/jobs/{job_id}/trader-seek-quote/{trader_id}', 'HomeController@traderseekquote')->name('traderseekquote');

	Route::get('trader/jobs/{job_status}', 'HomeController@traderjobsbystatus')->name('traderjobsbystatus');

	Route::get('trader/jobs-quote-requests', 'HomeController@traderjobsquoterequests')->name('traderjobsquoterequests');

    Route::post('trader/jobs/request-details', 'HomeController@addjobrequestdetails')->name('job-request-details');

    Route::get('trader/jobs/{id}/{job_status}', 'HomeController@changejobquotestatus')->name('changejobquotestatus');

    Route::post('customer/change-appointment-status', 'HomeController@customerchangeappointmentstatus')->name('customerchangeappointmentstatus');

    Route::post('trader/change-appointment-status', 'HomeController@traderchangeappointmentstatus')->name('traderchangeappointmentstatus');

    Route::get('trader/edit-trader-post/{id}', 'HomeController@edittraderpost')->name('edit-trader-post');

	Route::put('trader/update-trader-post/{id}', 'HomeController@traderupdatetraderpost')->name('traderupdatetraderpost');

    Route::get('trader/edit-trader-offer/{id}', 'HomeController@edittraderoffer')->name('edit-trader-offer');

	Route::put('trader/update-trader-offer/{id}', 'HomeController@traderupdatetraderoffer')->name('traderupdatetraderoffer');

	Route::get('trader/bazaar', 'HomeController@gettraderbazaarproducts')->name('trader-bazaar');

	Route::get('customer/bazaar', 'HomeController@getcustomerbazaarproducts')->name('customer-bazaar');

	Route::put('product/update-bazaar-product/{id}', 'HomeController@updatebazaarproduct')->name('updatebazaarproduct');

	Route::get('customer/clarification-requests', 'HomeController@clarificationrequests')->name('clarification-requests');

    Route::get('customer/view-clarification-request/{id}', 'HomeController@viewclarificationrequest')->name('view-clarification-request');

	Route::get('customer/receipts', 'HomeController@getreceipts')->name('customer.receipts.index');

	Route::post('customer/receipts/store', 'HomeController@storereceipt')->name('customer.receipts.store');

	Route::delete('customer/receipts/{id}', 'HomeController@destroyreceipt')->name('customer.receipts.destroy');

	Route::get('trader/receipts', 'HomeController@getreceipts')->name('trader.receipts.index');

	Route::post('trader/receipts/store', 'HomeController@storereceipt')->name('trader.receipts.store');

	Route::delete('trader/receipts/{id}', 'HomeController@destroyreceipt')->name('trader.receipts.destroy');

	Route::post('customer/messages/store', 'HomeController@storemessagefromseekquote')->name('customer.messages.store');

	Route::post('messages/reply', 'HomeController@storemessagereply')->name('messagesreply.store');

	Route::get('customer/messages', 'HomeController@getmessages')->name('customer.messages.index');

	Route::get('customer/messages/{message_type}', 'HomeController@getmessagesbytype')->name('customer.messages.messagetype');

	Route::get('trader/messages', 'HomeController@getmessages')->name('trader.messages.index');

	Route::post('trader/messages/view-messages', 'HomeController@getmessagesbytype')->name('trader.messages.view-message');

	// Route::post('customer/messages/view-messages', 'HomeController@customergetmessagesbytype')->name('customer.messages.view-message');

	// Route::get('trader/message/{id}', 'HomeController@getmessagesbyid')->name('trader-messages.messageid');

	Route::post('trader/messages/store', 'HomeController@storemessage')->name('trader.messages.store');

	Route::post('bazaar/messages/store', 'HomeController@bazaarstoremessage')->name('bazaar.messages.store');

	Route::post('messages/store', 'HomeController@storemessagetraderlist')->name('messages.store');

	// Route::get('customer/message/{id}', 'HomeController@getmessagesbyid')->name('customer-messages.messageid');

	Route::post('trader/add-follow', 'HomeController@addfollow')->name('trader.addfollow');

	Route::post('trader/add-favourite', 'HomeController@addfavourite')->name('trader.addfavourite');

	Route::get('trader/profile-insights', 'HomeController@profileinsights')->name('profileinsights');

	Route::get('trader/profile-visits', 'HomeController@profilevisits')->name('profilevisits');

	Route::get('trader/search-history', 'HomeController@searchhistory')->name('searchhistory');

	Route::get('trader/customers-contacted', 'HomeController@customerscontacted')->name('customerscontacted');

	Route::post('add-diy-help', 'HomeController@adddiyhelp')->name('adddiyhelp');

	Route::post('add-diy-help-comment', 'HomeController@adddiyhelpcomment')->name('adddiyhelpcomment');

	Route::post('add-diy-help-comment-reply', 'HomeController@adddiyhelpcommentreply')->name('adddiyhelpcommentreply');

	Route::get('trader/view-follows/{trader_id}', 'HomeController@gettraderfollows')->name('trader-follows');

	Route::get('trader/view-favourites/{trader_id}', 'HomeController@gettraderfavourites')->name('trader-favourites');

	Route::get('customer/view-follows/{customer_id}', 'HomeController@getcustomerfollows')->name('customer-follows');

	Route::get('customer/view-favourites/{customer_id}', 'HomeController@getcustomerfavourites')->name('customer-favourites');

    Route::post('customer/jobs/update-jobrequest-details', 'HomeController@updatejobrequestdetails')->name('update-job-request-details');

    Route::get('block-user/{id}', 'HomeController@blockuser')->name('block-user');

    Route::get('unblock-user/{id}', 'HomeController@unblockuser')->name('unblock-user');

    Route::post('categories/getcategory', 'HomeController@getcategory')->name('getcategory'); 

    Route::post('categories/getsubcategory', 'HomeController@getsubcategorytrader')->name('getsubcategorytrader'); 

	Route::post('services/category_service', 'HomeController@category_service')->name('category_servicetrader');

    Route::get('customer/blocked-traders', 'HomeController@blockedtraders')->name('blocked-traders');

    Route::get('trader/customers-blocked', 'HomeController@customersblocked')->name('customers-blocked');

    Route::get('trader/get-trader-post-likes/{postid}', 'HomeController@gettraderpostlikes')->name('get-trader-post-likes');

    Route::get('trader/get-trader-offer-likes/{offerid}', 'HomeController@gettraderofferlikes')->name('get-trader-offer-likes');

    Route::post('jobs/trader-quote-job', 'HomeController@traderquotejob')->name('trader.traderquotejob');

	Route::post('jobs/job-quote-details', 'HomeController@getjobquotedetails')->name('get-job-quote-details');

	Route::post('add-job-quote-details-reply', 'HomeController@addjobquotedetailsreply')->name('addjobquotedetailsreply');

	Route::get('jobs/view-all-jobquote-details/{jobquoteid}', 'HomeController@viewalljobquotedetails')->name('view-all-jobquote-details');

	Route::get('jobs/update-jobquote/{jobquoteid}/{status}', 'HomeController@updatejobquote')->name('updatejobquote');

    Route::get('messages/get-chat-user/{user}', 'HomeController@getchatuser')->name('get-chat-user');
});

Route::group(['prefix' => 'admin','middleware' => 'guest:admin'], function () {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('adminuserloginForm');
	
    Route::post('/login', 'Auth\LoginController@adminlogin')->name('adminuserlogin');
});

Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
	
    Route::get('/', 'AdminController@index');
	
    Route::post('/logout', 'Auth\LoginController@adminlogout')->name('logout');
	
    Route::get('/home', 'AdminController@index')->name('home');

    Route::resource('categories', CategoriesController::class);

	Route::resource('services', ServicesController::class);

	Route::resource('providers', ProvidersController::class);

	Route::resource('bazaar-category', BazaarCategoryController::class);

	Route::resource('bazaar-products', BazaarController::class);

	Route::get('bazaar-products/approve/{id}', 'BazaarController@approve')->name('bazaar-products.approve');

	Route::get('bazaar-products/reject/{id}', 'BazaarController@reject')->name('bazaar-products.reject');

	Route::resource('customers', CustomersController::class);

	Route::resource('faq', FaqController::class);

	Route::resource('ads', AdsController::class);

    Route::resource('packages', PackagesController::class);

	Route::get('providers/approvedocument/{id}', 'ProvidersController@approvedocument')->name('providers.approvedocument');

	Route::get('providers/rejectdocument/{id}', 'ProvidersController@rejectdocument')->name('providers.rejectdocument');

	Route::get('providers/approve/{id}', 'ProvidersController@approve')->name('providers.approve');

	Route::get('providers/reject/{id}', 'ProvidersController@reject')->name('providers.reject');

	Route::get('providers/approveservice/{id}', 'ProvidersController@approveservice')->name('providers.approveservice');

	Route::get('providers/rejectservice/{id}', 'ProvidersController@rejectservice')->name('providers.rejectservice');

	Route::get('providers/approvecategory/{id}', 'ProvidersController@approvecategory')->name('providers.approvecategory');

	Route::get('providers/rejectcategory/{id}', 'ProvidersController@rejectcategory')->name('providers.rejectcategory');

	Route::get('trader-posts', 'ProvidersController@gettraderposts')->name('traderposts.index');

	Route::get('reported-trader-posts', 'ProvidersController@gettraderpostsreported')->name('traderpostsreported.index');

	Route::get('trader-posts/create', 'ProvidersController@addtraderpost')->name('traderposts.create');

	Route::post('trader-posts/store', 'ProvidersController@storetraderpost')->name('traderposts.store');

	Route::get('trader-posts/edit/{id}', 'ProvidersController@edittraderpost')->name('traderposts.edit');

	Route::put('trader-posts/update/{id}', 'ProvidersController@updatetraderpost')->name('traderposts.update');

	Route::delete('trader-posts/{id}', 'ProvidersController@destroytraderpost')->name('traderposts.destroy');

	Route::get('trader-offers', 'ProvidersController@gettraderoffers')->name('traderoffers.index');

	Route::get('trader-offers/create', 'ProvidersController@addtraderoffer')->name('traderoffers.create');

	Route::post('trader-offers/store', 'ProvidersController@storetraderoffer')->name('traderoffers.store');

	Route::get('trader-offers/edit/{id}', 'ProvidersController@edittraderoffer')->name('traderoffers.edit');

	Route::put('trader-offers/update/{id}', 'ProvidersController@updatetraderoffer')->name('traderoffers.update');

	Route::delete('trader-offers/{id}', 'ProvidersController@destroytraderoffer')->name('traderoffers.destroy');

	Route::get('services/approve/{id}', 'ServicesController@approve')->name('services.approve');

	Route::get('services/reject/{id}', 'ServicesController@reject')->name('services.reject');

	Route::resource('pages', PagesController::class);

	Route::get('pages/pagedetails/{page_type}', 'PagesController@pagedetails');

	Route::resource('reviews', ReviewsController::class);

	Route::get('reviews/approve/{id}', 'ReviewsController@approve')->name('reviews.approve');

	Route::get('reviews/reject/{id}', 'ReviewsController@reject')->name('reviews.reject');

	Route::resource('banners', BannersController::class);

	Route::get('profile', 'AdminController@profile')->name('profile');

	Route::post('updateprofile', 'AdminController@updateprofile')->name('updateprofile');

	Route::get('changepassword', 'AdminController@changepassword')->name('changepassword');

	Route::post('updatepassword', 'AdminController@updatepassword')->name('updatepassword');

	Route::get('customers/approve/{id}', 'CustomersController@approve')->name('customers.approve');

	Route::get('customers/reject/{id}', 'CustomersController@reject')->name('customers.reject');

	Route::get('faq/approve/{id}', 'FaqController@approve')->name('faq.approve');

	Route::get('faq/reject/{id}', 'FaqController@reject')->name('faq.reject');

	Route::post('providers/category_service', 'ProvidersController@category_service')->name('category_service');

	Route::post('providers/provider_service_locations', 'ProvidersController@provider_service_locations')->name('provider_service_locations');

	Route::post('providers/change_service_locations', 'ProvidersController@change_service_locations')->name('change_service_locations');

	Route::resource('settings', SettingsController::class);

	Route::post('categories/getsubcategory', 'CategoriesController@getsubcategory')->name('getsubcategory');

	Route::post('services/getsubcategory', 'ServicesController@getsubcategory')->name('subcategorylist');

	Route::post('providers/getsubcategory', 'ProvidersController@getsubcategory')->name('subcategories');

	Route::post('bazaar-category/getsubcategory', 'BazaarCategoryController@getsubcategory')->name('getbazaarsubcategory');

	Route::get('appointments', 'ProvidersController@getappointments')->name('appointments.index');

	Route::get('jobs', 'JobsController@index')->name('jobs.index');

	Route::get('jobs/status/{job_status}', 'JobsController@getjobsbystatus')->name('getjobsbystatus');

	Route::delete('jobs/{id}', 'JobsController@destroy')->name('jobs.destroy');

	Route::get('jobs/{id}', 'JobsController@show')->name('jobs.show');

	Route::get('jobs/approve/{id}', 'JobsController@approve')->name('jobs.approve');

	Route::get('jobs/reject/{id}', 'JobsController@reject')->name('jobs.reject');

	Route::get('trader-posts/view/{id}', 'ProvidersController@viewtraderpost')->name('traderposts.view');

	Route::get('trader-posts/approve/{id}', 'ProvidersController@approvetraderpost')->name('traderposts.approve');

	Route::get('trader-posts/reject/{id}', 'ProvidersController@rejecttraderpost')->name('traderposts.reject');

	Route::get('receipts', 'ReceiptsController@index')->name('receipts.index');

	Route::get('messages', 'MessagesController@index')->name('messages.index');

	Route::get('diy-help', 'DiyhelpController@index')->name('diy-help.index');

	Route::get('diy-help/{id}', 'DiyhelpController@show')->name('diy-help.show');

	Route::get('diy-help/approve/{id}', 'DiyhelpController@approve')->name('diy-help.approve');

	Route::get('diy-help/reject/{id}', 'DiyhelpController@reject')->name('diy-help.reject');

	Route::get('diy-help/approve-comment/{id}', 'DiyhelpController@approvecomment')->name('diy-help-comment.approve');

	Route::get('diy-help/reject-comment/{id}', 'DiyhelpController@rejectcomment')->name('diy-help-comment.reject');

	Route::get('trader-posts/approve-comment/{id}', 'ProvidersController@approvepostcomment')->name('trader-post-comment.approve');

	Route::get('trader-posts/reject-comment/{id}', 'ProvidersController@rejectpostcomment')->name('trader-post-comment.reject');

	Route::get('trader-offers/view/{id}', 'ProvidersController@viewtraderoffer')->name('traderoffers.view');

	Route::get('trader-offers/approve/{id}', 'ProvidersController@approvetraderoffer')->name('traderoffers.approve');

	Route::get('trader-offers/reject/{id}', 'ProvidersController@rejecttraderoffer')->name('traderoffers.reject');

	Route::get('trader-offers/approve-comment/{id}', 'ProvidersController@approveoffercomment')->name('trader-offer-comment.approve');

	Route::get('trader-offers/reject-comment/{id}', 'ProvidersController@rejectoffercomment')->name('trader-offer-comment.reject');

	Route::get('reviews/approve-comment/{id}', 'ReviewsController@approvereviewcomment')->name('trader-review-comment.approve');

	Route::get('reviews/reject-comment/{id}', 'ReviewsController@rejectreviewcomment')->name('trader-review-comment.reject');

	Route::get('newsletter', 'NewsletterController@index')->name('newsletter.index');
});



// Route::get('/forgot-password', function () {
//     return view('auth.passwords.email');
// })->middleware('guest')->name('password.request');

