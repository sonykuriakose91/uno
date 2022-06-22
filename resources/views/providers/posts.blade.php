@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Trader Posts') }}</h1>
          </div>
          <div class="col-sm-6">
              <a class="btn btn-success" style="float: right;" href="{{ route('traderposts.create') }}" title="Create Trader Post">Add Trader Post</a>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ __('Trader Posts') }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Trader</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Reported</th>
                    <th>Created At</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ isset($value->getprovider->name)?$value->getprovider->name:"" }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ ($value->status == 1)?"Active":"Inactive" }}</td>
                    <td>{{ (count($value->traderpostreports) > 0)?"Yes (".count($value->traderpostreports).")":"No" }}</td>
                    <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                    <td>
                      <form action="{{ route('traderposts.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('traderposts.edit',$value->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                          <a class="btn btn-xs btn-info" href="{{ route('traderposts.view',$value->id) }}">View</a>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection