@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Reviews') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <!-- <a class="btn btn-success" style="float: right;" href="{{ route('reviews.create') }}" title="Create Review">Add Review</a> -->
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
                <h3 class="card-title">{{ __('Reviews') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>User</th>
                    <th>Service</th>
                    <th>Provider</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <?php 
                      $score = 0;
                      $score = $value->reliability+$value->tidiness+$value->response+$value->accuracy+$value->pricing;
                  ?>
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ isset($value->getuser->name)?$value->getuser->name:"" }}</td>
                    <td>{{ isset($value->getservice->service)?$value->getservice->service:"" }}</td>
                    <td>{{ isset($value->getprovider->name)?$value->getprovider->name:"" }}</td>
                    <td>{{ number_format(($score*2)/5,2) }}</td>
                    <td>{{ ($value->status == 1)?"Approved":(($value->status == -1)?"Rejected":"Pending") }}</td>
                    <td>
                      <form action="{{ route('reviews.destroy',$value->id) }}" method="POST">
                          <!-- <a class="btn btn-xs btn-primary" href="{{ route('reviews.edit',$value->id) }}">Edit</a> -->
                          <a class="btn btn-xs btn-info" href="{{ route('reviews.show',$value->id) }}">View</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                          @if($value->status == 0 || $value->status == -1)
                          <a class="btn btn-xs btn-success" onclick="return confirm('Are you sure you want to approve this review?');" href="{{ route('reviews.approve',$value->id) }}">Approve</a>
                          @elseif($value->status == 1)
                          <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to reject this review?');" href="{{ route('reviews.reject',$value->id) }}">Reject</a>
                          @endif
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