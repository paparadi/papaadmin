<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('staradmin/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('staradmin/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('staradmin/vendors/css/vendor.bundle.addons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('staradmin/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('staradmin/images/favicon.png')}}">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  @yield('head-assests')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('Papaadmin::admin.partials.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('Papaadmin::admin.partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('breadcrumbs')
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('Papaadmin::admin.partials.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('staradmin/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('staradmin/vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('staradmin/js/off-canvas.js')}}"></script>
  <script src="{{asset('staradmin/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('staradmin/js/dashboard.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      console.log("k");
      // Get current page and set current in nav
        $(".nav>li").each(function() {
            var navItem = $(this);
            if (navItem.find("a").attr("href") == location.pathname) {
            navItem.addClass("active");
            }
        });
        $('.btn-cancel').click(function(e){
          e.preventDefault();
          window.history.back();
        });
    });
  </script>
  @yield('body-assests')
  <!-- End custom js for this page-->
</body>

</html>
