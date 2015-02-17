<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
	<title>Students</title>
	<link href="{{ URL::asset('old_res/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('old_res/css/bootstrap-theme.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('old_res/css/style.css') }}" rel="stylesheet">

	<script type="text/javascript" src="{{ URL::asset('old_res/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('old_res/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ URL::to('admin') }}">Project name</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::to('admin/user/') }}">Users</a></li>
					<li><a href="{{ URL::to('admin/skill/') }}">Skills</a></li>
					<li><a href="{{ URL::to('admin/course/') }}">Courses</a></li> 
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="">
					  @if(Auth::check())
					    <a href="{{ URL::to('logout') }}">Logout</a>
					  @else
					    <a href="{{ URL::to('login') }}">Login</a>
					  @endif
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">
		<div class='notifications'>
			{{ Notification::showAll() }}
		</div>

		@yield('content')
		
	</div><!-- /.container -->

	
	

</body>
</html>
