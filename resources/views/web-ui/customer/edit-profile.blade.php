@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Edit Profile</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Edit Profile </p>
            </div>
        </div>
    </div>
</div>

<!-- inner area -->
<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <!-- profile area -->
                <div class="profile-sec">
                    <div class="profile-head">
                        <div class="profile-img"><img src="{{ asset('uploads/customers/profile/'.$customer->profile_pic) }}" alt="profile"></div>
                        <!-- <div class="barcode"><img src="images/chart.png" alt="barcode"></div> -->
                    </div>
                    <div class="profile-details">
                        <div class="name-sec">
                            <h5>{{ $customer->name }}</h5>
                            <p>ID : {{ $customer->username }}</p>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && Auth::guard('web')->user()->user_id == $customer->id)
                            <a href="{{ route('edit-customer-profile') }}">Edit Profile</a>
                            @endif
                        </div>
                        <div class="star-rating">
                            <!-- <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star"></i> -->
                        </div>
                        <div class="contact-details">
                            <ul>
                                <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $customer->country_code." ".$customer->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $customer->country_code." ".$customer->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ $customer->email }}</li>
                                <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map">{{ $customer->location }}</li>
                            </ul>
                        </div>
                        
                        <div class="follow-sec">
                            <button class="follow" id="follow-customer" data-id="{{ $customer->id }}" title="Follow"><img src="{{ asset('ui/images/follow.svg') }}" alt="follow"> <span> Following: {{ $following }}</span></button>
                            <div id="view-customer-followers"></div>
                            <button class="like" id="favourite-customer" data-id="{{ $customer->id }}" title="Like"><img src="{{ asset('ui/images/heart.svg') }}" alt="heart"><span>{{ $favorites }}</span></button>
                            <div id="view-customer-favourites"></div>
                        </div>
                        
                    </div>
                </div>
                <!-- skills -->
                <div class="skills-area">
                    <h5>Customer Links</h5>
                    @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'customer' && Auth::guard('web')->user()->user_id == $customer->id)
                @include('web-ui.customer.customer-menu')
                @endif
                </div>
                <div class="modal fade" id="sellatbazaar" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sell at Bazaar</h4>
                        </div>
                        <div class="modal-body">
                            <div class="appointment-sec">
                                <form class="form-horizontal" autocomplete="off" action="{{ route('sell-at-bazaar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_type" value="customer" >
                                <input type="hidden" name="user_id" value="{{ $customer->id }}" >
                                <label>Category</label>
                                <select name="category_id" required id="bazaar_parent_category">
                                    <option value="">Select</option>
                                    @if(count($categories) > 0)
                                    @foreach($categories as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <label>Sub Category</label>
                                <select name="sub_category_id" id="bazaar-sub-category">
                                    <option value="">Select</option>
                                </select>
                                <label>Product</label>
                                <input type="text" name="product" placeholder="Product" required>
                                <label>Price</label>
                                <input type="text" name="price" placeholder="Price" required>
                                <label>Description</label>
                                <textarea name="description" placeholder="Description" required></textarea>
                                <label>Location</label>
                                <input type="text" required name="product_location" placeholder="Location" id="job-location">
                                <input type="hidden" name="loc_latitude" value="" id="loc_latitude" />
                                <input type="hidden" name="loc_longitude" value="" id="loc_longitude" />
                                <label>Product Images</label>
                                <input type="file" class="image-files" required  name="product_images[]" multiple>
                                <button type="submit">Sell at Bazaar</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
                <div class="dashboard-sec">
                    <form action="{{ route('customer-update-profile',$customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <!-- <input type="hidden" name="customer_id" value="{{ $customer->id }}" > -->
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label"></div>
                                    <div class="col-md-9">
                                      <div class="change-img"><img src="{{ asset('uploads/customers/profile/'.$customer->profile_pic) }}" alt=""></div>
                                      <div class="change">
                                        <i class="fa fa-upload"></i>
                                          <input type="file"  class="change-profile" title="Upload" name="profile_image">
                                      </div>
                                    </div>
                                  </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Username:</label>
                                    <div class="col-md-9">
                                      <input type="text" value="{{ $customer->username}}" class="form-control-plaintext" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Name:</label>
                                    <div class="col-md-9">
                                      <input type="text" name="name" required value="{{ $customer->name}}" class="form-control-plaintext" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">Email:</label>
                                    <div class="col-md-9">
                                      <input type="email" name="email" required readonly value="{{ $customer->email}}" class="form-control-plaintext" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-3 col-form-label">Mobile:</label>
                                    <div class="col-md-3">
                                      <select name="country_code" required>
                                        <option value="">Select</option>
                                        @foreach($countries as $k => $country)
                                        <option value="{{ $country->isd_code }}" {{ ($country->isd_code == $customer->country_code)?"selected":"" }}>{{ $country->name }} (+{{ $country->isd_code }})</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" value="{{ $customer->mobile}}" required class="form-control-plaintext" name="mobile" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-9">
                                      <textarea cols="5" class="form-control" name="address" placeholder="Address">{{ $customer->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="location" class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-9">
                                      <input type="text" required  value="{{ $customer->location }}" class="form-control-plaintext" name="location" placeholder="Location" id="customer-location">
                                      <input type="hidden" name="loc_latitude" value="{{ $customer->loc_latitude }}" id="loc_latitude" />
                                      <input type="hidden" name="loc_longitude" value="{{ $customer->loc_longitude }}" id="loc_longitude" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 update">
                                        <button type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection