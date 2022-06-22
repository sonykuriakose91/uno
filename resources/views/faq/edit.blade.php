@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit Faq - ') }}{{ $data->id }}</h1>
          </div>
        </div>
      </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Edit Faq') }}{{ $data->id }}</h3>
              </div>
              <form class="form-horizontal" action="{{ route('faq.update',$data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                      <input type="text" required value="{{ $data->question }}" class="form-control" placeholder="Question" name="question">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Answer</label>
                    <div class="col-sm-10">
                      <textarea class="form-control textarea" placeholder="Answer" required name="answer">{{ $data->answer }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status" value="1" {{ ( $data->status == 1) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection