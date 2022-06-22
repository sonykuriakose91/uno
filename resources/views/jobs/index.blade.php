@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Jobs') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <!-- <a class="btn btn-success" style="float: right;" href="" title="Create Category">Add Job</a> -->
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
                <h3 class="card-title">{{ __('Jobs') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Job Title</th>
                    <th>Job Completion Time</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ ($value->user_type == "provider")?$value->getprovider->name:$value->getcustomer->name }} </td>
                    <td>{{ isset($value->getcategory->category)?$value->getcategory->category:"---" }}</td>
                    <td>{{ isset($value->getsubcategory->category)?$value->getsubcategory->category:"---" }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->job_completion }}</td>
                    <td>{{ $value->job_status }}</td>
                    <td>{{ date('d-m-Y h:i A',strtotime($value->created_at)) }}</td>
                    <td>
                      <form action="{{ route('jobs.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-info" href="{{ route('jobs.show',$value->id) }}">View</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                      </form>
                    </td>
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