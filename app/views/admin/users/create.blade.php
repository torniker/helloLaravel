@extends('layouts.admin-new')
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
			{{ Form::open(array('route' => ['admin.user.store'], 'method' => 'POST')) }}

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
				{{ Form::label('password', 'პაროლი', ['class'=>'control-label']); }}
				{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
			</div>

			<div class="form-group" style="margin: 40px 0">
				<h4>Trainings</h4>
				@foreach($trainings as $training)
				<div style="margin-top:5px">
					{{ Form::checkbox('trainings[]',$training->id,false,array('id' => $training->id)) }}
					{{ Form::label($training->id,$training->name, ['class'=>'control-label leftfive']) }}
					{{ Form::input('text', 'trlevel['.$training->id.']', '', ['class'=>'form-control']) }}
				</div>
				@endforeach
			</div>


			<div class="form-group">
				{{ Form::label('type', 'მომხმარებლის ტიპი', ['class'=>'control-label']); }}
				{{ Form::select('type', [1=>'სტუდენტი', 2=>'მომხმარებელი'], Input::old("type"), ['class'=>'form-control', 'id'=>'typeselector']); }}
			</div>

			{{ Form::submit('დამატება', ['class'=>'btn btn-success'])}}

			{{ Form::close(); }}

			<script>
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-red',
					radioClass: 'iradio_square-red',
    				increaseArea: '20%' // optional
    			});
			</script>
@stop
</div>