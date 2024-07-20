<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login Page')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/svgviewer-output.ico') }}">
    <link rel="stylesheet" href="laravel\resources\css\listview_style.css">
    <link rel="stylesheet" href="laravel\resources\css\styles-sidebar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @yield('style')
  </head>
  <body>
    <div class="full-screen">
    @yield('sidebar-content')
      <div class="half-screen">
      @yield('header')
      @yield('listview')
      </div>
    </div>
  </body>
    @yield('scripts')
</html>