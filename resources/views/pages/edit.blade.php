@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Edit CMS Page') }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ __('Edit CMS Page') }}</h3>
              </div>
              
              <form class="form-horizontal" action="{{ route('pages.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Page</label>
                    <div class="col-sm-10">
                      <select class="form-control page_type" name="page_type" required>
                        <option value="">Select</option>
                        @foreach($page_types as $key => $page_type)
                        <option value="{{ $key }}" {{ ( $key == $data->page) ? 'selected' : '' }}>{{ $page_type }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input type="text" required class="form-control" value="{{ $data->title }}" id="page_title" placeholder="Title" name="title">
                    </div>
                  </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Contents</label>
                    <div class="col-sm-10">
                      <textarea class="form-control textarea" id="page_contents" placeholder="Contents" name="contents">{{ $data->contents }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input type="checkbox" id="page_status" class="form-check-input" name="status" value="1" {{ ($data->status == 1) ? "checked" : ""}}>
                      <label class="form-check-label">Active</label>
                    </div>
                  </div>
                </div>                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  @endsection