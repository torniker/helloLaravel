<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
	<title>Project</title>
	<link href="{{ URL::asset('res/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/bootstrap-theme.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/style.css') }}" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="{{ URL::asset('res/js/bootstrap.min.js') }}"></script>
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
				<a class="navbar-brand" href="{{ URL::to('/freelancer') }}">Project name</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					 <ul class="nav navbar-nav pull-right">
					 <li><a href="{{ URL::to('freelancer/projects') }}">All Projects</a></li>
					 <li><a href="{{ URL::to('freelancer/projects/my') }}">My Projects</a></li>
					 <li><a href="{{ URL::to('freelancer/profile') }}">Profile</a></li>
					 <li><a href="{{ URL::to('freelancer/offers') }}">My Offers</a></li> 
		                <li class="">
		                  @if(Auth::check())
		                    <a href="{{ URL::to('logout') }}">Logout</a>
		                  @else
		                    <a href="{{ URL::to('login') }}">Login</a>
		                  @endif
		                </li>
		              </ul>
				</ul>
				<div class='pull-right label label-xs label-success margin-sm-top'>Hello, {{ Auth::user()->firstname }}!</div>
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
