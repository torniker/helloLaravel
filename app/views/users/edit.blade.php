@extends('layouts.guest')
@section('content')
<div class="center">
@if(null!==Session::get('msg'))
<div class="alert alert-warning">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	{{ Session::get('msg') }}
</div>
@endif
<div class="job_add_form">
	<div class="job_form_center"> 
	<form class="form-horizontal" role="form" method="post" action="{{URL::to('doedit')}}">
		<div class="errors" style="margin-bottom:20px">
			<div>{{ $errors->first('username') }}</div>
			<div>{{ $errors->first('password') }}</div>
			<div>{{ $errors->first('firstname') }}</div>
			<div>{{ $errors->first('lastname') }}</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">ნიკი</label>
			<div class="col-sm-9">
				@if(empty($gituser))
				<input type="text" class="form-control useredit" id="username" 
				name="username" value="{{$user->username}}">
				@else
				<input type="text" class="form-control orange" id="username" 
				name="username" value="{{$gituser}}">
				@endif
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">სახელი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control useredit" id="firstname" 
				name="firstname" value="{{$user->firstname}}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">გვარი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control useredit" id="lastname" 
				name="lastname" value="{{$user->lastname}}">
			</div>
		</div>

		<div class="form-group" id="phonewrapper">
			{{ Form::label('phone', 'ტელეფონის ნომერი', ['class'=>'control-label col-sm-3']); }}
			@foreach ($user->phones as $phone)
			<div class="myphone">
				<input class="form-control useredit" id="phone" name="phone[<?=$phone["id"]?>]" type="text" value="<?=$phone["phone"]?>">
			</div>
			@endforeach
		</div>
		<a id="phoneadd" style="color:#E04836">ნომრის დამატება</a>

		<div class="myhidden">
			<div class="form-group">
				{{ Form::label('company_name', 'კომპანიის დასახელება *', ['class'=>'control-label col-sm-3 red']); }}
				<div class="col-sm-9">
					{{ Form::input('text', 'company_name', Input::old("company_name"), ['class'=>'form-control useredit', 'id'=>'company_name']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('identification_code', 'საიდენტიფიკაციო კოდი *', ['class'=>'control-label col-sm-3 red']); }}
				<div class="col-sm-9">
					{{ Form::input('text', 'identification_code', Input::old("identification_code"), ['class'=>'form-control useredit', 'id'=>'identification_code']) }}
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">პაროლი</label>
			<div class="col-sm-9">
				<input type="password" class="form-control useredit" id="password" name="password" placeholder="პაროლი">
			</div>
			<div class="form-group" style="margin-top:70px">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-default useredit usereditbutton">რედაქტირება</button>
				</div>
			</div>
			<input type="hidden" name="id" value="{{$user->id}}">
		</div>

		<div class="form-group">
			<a class="auth left btn btn-success auth_btn" 
			href="{{URL::to('gitauth')}}" style="margin-left:80px">Github აუტენთიფიკაცია
			</a>
		</div>

		</form>
		
	</div>

	<script>
		var counter = 1000000;
		$( document ).ready(function() {
			var val = $( "#typeselector" ).val();
			if (val==3) {
				$(".myhidden").show();
			};
		});
		$('#typeselector').on('change', function() {
			if(this.value==3){
				$(".myhidden").show("slow");
			}
			else{
				$(".myhidden").hide("slow");
			}
		});
		$('#phoneadd').on('click', function() {
			var form = 
			'<div class="myphone"><input class="form-control" id="phone'+counter+'" name="phone['+counter+']" type="text"></div>'
			$('#phonewrapper').append(form);
			counter++;
		});
	</script>
	@stop