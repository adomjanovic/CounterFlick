<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Counter Flick</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{{ asset('public/favicon.ico') }}}">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('/public/css/style.css')}}" rel="stylesheet">
  </head>
  <body>
    @include('layouts.header')
    <div class="container">
        @yield('content')
    </div><!-- /.container -->
    @include('layouts.footer')
  </body>
</html>
