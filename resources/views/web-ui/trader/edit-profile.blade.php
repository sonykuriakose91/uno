@extends('web-ui.layouts.app')

@section('content')
<!-- banner area -->
<div class="inner-banner" id="bannerImgInner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1>{{ $trader->name }}</h1>
                <p><a href="{{ route('ui-home') }}">Home</a><img src="{{ asset('ui/images/arrow-right.svg') }}"> {{ $trader->name }} </p>
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
                        <div class="profile-img"><img src="{{ asset('uploads/providers/profile/'.$trader->profile_pic) }}" alt="profile"></div>
                        <div class="barcode"><img src="{{ asset('uploads/providers/qrcode/'.$trader->qrcode) }}" alt="barcode"></div>
                    </div>
                    <div class="profile-details">
                        <div class="name-sec">
                            <h5>{{ $trader->name }}</h5>
                            <p>{{ isset($trader->providercategories[0]->getcategory->category)?$trader->providercategories[0]->getcategory->category:"" }} <span>ID : {{ $trader->username }}</span></p>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $trader->id)
                            <a href="{{ route('edit-trader-profile',$trader->id) }}">Edit Profile</a>
                            @endif
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
                                <li><img src="{{ asset('ui/images/icon-whatsapp.svg') }}" alt="whatsapp">+{{ $trader->country_code }} {{ $trader->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-phone.svg') }}" alt="phone">+{{ $trader->country_code }} {{ $trader->mobile }}</li>
                                <li><img src="{{ asset('ui/images/icon-email.svg') }}" alt="email">{{ $trader->email }}</li>
                                <li><img src="{{ asset('ui/images/icon-web.svg') }}" alt="website">{{ $trader->web_url }}</li>
                                <li><img src="{{ asset('ui/images/icon-time.svg') }}" alt="time">{{ date('h:i A',$trader->available_time_from) .' - '. date('h:i A',$trader->available_time_to) }}</li>
                                <li><img src="{{ asset('ui/images/icon-map.svg') }}" alt="map"><a href="https://maps.google.com/maps?q={{ $trader->location.'&sll'.$trader->loc_latitude.','.$trader->loc_longitude }}" target="_blank">{{ $trader->location }}</a></li>
                                <li><img src="{{ asset('ui/images/landmark.svg') }}" alt="map"><a href="#">{{ $trader->landmark }}</a></li>
                            </ul>
                            <div class="landmark">
                                <p>{{ $trader->landmark_data }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type == 'provider' && Auth::guard('web')->user()->user_id == $trader->id)
                @include('web-ui.trader.trader-menu')
                @endif              
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
                    <form action="{{ route('updatetraderprofile',$trader->id) }}" method="POST" id="edit-profile-wizard" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="trader_id" value="{{ $trader->id }}">
                    <input type="hidden" class="update-profile-step" name="step" value="">
                    <h3 style="display: none;">Profile</h3>
                    <fieldset>
                        <legend>Profile</legend>
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label"></div>
                                    <div class="col-md-9">
                                      <div class="change-img"><img src="{{ asset('uploads/providers/profile/'.$trader->profile_pic) }}" alt=""></div>
                                      <div class="change">
                                        <i class="fa fa-upload"></i>
                                          <input type="file" class="change-profile" title="Upload" name="profile_image">
                                      </div>
                                    </div>
                                  </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Type:</div>
                                    <div class="col-md-9 radio-sty">
                                    <label class="rd">Company
                                        <input type="radio" {{ ( $trader->type == "Company") ? 'checked' : '' }}  name="type" value="Company" required>
                                        <span class="checkmark"></span>
                                      </label>
                                      <label class="rd">Individual
                                        <input type="radio" {{ ( $trader->type == "Individual") ? 'checked' : '' }}  name="type" value="Individual" required>
                                        <span class="checkmark"></span>
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Main Category:</div>
                                    <div class="col-md-9 radio-sty">
                                    <label class="rd">Seller
                                        <input type="radio" {{ ( $trader->main_category == "Seller") ? 'checked' : '' }}  name="main_category" value="Seller" required class="main_category">
                                        <span class="checkmark"></span>
                                      </label>
                                      <label class="rd">Service
                                        <input type="radio" {{ ( $trader->main_category == "Service") ? 'checked' : '' }}  name="main_category" value="Service" required class="main_category">
                                        <span class="checkmark"></span>
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Handyman:</div>
                                    <div class="col-md-9 check-sec">
                                        <label class="chk">Yes
                                            <input type="checkbox" name="handyman" value="1" {{ ( $trader->handyman == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Username:</label>
                                    <div class="col-md-9">
                                      <input type="text" value="{{ $trader->username}}" class="form-control-plaintext" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Name:</label>
                                    <div class="col-md-9">
                                      <input type="text" name="name" required value="{{ $trader->name}}" class="form-control-plaintext" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">Email:</label>
                                    <div class="col-md-9">
                                      <input type="email" name="email" required readonly value="{{ $trader->email}}" class="form-control-plaintext" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="web_url" class="col-md-3 col-form-label">Web URL:</label>
                                    <div class="col-md-9">
                                      <input type="text" value="{{ $trader->web_url}}" class="form-control-plaintext" name="web_url" placeholder="Web URL">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-3 col-form-label">Mobile:</label>
                                    <div class="col-md-3">
                                      <select name="country_code" required>
                                        <option value="">Select</option>
                                        @foreach($countries as $k => $country)
                                        <option value="{{ $country->isd_code }}" {{ ($country->isd_code == $trader->country_code)?"selected":"" }}>{{ $country->name }} (+{{ $country->isd_code }})</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" value="{{ $trader->mobile}}" required class="form-control-plaintext" name="mobile" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-9">
                                      <textarea cols="5" class="form-control" name="address" placeholder="Address">{{ $trader->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Is Available:</div>
                                    <div class="col-md-9 check-sec">
                                        <label class="chk">Yes
                                            <input type="checkbox" required name="is_available" value="1" {{ ( $trader->is_available == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Accept Appointments:</div>
                                    <div class="col-md-9 check-sec">
                                        <label class="chk">Yes
                                            <input type="checkbox" name="appointment" value="1" {{ ( $trader->appointment == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-form-label text-right">Reference:</div>
                                    <div class="col-md-9 check-sec">
                                        <label class="chk">Yes
                                            <input type="checkbox" name="reference" value="1" {{ ( $trader->reference == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="available_time" class="col-md-3 col-form-label">Available Time From:</label>
                                    <div class="col-md-5">
                                      <input type="time" value="{{ date('H:i',$trader->available_time_from) }}" class="form-control-plaintext" name="available_time_from" placeholder="Available Time From">
                                    </div>
                                    <div class="col-md-4">
                                      <input type="time" value="{{ date('H:i',$trader->available_time_to) }}" class="form-control-plaintext" name="available_time_to" placeholder="Available Time To">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Service Location Radius (Kms):</label>
                                    <div class="col-md-9">
                                      <input type="number" name="service_location_radius" required value="{{ $trader->service_location_radius}}" class="form-control-plaintext" placeholder="Service Location Radius (Kms)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3 style="display: none;">Location</h3>
                    <fieldset>
                        <legend>Location</legend>
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <div class="form-group row">
                                    <label for="location" class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-8">
                                      <input type="text" required  value="{{ $trader->location }}" class="form-control-plaintext" name="location" placeholder="Location" id="provider-location">
                                      <input type="hidden" name="loc_latitude" value="{{ $trader->loc_latitude }}" id="loc_latitude" />
                                      <input type="hidden" name="loc_longitude" value="{{ $trader->loc_longitude }}" id="loc_longitude" />
                                    </div>
                                    <div class="col-md-1">
                                      <button class="btn btn-xs" style="margin-top: 19px !important;background-color: #fff;" type="button" onclick="getLocation()"><img src="{{ asset('ui/images/postcode.svg') }}" /></button>
                                      <p id="current-location"></p>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="landmark" class="col-md-3 col-form-label">Landmark:</label>
                                    <div class="col-md-9">
                                      <input type="text" required  value="{{ $trader->landmark }}" class="form-control-plaintext" name="landmark" placeholder="Landmark" id="provider-landmark">
                                      <input type="hidden" name="land_latitude" value="{{ $trader->land_latitude }}" id="land_latitude" />
                                      <input type="hidden" name="land_longitude" value="{{ $trader->land_latitude }}" id="land_longitude" />
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="landmark_desc" class="col-md-3 col-form-label">Landmark Description:</label>
                                    <div class="col-md-9">
                                      <input type="text" required  value="{{ $trader->landmark_data }}" class="form-control-plaintext" name="landmark_desc" placeholder="Landmark Description">
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3 style="display: none;">Profile</h3>
                    <fieldset>
                        <legend>Documents</legend>
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <p style="text-align: center;">Currently we are not accepting any documents. Please continu updating your profile.!</p>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <h5>ID Proof</h5>
                                <div class="form-group row">
                                    <input type="hidden" name="proof_type[]" value="ID Proof">
                                    <input type="hidden" name="provider_doc_id[]" value="{{ $trader->providerdocuments[0]->id }}">
                                    <div class="col-md-4">
                                        <select name="id_type[]" class="id_type" {{ ( $trader->providerdocuments[0]->upload_later == 1) ? '' : 'required' }}>
                                            <option value="">Select</option>
                                            <option value="Voter's ID" {{ ($trader->providerdocuments[0]->id_type == "Voter's ID") ? "selected" : "" }}>Voter's ID</option>
                                            <option value="Driving License" {{ ($trader->providerdocuments[0]->id_type == "Driving License") ? "selected" : "" }}>Driving License</option>
                                            <option value="Passport" {{ ($trader->providerdocuments[0]->id_type == "Passport") ? "selected" : "" }}>Passport</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text"  class="form-control-plaintext"  value="{{ $trader->providerdocuments[0]->id_number }}" placeholder="ID Proof Number" name="id_number[]">
                                    </div>
                                    <div class="col-md-4">
                                        @if($trader->providerdocuments[0]->document != "")
                                        <a  class="btn btn-xs btn-success mrg1" href="{{ asset('uploads/providers/documents/'.$trader->providerdocuments[0]->document) }}" target="_blank">View</a>
                                        @endif
                                        <div class="change mrg-sp">
                                        <i class="fa fa-upload"></i>
                                          <input type="file" name="document[]">
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 check-sec">
                                        <label class="chk">Upload Later
                                            <input type="checkbox" class="upload-later" name="upload_later[]" value="1" {{ ( $trader->providerdocuments[0]->upload_later == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                                <h5>Address Proof</h5>
                                <div class="form-group row">
                                    <input type="hidden" name="proof_type[]" value="Address Proof">
                                    <input type="hidden" name="provider_doc_id[]" value="{{ $trader->providerdocuments[1]->id }}">
                                    <div class="col-md-4">
                                        <select name="id_type[]" class="id_type"  {{ ( $trader->providerdocuments[1]->upload_later == 1) ? '' : 'required' }}>
                                            <option value="">Select</option>
                                            <option value="Voter's ID" {{ ($trader->providerdocuments[1]->id_type == "Voter's ID") ? "selected" : "" }}>Voter's ID</option>
                                            <option value="Driving License" {{ ($trader->providerdocuments[1]->id_type == "Driving License") ? "selected" : "" }}>Driving License</option>
                                            <option value="Passport" {{ ($trader->providerdocuments[1]->id_type == "Passport") ? "selected" : "" }}>Passport</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text"  class="form-control-plaintext"  value="{{ $trader->providerdocuments[1]->id_number }}" placeholder="ID Proof Number" name="id_number[]">
                                    </div>
                                    <div class="col-md-4">
                                        @if($trader->providerdocuments[1]->document != "")
                                        <a  class="btn btn-xs btn-success mrg1" href="{{ asset('uploads/providers/documents/'.$trader->providerdocuments[1]->document) }}" target="_blank">View</a>
                                        @endif
                                        <div class="change mrg-sp">
                                        <i class="fa fa-upload"></i>
                                          <input type="file" name="document[]">
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 check-sec">
                                        <label class="chk">Upload Later
                                            <input type="checkbox" class="upload-later" name="upload_later[]" value="1" {{ ( $trader->providerdocuments[1]->upload_later == 1) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                          </label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </fieldset>
                    <h3 style="display: none;">Profile</h3>
                    <fieldset>
                        <legend>Services</legend>
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <?php
                                  if($trader->providercategories) {
                                    $selectedCategories = array();
                                    $selectedSubCategories = array();
                                    foreach ($trader->providercategories as $key => $cat) {
                                      $selectedCategories[] = $cat->category_id;
                                      $selectedSubCategories[] = $cat->sub_category_id;
                                    }
                                  }
                                  ?>
                                <div class="form-group row">
                                <label for="category" class="col-md-3 col-form-label">Category:</label>
                                <div class="col-md-9 multi">
                                    <select class="js-example-basic-multiple parent_category" multiple="multiple" data-placeholder="Select Category">
                                        @foreach ($categories as $key => $value)
                                        <option value="{{ $value->id }}"  {{ (in_array($value->id, $selectedCategories)) ? "selected" : "" }}>{{ $value->category }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="subcategory" class="col-md-3 col-form-label">Sub Category:</label>
                                    <div class="col-md-9 multi">
                                      <select class="js-example-basic-multiple multiple-sub-category" required multiple="multiple" name="category[]" data-placeholder="Select Category">
                                        <option value="">Select</option>
                                        @foreach ($subcategories as $key => $value)
                                        <option value="{{ $value->id }}"  {{ (in_array($value->id, $selectedSubCategories)) ? "selected" : "" }}>{{ $value->category }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <?php
                                  if($trader->providerservices) {
                                    $selectedServices = array();
                                    foreach ($trader->providerservices as $key => $serv) {
                                      $selectedServices[] = $serv->service_id;
                                    }
                                  }
                                  ?>
                                <div class="form-group row">
                                    <label for="service" class="col-md-3 col-form-label">Services:</label>
                                    <div class="col-md-9 multi">
                                      <select class="js-example-basic-multiple services" required multiple="multiple" name="services[]" data-placeholder="Select Services">
                                        <option value="">Select</option>
                                        @foreach ($services as $key => $service)
                                        <option value="{{ $service->id }}" {{ (in_array($service->id, $selectedServices)) ? "selected" : "" }}>{{ $service->service }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </fieldset>
                    <h3 style="display: none;">Profile</h3>
                    <fieldset>
                        <legend>Works</legend>
                        <div class="row">
                            <div class="col-lg-12 account-info m20">
                                <div class="form-group row">
                                    <label for="name" class="col-md-3 col-form-label">Completed Works:</label>
                                    <div class="col-md-9">
                                      <textarea cols="5" class="form-control" name="completed_works" placeholder="Completed Works">{{ $trader->completed_works}}</textarea>
                                    </div>
                                </div>
                                @if(count($trader->providerworks) > 0)
                                <div class="form-group row">
                                    <label for="name1" class="col-md-3 col-form-label">Completed Works Images:</label>
                                    <div class="col-lg-9 images-sec-box">
                                        <div class="row">
                                            @foreach($trader->providerworks as $ke => $work)
                                              <div class="col-md-3">
                                                  <div class="workImg-box">
                                                    <span class="remove delete-completed-works" data-id="{{ $work->id }}"><i class="fa fa-close"></i></span>
                                                    <img style="width: 100%;" src="{{ asset('uploads/providers/works/'.$work->image) }}" class="img-fluid mb-2" alt="Completed Work"/>
                                                  </div>
                                              </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="email" class="col-md-3 col-form-label">Completed Works Images:</label>
                                    <div class="col-md-9">
                                      <div class="change">
                                        <i class="fa fa-upload"></i>
                                          <input type="file" class="image-files1" title="Upload" name="completed_images[]" multiple>
                                      </div>
                                    </div>
                                    <div id="completed-works"></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection