@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Bazaar</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $product->product }} </p>
            </div>
        </div>
    </div>
</div>
<div class="inner-area">
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
                <div class="product-details-sec">
                    <div class="prodect-dp">
                        <ul id="bazaar" class="owl-carousel owl-theme">
                            @if(count($product->bazaarimages) > 0)
                            @foreach($product->bazaarimages as $key => $image)
                            <li class="item">
                                <img style="width:100%" src="{{ asset('uploads/bazaar/products/'.$image->product_image) }}" alt="">
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <?php 
                        if($product->added_usertype == "provider") {
                            $user = $product->getprovider;
                            $folder = "providers";
                        } else if($product->added_usertype == "customer") {
                            $user = $product->getuser;
                            $folder = "customers";
                        } else {
                            $user = "";
                        }

                    ?>
                    <h4>{{ $product->product }}</h4>
                    @if($user != "")
                    <h5 class="product-added-user" rel="popover" data-name="{{ $user->name }}" data-joined="{{ date('d F Y',strtotime($user->created_at)) }}" data-img="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}">
                                            Posted By : {{ $user->username }}
                                        </h5>
                    @else
                    <h5>
                        Posted By : Admin
                    </h5>
                    @endif
                    <p>{!! html_entity_decode($product->description) !!}</p>
                    <?php $url = url()->current(); ?>
                    <div class="share-sec">
                        <div class="cmn-sec7">Date posted : {{ date('d F Y',strtotime($product->created_at)) }}</div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type != $product->added_usertype && Auth::guard('web')->user()->user_id != $product->added_by)
                        <div class="cmn-sec8" id="bazaarchatuser">Chat</div>
                        @endif
                        <div class="cmn-sec8 socialShare">Share</div>
                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == $product->added_usertype && Auth::guard('web')->user()->user_id == $product->added_by)
                        <div class="cmn-sec8" data-toggle="modal" data-target="#edit-bazaar-product">Edit</div>
                        @endif
                    </div>
                </div>
                @if(count($related_products) > 0)
                <div class="related-sec">
                    <h6>Related Products</h6>
                    <ul id="related" class="owl-carousel owl-theme">
                        @foreach($related_products as $key => $related_pro)
                        <li class="item">
                            <a href="{{ route('product-details', $related_pro->id) }}">
                                <div class="products">
                                    <div class="product-title">
                                        <h3>{{ $related_pro->product }}</h3>
                                        <p>Posted : {{ date('d F Y, h:i A',strtotime($related_pro->created_at)) }} </p>
                                    </div>
                                    <div class="productImg">
                                        <a href="{{ route('product-details', $related_pro->id) }}"><img src="{{ asset('uploads/bazaar/products/'.$related_pro->bazaarimages[0]->product_image) }}" alt=""></a>
                                    </div>

                                    <?php 
                                        if($related_pro->added_usertype == "provider") {
                                            $user = $related_pro->getprovider;
                                        } else if($related_pro->added_usertype == "customer") {
                                            $user = $related_pro->getuser;
                                        } else {
                                            $user = "";
                                        }

                                    ?>
                                    <?php
                                    $wishlist = new App\Models\ProductsWishlist;
                                    $wishlistdetails = $wishlist::where(['product_id' => $related_pro->id, 'user_id' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_id:"0",'user_type' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_type:""])->first();
                                    ?>
                                    <div class="product-button">
                                        <div class="watch-list">
                                            @if($wishlistdetails != "")
                                            <a href="javascript:" data-id="{{ $related_pro->id }}" class="shortlisted" style="background-color:#303030;"><i class="fa fa-check-square"></i> Shortlisted</a>
                                            @else
                                            <a href="javascript:" data-id="{{ $related_pro->id }}" {{ (Auth::guard('web')->check()) ?"":"onclick=openLoginModal('$url');" }} class="shortlist"><i class="fa fa-plus-circle"></i> Shortlist</a>
                                            @endif
                                        </div>
                                        <div class="product-id">{{ ($user != "")?$user->name:"Admin" }}</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-bazaar-product" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Bazaar Product</h4>
        </div>
        <div class="modal-body">
            <div class="appointment-sec">
                <form class="form-horizontal" action="{{ route('updatebazaarproduct',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')                
                <label>Category</label>
                <select name="category_id" required id="bazaar_parent_category">
                    <option value="">Select</option>
                    @if(count($categories) > 0)
                    @foreach($categories as $key => $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $product->category_id)?"selected":""}}>{{ $category->category }}</option>
                    @endforeach
                    @endif
                </select>
                <label>Sub Category</label>
                <select name="sub_category_id" required id="bazaar-sub-category">
                    <option value="{{ ($product->sub_category_id != 0)?$product->sub_category_id:"" }}">{{ ($product->sub_category_id != 0)?$product->subcategory->category:"" }}</option>
                </select>
                <label>Product</label>
                <input type="text" name="product" placeholder="Product" required value="{{ $product->product }}">
                <label>Price</label>
                <input type="text" name="price" placeholder="Price" required value="{{ $product->price }}">
                <label>Description</label>
                <textarea name="description" placeholder="Description" required>{{ strip_tags($product->description) }}</textarea>
                <label>Location</label>
                <input type="text" required value="{{ $product->product_location }}" name="product_location" placeholder="Location" id="job-location">
                <input type="hidden" name="loc_latitude" value="{{ $product->latitude }}" id="loc_latitude" />
                <input type="hidden" name="loc_longitude" value="{{ $product->longitude }}" id="loc_longitude" />
                @if(count($product->bazaarimages) > 0)
                    <div class="form-group row">
                        <label for="name1" class="col-md-3 col-form-label">Trader Post Images:</label>
                        @foreach($product->bazaarimages as $ke => $image)
                          <div class="col-md-4">
                            <div class="check-sec">
                                <label class="chk">Remove
                                    <input type="checkbox" name="removeImg[]" value="{{ $image->id }}" >
                                    <span class="checkmark"></span>
                                  </label>
                            </div>
                            <img style="width: 100%;" src="{{ asset('uploads/bazaar/products/'.$image->product_image) }}" class="img-fluid mb-2" alt="Product Image"/>
                          </div>
                        @endforeach
                    </div>
                    @endif
                <label>Product Images</label>
                <input type="file" class="image-files" name="product_images[]" multiple>
                <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@if(Auth::guard('web')->check() && (Auth::guard('web')->user()->user_type == "provider" || Auth::guard('web')->user()->user_type == "customer"))
    <form class="form-horizontal" style="display:none;" id="bazaar-chat-user" autocomplete="off" method="POST" action="{{ route('bazaar.messages.store') }} ">
    @csrf
    <input type="hidden" name="from_user_type" 
    value="{{ (Auth::guard('web')->user()->user_type == 'provider')?'trader':'customer' }} ">
    <input type="hidden" name="from_user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
    <input type="hidden" name="to_user_type" value="{{ ($product->added_usertype == 'provider')?'trader':'customer' }}" >
    <input type="hidden" name="to_user_id" value="{{ $product->added_by }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <textarea name="message" placeholder="Message" required></textarea>
    <button>Send</button>
</form>
@endif
@endsection