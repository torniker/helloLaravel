@extends('layouts.guest')
@section('content')
<?php
$oldUser = Session::get('oldUser');
?>
<div class="job_add_form">
	<div class="job_form_center">
		<div class="loginform">
			<form class="form-horizontal" role="form" method="post" action="login">
				<div class="errors" style="margin-bottom:20px">
					<div>{{ $errors->first('username') }}</div>
					<div>{{ $errors->first('password') }}</div>
					<div>{{ Session::get('message') }}</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">ნიკი</label>
					<div class="col-sm-9">
						<input type="text" class="form-control nick-inp" id="username" 
						name="username" placeholder="ნიკი" value="{{$oldUser}}">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">პაროლი</label>
					<div class="col-sm-9">
						<input type="password" class="form-control nick-inp" id="password" name="password" placeholder="პაროლი">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 remember-inp">
						<div class="checkbox ">
							<label>
								<input type="checkbox" name="remember" class=""> დამიმახსოვრე
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10">
					<button type="submit" class="btn btn-success sub-inp">შესვლა</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-red',
			radioClass: 'iradio_square-red',
    			increaseArea: '20%' // optional
    		});
	});
</script>
@stop