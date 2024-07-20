<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/svgviewer-output.ico') }}">
    <link rel="stylesheet" href="laravel\resources\css\styles.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>@yield('title', 'Login Page')</title>
    @yield('style')
  </head>
  <body>
    @yield('bodycontent')
  </body>
 
    @yield('scripts')

</html>