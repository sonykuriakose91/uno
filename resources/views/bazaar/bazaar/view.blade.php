@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Product - ') }} {{ $data->product }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('bazaar-products.edit',$data->id) }}">Update</a>
            @if($data->status == 0 || $data->status == -1)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this product?');" href="{{ route('bazaar-products.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this product?');" href="{{ route('bazaar-products.reject',$data->id) }}">Disable</a>
            @endif
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
                <h3 class="card-title">{{ __('Trader - ') }} {{ $data->product }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                    <td>Category</td>
                    <td>{{ $data->category->category }}</td>
                  </tr>
                  <tr>
                  	<td>Sub Category</td>
                  	<td>{{ isset($data->subcategory->category)?$data->subcategory->category:"" }}</td>
                  </tr>
                  <tr>
                  	<td>Product</td>
                  	<td>{{ $data->product }}</td>
                  </tr>
                  <tr>
                  	<td>Description</td>
                  	<td>{!! html_entity_decode($data->description) !!}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":(($data->status == -1)?"Rejected":"Pending") }}</td>
                  </tr>
	              </tbody>
                </table>
                <h5>Product Images</h5>
                <table class="table table-bordered table-hover">
                	<tbody>
                		@if($data->bazaarimages)
                			<tr>
                				<div class="row">
                				@foreach($data->bazaarimages as $ke => $image)
	                				<div class="col-md-2">
	                					<a href="{{ asset('uploads/bazaar/products/'.$image->product_image) }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
				                      	<img src="{{ asset('uploads/bazaar/products/'.$image->product_image) }}" class="img-fluid mb-2" alt="Product"/>
			                    	</a>
	                				</div>
                				@endforeach
	                			</div>
                			</tr>
                		@endif
                	</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection