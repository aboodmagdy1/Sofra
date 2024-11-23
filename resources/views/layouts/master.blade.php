<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.head')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    
<div class="wrapper">

  @include('includes.nav-bar') 

  @include('includes.side-bar')

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!--  (Page header) -->
    @include('includes.header-bar')
   
    <!-- Main content -->
    @yield('content')
<!-- /.content -->
  </div>

  @include('includes.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

@include('includes.footer-scripts')
</body>
</html>
