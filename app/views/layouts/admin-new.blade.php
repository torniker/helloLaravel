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
	<link href="{{ URL::asset('res/css/new.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/css/fonts.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('res/pretty/skins/all.css') }}" rel="stylesheet">
	<script src="{{ URL::asset('res/js/jquery.js') }}"></script>
	<script src="{{ URL::asset('res/pretty/icheck.js') }}"></script>
	<script src="{{ URL::asset('res/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('res/js/datepicker.js') }}"></script>
</head>
<body>
	<div class="container">
		<div class="menu_wrapper">
			<a class="logo left" href="{{URL::to('')}}"></a>
			@if(!Auth::check())
			<a class="auth right btn btn-success auth_btn" href="{{URL::to('login')}}">ავტორიზაცია</a>
			@else
			<a class="auth right btn btn-danger auth_btn" href="{{URL::to('logout')}}">გამოსვლა</a>
			@endif
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="container">
		<div class="navbar-default sidebar left" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<?php $curUser = Auth::user(); ?>
					@if(empty($user->avatar))
					<img src="{{URL::to('uploads/default_avatar.png')}}" alt="" class="img-circle img-responsive" width="150px" height="150px" style="margin-left:40px; margin-bottom:10px; margin-top:10px;">
					@else
					<img src="{{URL::to('uploads/'.$user->avatar)}}" width="150px" height="150px" style="margin-left:40px; margin-bottom:10px; margin-top:10px;">
					@endif
					<div style="padding-left:40px; margin-bottom:20px;">
						გამარჯობა, 
						<a href="{{URL::to('show/'.$user->id)}}">
							{{
								$user->firstname
							}}
						</a>
					</div>
				<ul class="nav in" id="side-menu">
					<li style="border-top: 1px solid #e7e7e7">
						<a href="{{URL::to('admin/user/')}}">
							<i class="fa fa-th-list"></i> მომხმარებლები
						</a>
					</li>
					<li>
						<a href="{{URL::to('admin/skill/')}}">
							<i class="fa fa-th-list"></i> სკილები
						</a>
					</li>
					<li>
						<a href="{{URL::to('admin/trainings/')}}">
							<i class="fa fa-th-list"></i> ტრენინგები
						</a>
					</li>
					<li>
						<a href="{{URL::to('admin/generator')}}">
							<i class="fa fa-th-list"></i> რეგისტრაციის გენერატორი
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content left">
			@yield('content')
		</div>
		
		<div class="clear"></div>
	</div>

	<script>
		$('.navbar-default').height($(document).height());
	</script>

</body>
</html>
