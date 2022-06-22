@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Post a Job</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Post a Job </p>
            </div>
        </div>
    </div>
</div>

<div class="inner-area">
    <div class="review-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="main-review">
                        <div class="review-profile">
                            <h5>Post Your Job Here</h5>
                        </div>
                        <div class="review-box">
                            <form class="form-horizontal" autocomplete="off" action="{{ route('postjob') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <?php
                                    $user = new App\Models\Customers;
                                    if(Auth::guard('web')->user()->user_type == "customer") {
                                        $userdetails = $user::where(['status' => 1, 'id' => Auth::guard('web')->user()->user_id])->first();
                                    }
                                    
                                ?>
                            <input type="hidden" name="user_id" value="{{ $userdetails->id }}" >
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $userdetails->name }}" placeholder="Name" required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ '+'.$userdetails->country_code. ' '.$userdetails->mobile }}" placeholder="Phone" required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Category</label>
                                    <select name="category_id" class="category" required>
                                        <option value="">Select Category</option>
                                        @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Sub Category</label>
                                    <select name="sub_category_id" required class="sub_category">
                                        <option value="">Select Sub Category</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Title</label>
                                    <input type="text" name="title" placeholder="Title" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Description</label>
                                    <textarea name="description" required placeholder="Description about work"></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Budget</label>
                                    <input type="text" name="budget" placeholder="Budget/Price" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Time for Completion</label>
                                    <select name="job_completion" required>
                                        <option value="">Select</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="In 2 Days">In 2 Days</option>
                                        <option value="In 1 Week">In 1 Week</option>
                                        <option value="In 1 Month">In 1 Month</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Location</label>
                                    <input type="text" required name="job_location" placeholder="Location" id="job-location">
                                      <input type="hidden" name="loc_latitude" value="" id="loc_latitude" />
                                      <input type="hidden" name="loc_longitude" value="" id="loc_longitude" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>&nbsp;</label>
                                    <label class="checkbox-inline" style="padding-left:0px;">
                                      <input type="checkbox" style="height: 16px;" name="material_purchased">Materials Purchased
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Photos</label>
                                    <input type="file" class="image-files" required name="job_images[]" multiple>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                                    <button type="submit" name="postjob" value="Seek Quote">Seek Quote</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                                    <button type="submit" name="postjob" value="Published">Post Job</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                                    <button type="submit" name="postjob" value="Saved">Save & Post Later</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection