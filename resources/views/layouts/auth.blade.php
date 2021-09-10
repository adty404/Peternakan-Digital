<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  {{-- Style --}}
  @stack('prepend-style')
  @include('includes.auth.style')
  @stack('addon-style')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  @yield('content')

<!-- Script -->
@stack('prepend-script')
@include('includes.auth.script')
@stack('addon-script')
</body>
</html>
