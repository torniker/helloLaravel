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
	<script src="{{ URL::asset('res/js/bigtext.js') }}"></script>
	<script src="{{ URL::asset('res/js/jquery.elevatezoom.js') }}"></script>
	<script src="{{ URL::asset('res/js/animatedscroll.js') }}"></script>
	<script src="{{ URL::asset('res/js/jscroll.js') }}"></script>
	<script src="{{ URL::asset('res/js/sweetalert/lib/sweet-alert.min.js') }}"></script>
	<link href="{{ URL::asset('res/js/sweetalert/lib/sweet-alert.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="menu_wrapper">
			<a class="logo left" href="{{URL::to('')}}"></a>
			@if(!Auth::check())
			<a class="auth right btn btn-success auth_btn gitlog" href="{{URL::to('gitlogin')}}" alt="Login Using Github" title="Login Using Github"></a>
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
				<ul class="nav in" id="side-menu">
					@if(!Auth::check())
					<li>
						<a href="{{URL::to('filter/1')}}">
							<i class="fa fa-th-list"></i>	ვებ პროგრამირება
						</a>
					</li>
					<li>
						<a href="{{URL::to('filter/2')}}">
							<i class="fa fa-th-list"></i>	ინტერფეისი
						</a>
					</li>
					<li>
						<a href="{{URL::to('filter/3')}}">
							<i class="fa fa-th-list"></i>	ვებ დიზაინი
						</a>
					</li>
					<li>
						<a href="{{URL::to('filter/4')}}">
							<i class="fa fa-th-list"></i>	ვებ ადმინისტრირება
						</a>
					</li>
					<li>
						<a href="{{URL::to('filter/6')}}">
							<i class="fa fa-th-list"></i>	ინტერნეტ მარკეტინგი
						</a>
					</li>
					<li>
						<a href="{{URL::to('filter/5')}}">
							<i class="fa fa-th-list"></i>	Linux ადმინისტრირება
						</a>
					</li>
				</ul>
				@else
				<?php $curUser = Auth::user(); ?>
				@if(empty($curUser->avatar))
				<img src="{{URL::to('uploads/default_avatar.png')}}" alt="" class="img-circle img-responsive" width="150px" height="150px" style="margin-left:40px; margin-bottom:10px; margin-top:10px;">
				@else
				<img src="{{URL::to('uploads/'.$curUser->avatar)}}" width="150px" height="150px" style="margin-left:40px; margin-bottom:10px; margin-top:10px;">
				@endif
				<div style="padding-left:40px; margin-bottom:20px;">
					გამარჯობა, 
					<a href="{{URL::to('show/'.$curUser->id)}}">
						{{
							$curUser->firstname
						}}
					</a>
				</div>
				<ul class="nav in" id="side-menu">
					<li style="border-top: 1px solid #e7e7e7">
						<a href="{{URL::to('dashboard')}}">
							<i class="fa fa-th-list"></i> პროექტები
						</a>
					</li>
					<li style="border-top: 1px solid #e7e7e7">
						<a href="{{URL::to('')}}">
							<i class="fa fa-th-list"></i> პროგრამისტები
						</a>
					</li>
					<li>
						<a href="{{URL::to('jobs/add')}}">
							<i class="fa fa-th-list"></i> პროექტის დამატება
						</a>
					</li>
					<li>
						<a href="{{URL::to('editprofile')}}">
							<i class="fa fa-th-list"></i> პროფილის რედაქტირება
						</a>
					</li>
					<li>
						<a href="{{URL::to('#')}}">
							<i class="fa fa-th-list"></i> ფორუმი
						</a>
					</li>
					<li>
						<a href="{{URL::to('#')}}">
							<i class="fa fa-th-list"></i> სხვადასხვა
						</a>
					</li>
					@if($curUser->type==4)
						<li style="border-top: 1px solid #e7e7e7">
							<a class="red showadmin">
								<i class="fa fa-th-list"></i> ადმინკა
							</a>
						</li>

						<ul id="adminmenu" class="myhid">
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
					@endif
					@endif
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
		$( ".showadmin" ).click(function() {
			if ($('#adminmenu').css('display') == 'none'){
				$( "#adminmenu" ).show("slow"); 
			}else{
				$( "#adminmenu" ).hide("slow"); 
			}
		}
		)
	</script>

</body>
</html>
