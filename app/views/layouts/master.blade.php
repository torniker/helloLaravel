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
	<link href="{{ URL::asset('res/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/bootstrap-theme.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/global.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/fonts.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/pretty/skins/all.css') }}" rel="stylesheet">
	<script src="{{ URL::asset('res/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('res/pretty/icheck.js') }}"></script>
	<script src="{{ URL::asset('res/js/bootstrap.min.js') }}"></script>
	<link href="{{ URL::asset('res/css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body>
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li>
						<a href="<?=URL::to('/')?>">
							მთავარი
						</a>
					</li>
					@if(!Auth::check())
					<li>
						<a href="register">რეგისტრაცია</a>
					</li>
					<li>
						<a href="login">შესვლა</a>
					</li>
					@endif
					@if(Auth::check())
					<li>
						<a href="dashboard">პროფილი</a>
					</li>
					<li>
						<a href="logout">გამოსვლა</a>
					</li>
					@endif
					<li>
						<a href="#">კონტაქტი</a>
					</li>
					<li>
						<a href="#">ჩვენს შესახებ</a>
					</li>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	
	<div class="content">
		@yield('content')
	</div><!-- /.container -->

</body>
</html>
