@if(count($products) > 0)
<ul>
    <input type="hidden" id="bazaar-search-product" value="{{ $search['product'] }}" />
    <input type="hidden" id="bazaar-search-cat-id" value="{{ $search['category'] }}" />
    <input type="hidden" id="bazaar-search-sub-cat-id" value="{{ $search['subcategory'] }}" /> 
    @foreach($products as $key => $product)
    <li>
        <div class="products">
            <div class="product-title" style="min-height: 85px;">
                <h3>{{ $product->product }}</h3>
                <p>Posted : {{ date('d F Y, h:i A',strtotime($product->created_at)) }}</p>
            </div>
            <?php 
            $bazaarimages = new App\Models\BazaarImages;
            $images = $bazaarimages::where(['bazaar_id' => $product->id])->first();
            ?>
            <div class="productImg">
                <a href="{{ route('product-details', $product->id) }}">
                    <img src="{{ asset('uploads/bazaar/products/'.$images->product_image) }}" alt="">
                </a>
            </div>
            <?php 
                if($product->added_usertype == "provider") {
                    $usertype = "Trader";
                    $provider = new App\Models\Providers;
                    $user = $provider::where(['id' => $product->added_by])->first();
                    $folder = "providers";
                } else if($product->added_usertype == "customer") {
                    $usertype = "Customer";
                    $customer = new App\Models\Customers;
                    $user = $customer::where(['id' => $product->added_by])->first();
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
            <?php $url = url()->previous(); ?>
            <div class="product-button">
                <div class="watch-list">
                    @if($wishlistdetails != "")
                    <a href="javascript:" data-id="{{ $product->id }}" class="shortlisted" style="background-color:#303030;"><i class="fa fa-check-square"></i> Shortlisted</a>
                    @else
                    <a href="javascript:" data-id="{{ $product->id }}" {{ (Auth::guard('web')->check()) ?"":"onclick=openLoginModal('$url');" }} class="shortlist"><i class="fa fa-plus-circle"></i> Shortlist</a>
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