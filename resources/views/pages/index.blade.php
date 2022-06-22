<?php
use App\Models\Pages;
?>
@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('CMS Pages') }}</h1>
          </div>
          <div class="col-sm-6">
              <a class="btn btn-success" style="float: right;" href="{{ route('pages.create') }}" title="Create CMS Page">Add CMS Page</a>
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
                <h3 class="card-title">{{ __('CMS Pages') }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover data_table">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Page</th>
                    <th>Status</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key => $value)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $page_types["$value->page"] }}</td>
                    <td>{{ ($value->status == 1)?"Approved":(($value->status == -1)?"Rejected":"Pending") }}</td>
                    <td>
                      <form action="{{ route('pages.destroy',$value->id) }}" method="POST">
                          <a class="btn btn-xs btn-primary" href="{{ route('pages.edit',$value->id) }}">Edit</a>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection