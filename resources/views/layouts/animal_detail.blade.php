<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  {{-- Style --}}
  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
</head>
<body>

  <!-- Preloader -->

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <div class="text-center m-3">
    &copy; {{ date('Y') }} <a target="_blank" href="https://github.com/adty404/">Aditya Prasetyo</a>
</div>

<!-- ./wrapper -->

<!-- Script -->
@stack('prepend-script')
@include('includes.admin.script')
@stack('addon-script')
</body>
</html>
