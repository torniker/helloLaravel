@extends('layouts.guest')
@section('content')

<div class="job_add_form">
	<div class="job_form_center"> 
		<div class="wrapper"> 
			<div class="errors" style="margin-bottom:20px">
				@if($errors->any())
				@foreach($errors->all() as $error)
				<div class="erroritem">{{ $error }}</div>
				@endforeach
				@endif
			</div>
			{{ Form::open(array('url'=>URL::to('storestud/?token='.$_GET["token"]), 'method' => 'POST')) }}

			<div class="form-group">
				{{ Form::label('username', 'ნიკი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'username', Input::old("username"), ['class'=>'form-control', 'id'=>'username']) }}
			</div>

			<div class="form-group">
				{{ Form::label('firstname', 'სახელი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'firstname', Input::old("firstname"), ['class'=>'form-control', 'id'=>'firstname']) }}
			</div>

			<div class="form-group">
				{{ Form::label('lastname', 'გვარი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'lastname', Input::old("lastname"), ['class'=>'form-control', 'id'=>'lastname']) }}
			</div>

			<div class="form-group">
				{{ Form::label('email', 'ელ-ფოსტა', ['class'=>'control-label']); }}
				{{ Form::input('text', 'email', Input::old("email"), ['class'=>'form-control', 'id'=>'email']) }}
			</div>

			<div class="form-group">
				{{ Form::label('github', 'Github', ['class'=>'control-label']); }}
				{{ Form::input('text', 'github', '', ['class'=>'form-control', 'id'=>'github', 'placeholder' => 'Github ექაუნთის ლინკი']) }}
			</div>

			<div class="form-group">
				{{ Form::label('facebook', 'Facebook', ['class'=>'control-label']); }}
				{{ Form::input('text', 'facebook', '', ['class'=>'form-control', 'id'=>'github', 'placeholder' => 'Facebook ექაუნთის ლინკი']) }}
			</div>

			<div class="form-group">
				{{ Form::label('password', 'პაროლი', ['class'=>'control-label']); }}
				{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
			</div>

		{{ Form::submit('რეგისტრაცია', ['class'=>'btn btn-success'])}}
		</div>
	</div>
</div>

<input type="hidden" name="token" value="{{$_GET['token']}}"/> 


{{ Form::close(); }}

<script type="text/javascript">
	$(".trcheck").click(function()
	{
		var countchecked = $("input:checkbox:checked").length;
		if(countchecked>1){
			$(".myhid").show();
		}else{
			$(".myhid").hide();
		}
	})
</script>

@stop
