@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Receipts') }}</h1>
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
                <h3 class="card-title">{{ __('Receipts') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>User</th>
                    <th>User Type</th>
                    <th>Title</th>
                    <th>Remarks</th>
                    <th>Receipt</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ ($value->user_type == "provider")?$value->gettrader->name:$value->getcustomer->name }} </td>
                    <td>{{ ($value->user_type == "provider")?"Trader":"Customer" }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->remarks }}</td>
                    <td>
                      <a href="{{ asset('uploads/receipts/'.$value->receipt_image) }}" target="_blank">{{ $value->receipt_image }}</a>
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