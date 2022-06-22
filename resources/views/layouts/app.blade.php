<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <style>
      .sidebar .os-viewport .os-content-arrange, .sidebar .os-content-glue{display:none}
      .layout-fixed.text-sm .wrapper .sidebar {overflow-x: scroll;}
      .sidebar::-webkit-scrollbar{width: 6px}
      .sidebar .os-padding .os-viewport{overflow-x: inherit !important;}
      .sidebar .os-viewport .os-content{padding: 0px 0px !important;}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper">
@if(Auth::check())
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('uploads/admin/profile/'.Auth::user()->profile_pic) }}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;width:180px;">
          <div class="dropdown-divider"></div>
          <a href="{{ route('profile') }}" class="dropdown-item">
            <i class="fas fa-user"></i> {{ __('Profile') }}
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('changepassword') }}" class="dropdown-item">
            <i class="fas fa-lock"></i> {{ __('Change Password') }}
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <a href="javascript:;" class="brand-link">
      <img src="{{ asset('assets/logo.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Uno Traders</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('uploads/admin/profile/'.Auth::user()->profile_pic) }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link  {{ (request()->is('admin/') || request()->is('admin/home')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('services.index') }}" class="nav-link {{ request()->is('admin/services*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Services</p>
            </a>
          </li>

          <li class="nav-item {{ (request()->is('admin/providers*') || request()->is('admin/trader-posts*') || request()->is('admin/reported-trader-posts*') || request()->is('admin/trader-offers*') || request()->is('admin/reviews*')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ (request()->is('admin/providers*') || request()->is('admin/trader-posts*') || request()->is('admin/trader-offers*') || request()->is('admin/reviews*')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Traders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('providers.index') }}" class="nav-link {{ request()->is('admin/providers*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Traders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('traderposts.index') }}" class="nav-link {{ request()->is('admin/trader-posts*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trader Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('traderpostsreported.index') }}" class="nav-link {{ request()->is('admin/reported-trader-posts*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reported Trader Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('traderoffers.index') }}" class="nav-link {{ request()->is('admin/trader-offers*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trader Offers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reviews.index') }}" class="nav-link {{ request()->is('admin/reviews*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trader Reviews</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('customers.index') }}" class="nav-link {{ request()->is('admin/customers*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>Customers</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->is('admin/appointments*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>Appointments</p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('admin/bazaar-category*') || request()->is('admin/bazaar-products*')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ (request()->is('admin/bazaar-category*') || request()->is('admin/bazaar-products*')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-lightbulb"></i>
              <p>
                Bazaar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('bazaar-category.index') }}" class="nav-link {{ request()->is('admin/bazaar-category*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('bazaar-products.index') }}" class="nav-link {{ request()->is('admin/bazaar-products*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('admin/jobs*')) ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ (request()->is('admin/jobs*')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-network-wired"></i>
              <p>
                Jobs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','draft') }}" class="nav-link {{ request()->is('admin/jobs/status/draft') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft Jobs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','published') }}" class="nav-link {{ request()->is('admin/jobs/status/published') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Published</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','unpublished') }}" class="nav-link {{ request()->is('admin/jobs/status/unpublished') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>UnPublished</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','completed') }}" class="nav-link {{ request()->is('admin/jobs/status/completed') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','seekquote') }}" class="nav-link {{ request()->is('admin/jobs/status/seekquote') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seek Quote</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','accepted') }}" class="nav-link {{ request()->is('admin/jobs/status/accepted') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accepted</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','rejected') }}" class="nav-link {{ request()->is('admin/jobs/status/rejected') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('getjobsbystatus','ongoing') }}" class="nav-link {{ request()->is('admin/jobs/status/ongoing') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ongoing</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('receipts.index') }}" class="nav-link {{ request()->is('admin/receipts*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>Receipts</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('messages.index') }}" class="nav-link {{ request()->is('admin/messages*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Messages</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('diy-help.index') }}" class="nav-link {{ request()->is('admin/diy-help*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>DIY Help</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.index') }}" class="nav-link {{ request()->is('admin/pages*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-file"></i>
              <p>CMS Pages</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('faq.index') }}" class="nav-link {{ request()->is('admin/faq*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-question"></i>
              <p>FAQ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('banners.index') }}" class="nav-link {{ request()->is('admin/banners*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-image"></i>
              <p>Banners</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('ads.index') }}" class="nav-link {{ request()->is('admin/ads*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-images"></i>
              <p>Ad Banners</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('packages.index') }}" class="nav-link {{ request()->is('admin/packages*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-box-open"></i>
              <p>Packages</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('newsletter.index') }}" class="nav-link {{ request()->is('admin/newsletter*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-envelope-open"></i>
              <p>Newsletter Subscription</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-building"></i>
              <p>Settings</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
@endif
 <div class="content-wrapper" @if(!Auth::check()) style="background-color: #fff;" @endif>

  @yield('content')

</div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="javascript:;">Uno Traders</a>.</strong>
    All rights reserved.
  </footer>
</div>

<!-- Scripts -->
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script>
  $(function () {
    $('.data_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(".multiple-sub-category").change(function(){
     var url = "{{ route('category_service') }}";
     var category = $(this).val();
     // $(".services").html("");
     $.post(url, {"_token": "{{ csrf_token() }}","categories":category}, function (data) {
          $(".services").html(data);
     });
  });
  $('.timepicker').datetimepicker({
      format: 'h:mm A'
  });

  $('.datetimepicker').datetimepicker({
      icons: { time: 'far fa-clock' },
      format: 'DD-MM-Y h:mm A',
  });
  
  $('.select2').select2({
      theme: 'bootstrap4'
  });
  $('.textarea').summernote({
    height: 200,
  });
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  });
  $(function () {
    $(".page_type").change(function(){
      var page_type = $(this).val();
      $('#page_contents').summernote("code", "");
      $.get("" +'./pagedetails/' + page_type, function (data) {
          $('#page_title').val(data.title);
          $('#page_contents').summernote("code", data.contents);
          if(data.status == 1) {
            $("#page_status").attr("checked","checked");
          } else {
            $("#page_status").removeAttr("checked");
          }
      });
    });
  });

  $(function() {
    $(".main_category").click(function(){
      var maincategory = $(this).val();
      $(".parent_category").html('');
      $(".multiple-sub-category").html('');
      $.post("{{ route('getsubcategory') }}", {"_token": "{{ csrf_token() }}","maincategory":maincategory}, function (data) {
        $(".parent_category").html(data);
      });
    });
  });

  $(function() {
    $(".category").change(function(){
      var category = $(this).val();
      $.post("{{ route('subcategorylist') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $(".sub_category").html(data);
      });
    });
  });

  $(function() {
    $(".parent_category").change(function(){
      var category = $(this).val();
      $(".multiple-sub-category").html('');
      $.post("{{ route('subcategories') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $(".multiple-sub-category").html(data);
      });
    });
  });

  $(function() {
    $(".bazaar_parent_category").change(function(){
      var category = $(this).val();
      $(".bazaar-sub-category").html('');
      $.post("{{ route('getbazaarsubcategory') }}", {"_token": "{{ csrf_token() }}","category":category}, function (data) {
        $(".bazaar-sub-category").html(data);
      });
    });
  });

  $(function () {
    rowhtml = $('#service_locations').find('tbody tr:last-child()').html();
      $('body').on('click', '.add_row_location', function() {
        $(this).closest("tr").find(".add_row_location").addClass("remove_row_location").removeClass("add_row_location");
        $(this).closest("tr").find(".remove_row_location").addClass("btn-danger").removeClass("btn-primary");
        $(this).closest("tr").find(".remove_row_location").text("Remove");
        row = $('#lasttr_location').after('<tr class="newtr_location">' + rowhtml + '</tr>');
        $('#service_locations').find('#lasttr_location').attr("id","");
        $(".newtr_location").attr("id","lasttr_location");
        $(".newtr_location").attr("class","");
    });
      $('body').on('click', '.remove_row_location', function() {
        $(this).closest("tr").remove();
      });
  });

  $(function() {
    $('body').on('keyup', '.service_location', function() {
      var thisele = $(this);
      var autocomplete = new google.maps.places.Autocomplete($(this)[0], {}); 
      google.maps.event.addListener(autocomplete, 'place_changed', function() {
          var place = autocomplete.getPlace();
          var lat = place.geometry.location.lat();
          var long = place.geometry.location.lng();
          thisele.next('.service_loc_latitude').val(lat);
          thisele.next().next('.service_loc_longitude').val(long);
      });
    });
  });

  $(function() {
    $(".service_loc").click(function(){
      var provider_id = $(this).attr("data-provider-id");
      var service_id = $(this).attr("data-service-id");
      $.post("{{ route('provider_service_locations') }}", {"_token": "{{ csrf_token() }}","provider_id":provider_id,"service_id":service_id}, function (data) {
        $("#service-locations").html(data);
        $("#myModal").modal();
      });
    });
    $('body').on('click', '.change_service_loc_status', function() {
      var thisloc = $(this);
      var service_loc_id = $(this).attr("data-id");
      var type = $(this).attr("data-type");
      $.post("{{ route('change_service_locations') }}", {"_token": "{{ csrf_token() }}","service_loc_id":service_loc_id,"type":type}, function (data) {
        if(data == 1) {
          thisloc.removeClass("btn-primary").addClass("btn-danger");
          thisloc.attr("data-type","disable");
          thisloc.text("Disable");
          thisloc.parent().prev("td").text("Approved");
        } else if(data == -1) {
          thisloc.removeClass("btn-danger").addClass("btn-primary");
          thisloc.attr("data-type","enable");
          thisloc.text("Enable");
          thisloc.parent().prev("td").text("Rejected");
        }
      });
    });
  });
</script>
 @if ($message = Session::get('success'))
 <script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      Toast.fire({
        icon: 'success',
        title: '<?= $message ?>'
      });
  });
  </script>
  @endif
   @if ($message = Session::get('danger'))
 <script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
      Toast.fire({
        icon: 'error',
        title: '<?= $message ?>'
      });
  });
  </script>
  @endif
@if(request()->is('admin/providers/create') || request()->is('admin/providers/*/edit'))
<script src = "https://maps.googleapis.com/maps/api/js?key={{ config('site_settings')->google_map_api }}&libraries=places&callback=initMap" async defer></script>
<script>
  function initMap() {
    var autocomplete = new google.maps.places.Autocomplete($("#provider-location")[0], {}); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#loc_latitude').val(lat);
        $('#loc_longitude').val(long);

    });
    var autocomplete1 = new google.maps.places.Autocomplete($("#provider-landmark")[0], {}); 
    google.maps.event.addListener(autocomplete1, 'place_changed', function() {
        var place = autocomplete1.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#land_latitude').val(lat);
        $('#land_longitude').val(long);

    });
}
</script>
@endif
@if(request()->is('admin/customers/create') || request()->is('admin/customers/*/edit'))
<script src = "https://maps.googleapis.com/maps/api/js?key={{ config('site_settings')->google_map_api }}&libraries=places&callback=initMap" async defer></script>
<script>
  function initMap() {
    var autocomplete = new google.maps.places.Autocomplete($("#customer-location")[0], {}); 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('#loc_latitude').val(lat);
        $('#loc_longitude').val(long);

    });
}
</script>
@endif
<script>
  $(document).ready(function(){
        $(".register-username").change(function(){
            var username = $(this).val();
            $.post("{{ route('check-username') }}", {"_token": "{{ csrf_token() }}", "username": username}, function (data) {
                $(".username-error").text('');
                $(".username-success").text('Username is available');
            }).fail(function(data) {
                $(".username-success").text('');
                $(".username-error").text(jQuery.parseJSON(data.responseText).errors.username);
            });
        });
    });
  </script>
</body>
</html>