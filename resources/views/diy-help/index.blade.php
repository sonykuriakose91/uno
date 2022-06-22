@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('DIY Help') }}</h1>
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
                <h3 class="card-title">{{ __('DIY Help') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>User Type</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ ucfirst($value->user_type) }} </td>
                    <td>{{ ($value->user_type == "trader")?$value->getprovider->name:$value->getuser->name }} </td>
                    <td>{{ $value->title }}</td>
                    <td>{{ count($value->diyhelpcommentsall) }}</td>
                    <td>{{ ($value->status == 0)?"Inactive":"Active" }}</td>
                    <td>
                        <a class="btn btn-xs btn-info" href="{{ route('diy-help.show',$value->id) }}">View</a>
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