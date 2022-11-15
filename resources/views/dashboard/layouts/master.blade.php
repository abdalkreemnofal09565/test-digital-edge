<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- bootstrap css -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/bootstrap/bootstrap5.min.css')}}" >
  <!-- bootstrap icons css -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/bootstrap/bootstrap-icons.css')}}">


  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/summernote/summernote-lite.min.css')}}">

  <!-- data tables -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/datatables/datatables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/datatables/fixedHeader.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/datatables/responsive.bootstrap.min.css')}}">

  
  <!-- file input -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/file-input/file-input.css')}}">

  <!-- map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  
  <!-- admin lte style -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/adminlte.min.css')}}">   

  <link href="{{asset('assets/dashboard/plugins/select2/select2.min.css')}}" rel="stylesheet" />


  <!-- custom css styles -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/custom.css')}}">   

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('dashboard.includes.navbar')
    @include('dashboard.includes.sidebar')

    @yield('contents')

    @include('dashboard.includes.control-sidebar')
    @include('dashboard.includes.footer')
</div>

<script src="{{asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>


<script>
  $(function () {
    var url = $(location).attr('href').split("/").splice(0, 5).join("/");

    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
});
</script>

<!-- summernote -->
<script src="{{asset('assets/dashboard/plugins/summernote/summernote-lite.min.js')}}"></script>

<!-- datatabels -->  
<script src="{{asset('assets/dashboard/plugins/datatables/jquery.validate.1.19.0.js')}}"></script> 
<script src="{{asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('assets/dashboard/plugins/datatables/datatables.bootstrap5.min.js')}}"></script> 
<script src="{{asset('assets/dashboard/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/datatables/responsive.bootstrap.min.js')}}"></script>

<script src="{{asset('assets/dashboard/plugins/bootstrap/bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/bootstrap/bootstrap5.bundle.min.js')}}"></script>

<!-- map -->
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<script src="{{asset('assets/dashboard/plugins/map/map.js')}}"></script>


<!-- admin lte -->
<script src="{{asset('assets/dashboard/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/dashboard/dist/js/demo.js')}}"></script>

<!-- select 2 -->
<script src="{{asset('assets/dashboard/plugins/select2/select2.min.js')}}"></script>

<!-- file input -->
<script src="{{asset('assets/dashboard/plugins/file-input/file-input.js')}}"></script> 

<!-- custom css styles -->
<script src="{{asset('assets/dashboard/dist/js/custom.js')}}"></script>

<!-- scripts stack -->
@stack('scripts')


</body>
</html>
