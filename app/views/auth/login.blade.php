@extends('layouts.custom')
`
@section('head')
	<style type="text/css" src='{{ URL::to("res/css/signin.css") }}'></style>
@stop

@section('body')
<div class="container">
	<div class='notifications'>
		{{ Notification::showAll() }}
	</div>

	<div class='col-xs-4 col-xs-offset-4'>
	  	{{ Form::open(array('url' => 'login','method' => 'post')) }}
		    <h2 class="form-signin-heading">Please sign in</h2>
		    
		    <label for="inputUsername" class="sr-only">Username</label>
		    <input name='username' type="text" id="inputUsername" class="form-control" placeholder="Username" autofocus>
		    
		    <label for="inputPassword" class="sr-only">Password</label>
		    <input name='password' type="password" id="inputPassword" class="form-control" placeholder="Password">
		    
		    <div class="checkbox">
		      	<label>
		        	<input type="checkbox" value="remember-me"> Remember me
		      	</label>
		    </div>
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	  	{{ Form::close() }}
	</div>
</div> <!-- /container -->
@stop