@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Edit Job</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Edit Job </p>
            </div>
        </div>
    </div>
</div>

<div class="inner-area">
    <div class="review-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(Session::get('success'))
                    <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(Session::get('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    <div class="main-review">
                        <div class="review-profile">
                            <h5>Edit Post</h5>
                        </div>
                        <div class="review-box">
                            <form class="form-horizontal" autocomplete="off" action="{{ route('updatecustomerjob',$job->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $job->user_id }}" >
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $job->getcustomer->name }}" placeholder="Name" required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ '+'.$job->getcustomer->country_code. ' '.$job->getcustomer->mobile }}" placeholder="Phone" required readonly>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Category</label>
                                    <select name="category_id" class="category" required>
                                        <option>Select Category</option>
                                        @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                        <option value="{{ $category->id }}" {{ ($category->id == $job->category_id)?"selected":"" }}>{{ $category->category }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Sub Category</label>
                                    <select name="sub_category_id" required class="sub_category">
                                        <option>Select Sub Category</option>
                                        @if(count($subcategories) > 0)
                                        @foreach($subcategories as $key => $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ ($subcategory->id == $job->sub_category_id)?"selected":"" }}>{{ $subcategory->category }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $job->title }}" placeholder="Title" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Description</label>
                                    <textarea name="description" required placeholder="Description about work">{{ $job->description }}</textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Budget</label>
                                    <input type="text" value="{{ $job->budget }}" name="budget" placeholder="Budget/Price" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Time for Completion</label>
                                    <select name="job_completion" required>
                                        <option value="">Select</option>
                                        <option value="Urgent" {{ ($job->job_completion == "Urgent")?"selected":"" }}>Urgent</option>
                                        <option value="In 2 Days" {{ ($job->job_completion == "In 2 Days")?"selected":"" }}>In 2 Days</option>
                                        <option value="In 1 Week" {{ ($job->job_completion == "In 1 Week")?"selected":"" }}>In 1 Week</option>
                                        <option value="In 1 Month" {{ ($job->job_completion == "In 1 Month")?"selected":"" }}>In 1 Month</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Location</label>
                                    <input type="text" required name="job_location" value="{{ $job->job_location }}" placeholder="Location" id="job-location">
                                      <input type="hidden" name="loc_latitude" value="{{ $job->latitude }}" id="loc_latitude" />
                                      <input type="hidden" name="loc_longitude" value="{{ $job->longitude }}" id="loc_longitude" />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>&nbsp;</label>
                                    <label class="checkbox-inline" style="padding-left:0px;">
                                      <input type="checkbox" {{ ($job->material_purchased == 1)?"checked":"" }} style="height: 16px;" name="material_purchased">Materials Purchased
                                    </label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label>Photos</label>
                                    <input type="file" class="image-files" name="job_images[]" multiple>
                                </div>
                                @if(count($job->jobimages) > 0)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label>Photos</label>
                                    @foreach($job->jobimages as $key => $image)
                                    <div class="col-md-3">
                                        <img style="width: 100%;" src="{{ asset('uploads/jobs/'.$image->job_image) }}" />
                                    </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                                <br/>
                                @endif
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <button type="submit">Update Job</button>
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