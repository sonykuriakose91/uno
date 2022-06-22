@extends('layouts.app')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Dashboard') }}</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $traders_count }}</h3>

                <p>Traders</p>
              </div>
              <div class="icon">
                <i class="ion ion-briefcase"></i>
              </div>
              <a href="{{ route('providers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $customers_count }}</h3>

                <p>Customers</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $bazaar }}</h3>

                <p>Bazaar Products</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{ route('bazaar-products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $jobs }}</h3>

                <p>Jobs</p>
              </div>
              <div class="icon">
                <i class="fas fa-network-wired"></i>
              </div>
              <a href="{{ route('getjobsbystatus','published') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>
@endsection