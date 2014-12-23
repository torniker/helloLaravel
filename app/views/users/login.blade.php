@extends('layouts.master')
@section('content')
<?php
	$oldUser = Session::get('oldUser');
?>
<div class="loginform">
	<div class="login_heading">ავტორიზაციის ფორმა</div>
	<form class="form-horizontal" role="form" method="post" action="login">
		<div class="errors" style="margin-bottom:20px">
			<div>{{ $errors->first('username') }}</div>
			<div>{{ $errors->first('password') }}</div>
			<div>{{ Session::get('message') }}</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">ნიკი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="username" 
				name="username" placeholder="ნიკი" value="{{$oldUser}}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">პაროლი</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="password" name="password" placeholder="პაროლი">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember" class="myClass"> დამიმახსოვრე
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-default">შესვლა</button>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-red',
    			radioClass: 'iradio_square-red',
    			increaseArea: '20%' // optional
			});
		});
	</script>
</div>
@stop