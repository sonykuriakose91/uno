@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Traders') }}</h1>
          </div>
          <div class="col-sm-6">
              <a class="btn btn-success" style="float: right;" href="{{ route('providers.create') }}" title="Create Trader">Add Trader</a>
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
                <h3 class="card-title">{{ __('Traders') }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Handyman</th>
                    <th>Status</th>
                    <th>Documents</th>
                    <th>LoggedIN</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ '+'.$value->country_code .' '. $value->mobile }}</td>
                    <td>{{ $value->type }}</td>
                    <td>{{ ($value->handyman == 1)?"Yes":"No" }}</td>
                    <td>{{ ($value->status == 1)?"Approved":(($value->status == -1)?"Rejected":"Pending") }}</td>
                    <td>
                      {{ $value->providerdocuments[0]->proof_type .' : '}}{{($value->providerdocuments[0]->verified == 1) ? 'Approved' : 'Pending'}}<br>
                      {{ $value->providerdocuments[1]->proof_type .' : '}}{{($value->providerdocuments[1]->verified == 1) ? 'Approved' : 'Pending'}}<br>
                      Reference : {{($value->reference == 1) ? 'Approved' : 'Pending'}}<br>
                    </td>
                    <td>{{ ($value->getuser->loggedIN == 1)?"Yes":"No" }}</td>
                    <td>
                      <form action="{{ route('providers.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('providers.edit',$value->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')    
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Delete</button>
                          <a class="btn btn-xs btn-info" href="{{ route('providers.show',$value->id) }}">View</a>
                          @if($value->status == 0 || $value->status == -1)
                          <a class="btn btn-xs btn-success" onclick="return confirm('Are you sure you want to enable this provider?');" href="{{ route('providers.approve',$value->id) }}">Enable</a>
                          @elseif($value->status == 1)
                          <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to disable this provider?');" href="{{ route('providers.reject',$value->id) }}">Disable</a>
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