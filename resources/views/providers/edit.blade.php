@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Trader - ') }}{{ $data->name }}</h1>
          </div>
        </div>
      </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Edit Trader - ') }}{{ $data->name }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('providers.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="type" required>
                        <option value="">Select</option>
                        <option value="Company" {{ ( $data->type == "Company") ? 'selected' : '' }}>{{ __('Company') }}</option>
                        <option value="Individual" {{ ( $data->type == "Individual") ? 'selected' : '' }}>{{ __('Individual') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Main Category</label>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" {{ ( $data->main_category == "Seller") ? 'checked' : '' }} required type="radio" id="customRadio1" name="main_category" value="Seller">
                        <label for="customRadio1" class="custom-control-label">Seller</label>
                    </div>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" {{ ( $data->main_category == "Service") ? 'checked' : '' }} required type="radio" id="customRadio2" name="main_category" value="Service">
                        <label for="customRadio2" class="custom-control-label">Service</label>
                    </div>
                  </div> 
                  <?php
                  if($data->providercategories) {
                    $selectedCategories = array();
                    $selectedSubCategories = array();
                    foreach ($data->providercategories as $key => $cat) {
                      $selectedCategories[] = $cat->category_id;
                      $selectedSubCategories[] = $cat->sub_category_id;
                    }
                  }
                  ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 parent_category" required multiple="multiple" data-placeholder="Select Category">
                        <option value="">Select</option>
                        @foreach ($categories as $key => $value)
                        <option value="{{ $value->id }}"  {{ (in_array($value->id, $selectedCategories)) ? "selected" : "" }}>{{ $value->category }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 multiple-sub-category" required multiple="multiple" name="category[]" data-placeholder="Select Category">
                        <option value="">Select</option>
                        @foreach ($subcategories as $key => $value)
                        <option value="{{ $value->id }}"  {{ (in_array($value->id, $selectedSubCategories)) ? "selected" : "" }}>{{ $value->category }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Handyman</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="handyman" value="1" {{ ( $data->handyman == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" required readonly value="{{ $data->username }}" class="form-control" placeholder="Username" name="username">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->name }}" class="form-control" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required value="{{ $data->email }}" class="form-control" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Web URL</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ $data->web_url }}" class="form-control" placeholder="Web URL" name="web_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="country_code" required>
                        <option value="">Select</option>
                        @foreach($countries as $k => $country)
                        <option value="{{ $country->isd_code }}" {{ ( $country->isd_code == $data->country_code) ? 'selected' : '' }}>{{ $country->name }} (+{{ $country->isd_code }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-8">
                      <input type="text" required value="{{ $data->mobile }}" class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Address" name="address" cols="5">{{ $data->address }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="location" value="{{ $data->location }}" placeholder="Location" id="provider-location">
                      <input type="hidden" name="loc_latitude" value="{{ $data->loc_latitude }}" id="loc_latitude" />
                      <input type="hidden" name="loc_longitude" value="{{ $data->loc_longitude }}" id="loc_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Landmark</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ $data->landmark }}"  name="landmark" placeholder="Landmark" id="provider-landmark">
                      <input type="hidden" name="land_latitude" value="{{ $data->land_latitude }}" id="land_latitude" />
                      <input type="hidden" name="land_longitude" value="{{ $data->land_latitude }}" id="land_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Landmark Description</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ $data->landmark_data }}" name="landmark_desc" placeholder="Landmark Description">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Available Time From</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="available_time_from" value="{{ date('h:i A',$data->available_time_from) }}" placeholder="Available Time From" required class="form-control datetimepicker-input timepicker" data-toggle="datetimepicker"/>
                    </div>
                    <label class="col-sm-2 col-form-label">Available Time To</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="available_time_to" value="{{ date('h:i A',$data->available_time_to) }}" placeholder="Available Time To" required class="form-control datetimepicker-input timepicker" data-toggle="datetimepicker"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Is Available</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_available" value="1" {{ ( $data->is_available == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Accept Appointments</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="appointment" value="1" {{ ( $data->appointment == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profile Image</label>
                    <div class="col-sm-10">
                      <img style="width: 20%;" src="{{ asset('uploads/providers/profile/'.$data->profile_pic) }}" class="img-fluid mb-2" alt="Profile Pic"/>
                      <div class="clearfix"></div>
                      <input type="file" name="profile_image">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" {{ ( $data->status == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Featured</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="featured" value="1" {{ ( $data->featured == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Proof</label>
                    <input type="hidden" name="proof_type[]" value="ID Proof">
                    <input type="hidden" name="provider_doc_id[]" value="{{ $data->providerdocuments[0]->id }}">
                    <div class="col-sm-2">
                      <select class="form-control" name="id_type[]">
                        <option value="">Select Type</option>
                        <option value="Aadhar Card" {{ ($data->providerdocuments[0]->id_type == "Aadhar Card") ? "selected" : "" }}>Aadhar Card</option>
                        <option value="Voter's ID" {{ ($data->providerdocuments[0]->id_type == "Voter's ID") ? "selected" : "" }}>Voter's ID</option>
                        <option value="Driving License" {{ ($data->providerdocuments[0]->id_type == "Driving License") ? "selected" : "" }}>Driving License</option>
                        <option value="Passport" {{ ($data->providerdocuments[0]->id_type == "Passport") ? "selected" : "" }}>Passport</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" value="{{ $data->providerdocuments[0]->id_number }}" placeholder="ID Proof Number" name="id_number[]">
                    </div>
                    <div class="col-sm-3">
                      <a href="{{ asset('uploads/providers/documents/'.$data->providerdocuments[0]->document) }}" target="_blank">{{ $data->providerdocuments[0]->document }}</a>
                      <input type="file" name="document[]">
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="verified[]" value="1" {{ ($data->providerdocuments[0]->verified == 1) ? "checked" : "" }}>
                        <label class="form-check-label">Verified</label>
                      @if($data->providerdocuments[0]->status == -1)
                      <p class="text-danger">Rejected</p>
                      @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address Proof</label>
                    <input type="hidden" name="proof_type[]" value="Address Proof">
                    <input type="hidden" name="provider_doc_id[]" value="{{ $data->providerdocuments[1]->id }}">
                    <div class="col-sm-2">
                      <select class="form-control" name="id_type[]">
                        <option value="">Select Type</option>
                        <option value="Aadhar Card" {{ ($data->providerdocuments[1]->id_type == "Aadhar Card") ? "selected" : "" }}>Aadhar Card</option>
                        <option value="Voter's ID" {{ ($data->providerdocuments[1]->id_type == "Voter's ID") ? "selected" : "" }}>Voter's ID</option>
                        <option value="Driving License" {{ ($data->providerdocuments[1]->id_type == "Driving License") ? "selected" : "" }}>Driving License</option>
                        <option value="Passport" {{ ($data->providerdocuments[1]->id_type == "Passport") ? "selected" : "" }}>Passport</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" value="{{ $data->providerdocuments[1]->id_number }}" placeholder="Address Proof Number" name="id_number[]">
                    </div>
                    <div class="col-sm-3">
                      <a href="{{ asset('uploads/providers/documents/'.$data->providerdocuments[1]->document) }}" target="_blank">{{ $data->providerdocuments[1]->document }}</a>
                      <input type="file" name="document[]">
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="verified[]" value="1" {{ ($data->providerdocuments[1]->verified == 1) ? "checked" : "" }}>
                        <label class="form-check-label">Verified</label>
                      @if($data->providerdocuments[1]->status == -1)
                      <p class="text-danger">Rejected</p>
                      @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reference</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="reference" value="1" {{ ( $data->reference == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Verified</label>
                      </div>
                    </div>
                  </div>
                  <?php
                  if($data->providerservices) {
                    $selectedServices = array();
                    foreach ($data->providerservices as $key => $serv) {
                      $selectedServices[] = $serv->service_id;
                    }
                  }
                  ?>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Services</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 services" required data-placeholder="Select Services" multiple="multiple" name="services[]">
                        <option value="">Select Type</option>
                        @foreach ($services as $key => $service)
                        <option value="{{ $service->id }}" {{ (in_array($service->id, $selectedServices)) ? "selected" : "" }}>{{ $service->service }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Service Location Radius (Kms)</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ ($data->service_location_radius) }}" placeholder="Service Location Radius (Kms)" name="service_location_radius">
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Completed Works</label>
                    <div class="col-sm-10">
                      <textarea class="form-control textarea" placeholder="Completed Works" name="completed_works"> {{ ($data->completed_works) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Completed Works Images</label>
                    @if($data->providerworks)
                    <div class="col-sm-10"> 
                      <div class="row"> 
                        @foreach($data->providerworks as $ke => $work)
                          <div class="col-md-2">
                            <input type="checkbox" name="removeImg[]" value="{{ $work->id }}"> Remove
                                <img src="{{ asset('uploads/providers/works/'.$work->image) }}" class="img-fluid mb-2" alt="Completed Work"/>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Completed Works Images</label>
                    <div class="col-sm-10">
                      <input type="file" name="completed_images[]" multiple>
                    </div>
                </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection