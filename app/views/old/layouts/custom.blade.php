<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <link href="{{ URL::asset('old_res/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('old_res/css/bootstrap-theme.css') }}" rel="stylesheet">
	<script type="text/javascript" src="{{ URL::asset('old_res/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('old_res/js/bootstrap.min.js') }}"></script>

    <title>Signin Template for Bootstrap</title>

    @yield('head')
    
  </head>

  <body>

  	@yield('body')

  </body>
</html>