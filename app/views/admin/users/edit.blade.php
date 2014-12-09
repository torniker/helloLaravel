@extends('layouts.admin')
@section('content')
{{ Form::open(array('route' => array('admin.user.update', $user->id), 'method' => 'PUT')) }}

<div class="form-group">
	{{ Form::label('firstname', 'Firstname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'firstname', $user->firstname, ['class'=>'form-control', 'id'=>'firstname']) }}
</div>

<div class="form-group">
	{{ Form::label('lastname', 'Lastname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'lastname', $user->lastname, ['class'=>'form-control', 'id'=>'lastname']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'E-mail', ['class'=>'control-label']); }}
	{{ Form::input('text', 'email', $user->email, ['class'=>'form-control', 'id'=>'email']) }}
</div>

<div class="form-group">
	{{ Form::label('password', 'Password', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'Gender', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'Female', 1=>'Male'], $user->gender, ['class'=>'form-control', 'id'=>'gender']); }}
</div>

<div class="form-group">
<h4>skills</h4>
	
@foreach($skills as $skill)
	{{$checked = false}}
	@foreach($user->skills as $user_skill)
		@if($skill->id==$user_skill->id)
			<?php $checked = true ?> 
		@endif
	@endforeach
	<div class="col-md-4">
	{{ Form::checkbox('skill[]',$skill->id,$checked,array('id' => $skill->id)) }}
	{{ Form::label($skill->id,$skill->name , ['class'=>'control-label']) }}
	{{ Form::input('text', 'level['.$skill->id.']', '', ['class'=>'form-control'] ) }}
	</div>
@endforeach
</div>


{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}

<script type="text/javascript">
	
</script>


@stop