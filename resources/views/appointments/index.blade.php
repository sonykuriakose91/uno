@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Appointments') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('Appointments') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Customer</th>
                    <th>Trader</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <!-- <th>#</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ isset($value->getuser->name)?$value->getuser->name:"" }} </td>
                    <td>{{ isset($value->gettrader->name)?$value->gettrader->name:"" }}</td>
                    <td>{{ date('d-m-Y',strtotime($value->appointment_date)) }}</td>
                    <td>{{ date('h:i A',strtotime($value->appointment_time)) }}</td>
                    <td>{{ $value->status }}</td>
                    <!-- <td>
                      <form action="{{ route('categories.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('categories.edit',$value->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                      </form>
                    </td> -->
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  @endsection