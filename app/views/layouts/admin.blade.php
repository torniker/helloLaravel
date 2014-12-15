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
	<script type="text/javascript" src="{{ URL::asset('res/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('res/js/bootstrap.min.js') }}"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand nino" href="<?=URL::to('/')?>">Pro ITDC</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::to('admin/user/') }}" class="nino">
						მომხმარებლები
					</a></li>
					<li><a href="{{ URL::to('admin/skill/') }}" class="nino">
						სკილები
					</a></li>
					<li><a href="{{ URL::to('logout') }}" class="nino">
						გამოსვლა
					</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container">
		@yield('content')
	</div><!-- /.container -->

	
	

</body>
</html>
