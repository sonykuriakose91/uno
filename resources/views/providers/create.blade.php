@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Add Trader') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Add Trader') }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form class="form-horizontal" autocomplete="off" action="{{ route('providers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="type" required>
                        <option value="">Select</option>
                        <option value="Company">{{ __('Company') }}</option>
                        <option value="Individual">{{ __('Individual') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Main Category</label>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio1" name="main_category" value="Seller">
                        <label for="customRadio1" class="custom-control-label">Seller</label>
                    </div>
                    <div class="col-sm-1 custom-control custom-radio">
                        <input class="custom-control-input main_category" required type="radio" id="customRadio2" name="main_category" value="Service">
                        <label for="customRadio2" class="custom-control-label">Service</label>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 parent_category" required multiple="multiple" data-placeholder="Select Category">
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub Category</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 multiple-sub-category" required multiple="multiple" name="category[]" data-placeholder="Select Category">
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Handyman</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="handyman" value="1" checked="checked">
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control register-username" placeholder="Username" name="username">
                      <div class="username-error" style="color: #f20505;"></div>
                      <div class="username-success" style="color: #49b138;"></div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" placeholder="Name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" required class="form-control" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Web URL</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Web URL" name="web_url">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-2">
                      <select class="form-control" name="country_code" required>
                        <option value="">Select</option>
                        @foreach($countries as $k => $country)
                        <option value="{{ $country->isd_code }}">{{ $country->name }} (+{{ $country->isd_code }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-8">
                      <input type="text" required class="form-control" placeholder="Mobile" name="mobile">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" placeholder="Address" name="address" cols="5"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="location" placeholder="Location" id="provider-location">
                      <input type="hidden" name="loc_latitude" id="loc_latitude" />
                      <input type="hidden" name="loc_longitude" id="loc_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Landmark</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="landmark" placeholder="Landmark" id="provider-landmark">
                      <input type="hidden" name="land_latitude" id="land_latitude" />
                      <input type="hidden" name="land_longitude" id="land_longitude" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Landmark Description</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" name="landmark_desc" placeholder="Landmark Description">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Available Time From</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="available_time_from" placeholder="Available Time From" required class="form-control datetimepicker-input timepicker" data-toggle="datetimepicker"/>
                    </div>
                    <label class="col-sm-2 col-form-label">Available Time To</label>
                    <div class="col-sm-4 input-group date" data-target-input="nearest">
                      <input type="text" name="available_time_to" placeholder="Available Time To" required class="form-control datetimepicker-input timepicker" data-toggle="datetimepicker"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Is Available</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_available" value="1" checked="checked">
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Accept Appointments</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="appointment" value="1" checked="checked">
                        <label class="form-check-label">Yes</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profile Image</label>
                    <div class="col-sm-10">
                      <input type="file" required name="profile_image">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" checked="checked">
                        <label class="form-check-label">Active</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Featured</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="featured" value="1">
                        <label class="form-check-label">Featured</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Proof</label>
                    <input type="hidden" name="proof_type[]" value="ID Proof">
                    <div class="col-sm-2">
                      <select class="form-control" name="id_type[]">
                        <option value="">Select Type</option>
                        <option value="Aadhar Card">Aadhar Card</option>
                        <option value="Voter's ID">Voter's ID</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Passport">Passport</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="ID Proof Number" name="id_number[]">
                    </div>
                    <div class="col-sm-3">
                      <input type="file" name="document[]">
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="verified[]" value="1">
                        <label class="form-check-label">Verified</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address Proof</label>
                    <input type="hidden" name="proof_type[]" value="Address Proof">
                    <div class="col-sm-2">
                      <select class="form-control" name="id_type[]">
                        <option value="">Select Type</option>
                        <option value="Aadhar Card">Aadhar Card</option>
                        <option value="Voter's ID">Voter's ID</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Passport">Passport</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" placeholder="Address Proof Number" name="id_number[]">
                    </div>
                    <div class="col-sm-3">
                      <input type="file" name="document[]">
                    </div>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="verified[]" value="1">
                        <label class="form-check-label">Verified</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reference</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="reference" value="1">
                        <label class="form-check-label">Verified</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Services</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 services" required multiple="multiple" name="services[]" data-placeholder="Select Services">
                      </select>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Service Locations</label>
                    <div class="col-sm-10">
                      <table class="table table-bordered" id="service_locations">
                        <thead>
                        <th>Location</th>
                        <th>#</th>
                        </thead>
                        <tbody>
                            <tr id="lasttr_location">
                                <td>
                                    <input type="text" required class="form-control service_location" placeholder="Location" name="service_location[]" />
                                    <input type="hidden" name="service_loc_latitude[]" class="service_loc_latitude" />
                                    <input type="hidden" name="service_loc_longitude[]" class="service_loc_longitude" />
                                </td>
                                <td>
                                  <button class="btn-primary btn btn-sm pull-right add_row_location" type="button">Add</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                  </div> -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Service Location Radius (Kms)</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" placeholder="Service Location Radius (Kms)" name="service_location_radius">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Completed Works</label>
                      <div class="col-sm-10">
                        <textarea class="form-control textarea" placeholder="Completed Works" name="completed_works"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Completed Works Images</label>
                      <div class="col-sm-10">
                        <input type="file" name="completed_images[]" multiple>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection