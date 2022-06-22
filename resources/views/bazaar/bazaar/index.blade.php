@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Bazaar Products') }}</h1>
          </div>
          <div class="col-sm-6">
              <a class="btn btn-success" style="float: right;" href="{{ route('bazaar-products.create') }}" title="Create Trader">Add Bazaar Product</a>
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
                <h3 class="card-title">{{ __('Bazaar Products') }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->product }}</td>
                    <td>{{ $value->category->category }}</td>
                    <td>{{ isset($value->subcategory->category)?$value->subcategory->category:"---" }}</td>
                    <td>{{ ($value->status == 1)?"Approved":(($value->status == -1)?"Rejected":"Pending") }}</td>
                    <td>
                      <form action="{{ route('bazaar-products.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('bazaar-products.edit',$value->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                          <a class="btn btn-xs btn-info" href="{{ route('bazaar-products.show',$value->id) }}">View</a>
                          @if($value->status == 0 || $value->status == -1)
                          <a class="btn btn-xs btn-success" onclick="return confirm('Are you sure you want to enable this product?');" href="{{ route('bazaar-products.approve',$value->id) }}">Enable</a>
                          @elseif($value->status == 1)
                          <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to disable this product?');" href="{{ route('bazaar-products.reject',$value->id) }}">Disable</a>
                          @endif
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