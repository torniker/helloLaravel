@extends('layouts.admin')
@section('content')
@if($errors->any())
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>
@endif
<div class="wrapper"> 
<div class="errors" style="margin-bottom:20px">
	<div>{{ $errors->first('firstname') }}</div>
	<div>{{ $errors->first('lastname') }}</div>
	<div>{{ $errors->first('email') }}</div>
	<div>{{ $errors->first('password') }}</div>
	<div>{{ Session::get('message') }}</div>
</div>
{{ Form::open(array('route' => ['admin.user.store'], 'method' => 'POST')) }}
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
	{{ Form::label('password', 'პაროლი', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'სქესი', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'ქალი', 1=>'კაცი'], Input::old("gender"), ['class'=>'form-control', 'id'=>'gender']); }}
</div>
<div class="form-group">
	{{ Form::label('type', 'მომხმარებლის ტიპი', ['class'=>'control-label']); }}
	{{ Form::select('type', [1=>'სტუდენტი', 2=>'მომხმარებელი',3=>'კომპანია', 4=>'ადმინისტრატორი'], Input::old("type"), ['class'=>'form-control', 'id'=>'typeselector']); }}
</div>

<div class="myhidden">
	<div class="form-group">
		{{ Form::label('company_name', 'კომპანიის დასახელება', ['class'=>'control-label red']); }}
		{{ Form::input('text', 'company_name', Input::old("company_name"), ['class'=>'form-control', 'id'=>'company_name']) }}
	</div>

	<div class="form-group">
		{{ Form::label('identification_code', 'საიდენტიფიკაციო კოდი', ['class'=>'control-label red']); }}
		{{ Form::input('text', 'identification_code', Input::old("identification_code"), ['class'=>'form-control', 'id'=>'identification_code']) }}
	</div>
</div>

{{ Form::submit('დამატება', ['class'=>'btn btn-primary'])}}

{{ Form::close(); }}

<script>
	$('#typeselector').on('change', function() {
		if(this.value==3){
			$(".myhidden").show("slow");
		}
		else{
			$(".myhidden").hide("slow");
		}
	});
</script>
@stop
</div>