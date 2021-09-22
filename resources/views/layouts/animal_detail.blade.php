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
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

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
