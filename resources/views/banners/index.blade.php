@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Banners') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <a class="btn btn-success" style="float: right;" href="{{ route('banners.create') }}" title="Create Review">Add Banner</a>
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
                <h3 class="card-title">{{ __('Banners') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->link }}</td>
                    <td>{{ ($value->status == 1)?"Approved":(($value->status == -1)?"Rejected":"Pending") }}</td>
                    <td>
                      <form action="{{ route('banners.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('banners.edit',$value->id) }}">Edit</a>
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