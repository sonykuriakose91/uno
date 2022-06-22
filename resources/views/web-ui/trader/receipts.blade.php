@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>Receipts</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> Receipts </p>
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
                        <div class="profile-img"><img src="{{ asset('uploads/providers/profile/'.$provider->profile_pic) }}" alt="profile"></div>
                        <div class="barcode"><img src="{{ asset('uploads/providers/qrcode/'.$provider->qrcode) }} " alt="barcode"></div>
                    </div>
                    <div class="profile-details">
                        <div class="name-sec">
                            <h5>{{ $provider->name }}</h5>
                            <p>{{ $provider->providercategories[0]->getcategory->category }} <span>ID : {{ $provider->username }}</span></p>
                        </div>
                        <!-- <div class="star-rating">
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star yellow"></i>
                            <i class="fa fa-star"></i>
                        </div> -->
                        <div class="contact-details">
                            <ul>
                                <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $provider->country_code }} {{ $provider->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $provider->country_code }} {{ $provider->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ $provider->email }}</li>
                                <li><img src="{{ asset('ui/images/icon-web.svg') }}" alt="website">{{ $provider->web_url }}</li>
                                <li><img src="{{ asset('ui/images/icon-time.svg') }}" alt="time">{{ date('h:i A',$provider->available_time_from) .' - '. date('h:i A',$provider->available_time_to) }}</li>
                                <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map"><a href="https://maps.google.com/maps?q={{ $provider->location.'&sll'.$provider->loc_latitude.','.$provider->loc_longitude }}" target="_blank">{{ $provider->location }}</a></li>
                                <li><img src="{{ asset('ui/images/landmark.svg') }}" alt="map"><a href="#">{{ $provider->landmark }}</a></li>
                            </ul>
                            <div class="landmark">
                                <p>{{ $provider->landmark_data }}</p>
                            </div>
                        </div>
                        <!-- <div class="details-btn">
                            <button class="get-quote">Quotes</button>
                        </div> -->
                    </div>
                </div>
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $provider->id)
                @include('web-ui.trader.trader-menu')
                @endif
            </div>

                <div class="modal fade" id="addreceipt" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Receipt</h4>
                        </div>
                        <div class="modal-body">
                            <div class="appointment-sec">
                                <form class="form-horizontal" autocomplete="off" action="{{ route('trader.receipts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_type" value="provider" >
                                <input type="hidden" name="user_id" value="{{ $provider->id }}" >
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Title" required>
                                <label>Remarks</label>
                                <textarea name="remarks" placeholder="Remarks"></textarea>
                                <label>Receipt</label>
                                <input type="file" class="image-files" required  name="receipt_image">
                                <button type="submit">Submit</button>
                            </form>
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
                <div class="top-toolbar" style="padding:0px;">
                        <div class="filter-section">
                            <div class="showing-result">
                                <h4>Receipts</h4>
                            </div>
                            <div class="sort-section">
                                <a href="#" data-toggle="modal" data-target="#addreceipt" class="btn btn-success pull-right">Add receipt</a>
                            </div>
                        </div>
                    </div>
                <div class="trader-dashboard">
                    <div class="row">
                        <table class="table table-bordered datatable">
                            <thead>
                                <th>Sl.No</th>
                                <th>Title</th>
                                <th>Receipt</th>
                                <th>Date</th>
                                <th>#</th>
                            </thead>
                            <tbody>
                                @if(count($receipts) > 0)
                                @foreach($receipts as $key => $receipt)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $receipt->title }}</td>
                                    <td><a class="receipt-image" data-title="{{ $receipt->title }}" href="{{ asset('uploads/receipts/'.$receipt->receipt_image) }}" target="_blank">{{ $receipt->receipt_image }}</a></td>
                                    <td>{{ date('d-m-Y',strtotime($receipt->created_at)) }}</td>
                                    <td>
                                        <form action="{{ route('customer.receipts.destroy',$receipt->id) }}" method="POST">
                                          @csrf
                                          @method('DELETE')    
                                          <button type="submit" onclick="return confirm('Are you sure you want to delete this receipt?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                      </form>
                                    </td>
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
<div class="modal fade" id="receiptsimage" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Receipt</h4>
        </div>
        <div class="modal-body">
            
        </div>
        <div class="modal-footer">
            <a target="_blank" class="btn btn-success">Download</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
@endsection