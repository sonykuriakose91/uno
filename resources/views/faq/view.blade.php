@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Faq - ') }} {{ $data->id }}</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
          	<a class="btn btn-sm btn-info" href="{{ route('faq.edit',$data->id) }}">Update</a>
            @if($data->status == 0)
            <a class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to enable this faq?');" href="{{ route('faq.approve',$data->id) }}">Enable</a>
            @elseif($data->status == 1)
            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to disable this faq?');" href="{{ route('faq.reject',$data->id) }}">Disable</a>
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
                <h3 class="card-title">{{ __('Faq - ') }} {{ $data->id }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                  <tr>
                  	<td>ID</td>
                  	<td>{{ $data->id }}</td>
                  </tr>
                  <tr>
                  	<td>Question</td>
                  	<td>{{ $data->question }}</td>
                  </tr>
                  <tr>
                  	<td>Answer</td>
                  	<td>{!! $data->answer !!}</td>
                  </tr>
                  <tr>
                  	<td>Status</td>
                  	<td>{{ ($data->status == 1)?"Approved":"Pending" }}</td>
                  </tr>
	              </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection