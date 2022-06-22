@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Bazaar</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Bazaar </p>
            </div>
        </div>
    </div>
</div>

<div class="inner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="bazaar-category mb-sec">
                    <div class="category-head">Main Category</div>
                    <div class="category-links">
                        @if(count($categories) > 0)
                        <ul>
                            @foreach($categories as $key => $category)
                            <li><a href="{{ route('customerbazaarbycategory',$category->id) }}">{{ $category->category }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="bazaar-category">
                    <div class="category-head">Search Products <a href="#" data-toggle="modal" data-target="#sellatbazaar">Sell at Bazaar Now</a></div>
                    @if(Auth::guard('web')->check())
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
                                    <input type="hidden" name="user_type" value="{{ Auth::guard('web')->user()->user_type }}" >
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->user_id }}" >
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
                    @endif
                    <div class="search-sec">
                        <form id="user-bazaar-search" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sec-search">
                                    <input id="product" type="text" name="product" required placeholder="Search For Product">
                                    <select name="category" required class="bazaarcategory">
                                        <option value="">Main Category</option>
                                            @if(count($categories) > 0)
                                            @foreach($categories as $key => $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                    <select name="subcategory" required class="bazaarsubcategory">
                                        <option value="">Sub Category</option>
                                    </select>
                                    <input id="distance" type="number" name="distance" required placeholder="Distance">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sec-search" style="margin-top:12px;">
                                    <button type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="product-listing">
                    <div class="sort">
                        <div class="sort-sec">
                            <label>Sort : </label>
                            <select class="user-bazaar-product-sort">
                                <option value="1">Most recent</option>
                                <option value="2">Lowest price</option>
                                <option value="3">Oldest price</option>
                                <option value="4">Highest price</option>
                            </select>
                        </div>
                    </div>
                    <div class="bazaar-list"> 
                    @if(count($products) > 0)
                    <ul>
                        <input type="hidden" id="bazaar-search-product" value="" />
                        <input type="hidden" id="bazaar-search-cat-id" value="" />
                        <input type="hidden" id="bazaar-search-sub-cat-id" value="" /> 
                        @foreach($products as $key => $product)
                        <li>
                            <div class="products">
                                <div class="product-title" style="min-height: 85px;">
                                    <h3>{{ $product->product }}</h3>
                                    <p>Posted : {{ date('d F Y, h:i A',strtotime($product->created_at)) }}</p>
                                </div>
                                <div class="productImg">
                                    <a href="{{ route('product-details', $product->id) }}"><img src="{{ asset('uploads/bazaar/products/'.$product->bazaarimages[0]->product_image) }}" alt=""></a>
                                </div>
                                <?php 
                                    if($product->added_usertype == "provider") {
                                        $usertype = "Trader";
                                        $user = $product->getprovider;
                                        $folder = "providers";
                                    } else if($product->added_usertype == "customer") {
                                        $usertype = "Customer";
                                        $user = $product->getuser;
                                        $folder = "customers";
                                    } else {
                                        $usertype = "Admin";
                                        $user = "";
                                    }

                                ?>
                                <?php
                                    $wishlist = new App\Models\ProductsWishlist;
                                    $wishlistdetails = $wishlist::where(['product_id' => $product->id, 'user_id' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_id:"0",'user_type' => (Auth::guard("web")->check())?Auth::guard("web")->user()->user_type:""])->first();
                                ?>
                                <div class="product-button">
                                    <div class="watch-list">
                                        @if($wishlistdetails != "")
                                        <a href="javascript:" data-id="{{ $product->id }}" class="shortlisted" style="background-color:#303030;"><i class="fa fa-check-square"></i> Shortlisted</a>
                                        @else
                                        <a href="javascript:" data-id="{{ $product->id }}" class="shortlist"><i class="fa fa-plus-circle"></i> Shortlist</a>
                                        @endif
                                    </div>
                                    @if($user != "")
                                    <div class="product-id product-added-user" rel="popover" data-name="{{ $user->name }}" data-joined="{{ date('d F Y',strtotime($user->created_at)) }}" data-img="{{ asset('uploads/'.$folder.'/profile/'.$user->profile_pic) }}" style="max-height: 50px;">
                                        {{ $user->username }}
                                    </div>
                                    @else
                                    <div class="product-id" style="max-height: 50px;">
                                        Admin
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No products found.!!</p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection