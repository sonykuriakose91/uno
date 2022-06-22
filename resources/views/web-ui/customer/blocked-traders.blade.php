@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Blocked Traders</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Blocked Traders </p>
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
                <div class="trader-dashboard">
                    <div class="row">
                        <table class="table table-bordered datatable">
                            <thead>
                                <th>Sl.No</th>
                                <th>Trader</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @if(count($blocks) > 0)
                                @foreach($blocks as $key => $block)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ route('traderdetails', $block->gettrader->username) }}">{{ $block->gettrader->name }}</a></td>
                                    <td>{{ date('d-m-Y h:i A',strtotime($block->created_at)) }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection