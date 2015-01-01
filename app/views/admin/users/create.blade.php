@extends('layouts.admin')
@section('content')

{{ Form::open(array('route' => ['admin.user.store'], 'method' => 'POST')) }}
<div class="form-group">
	{{ Form::label('firstname', 'Firstname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'firstname', '', ['class'=>'form-control', 'id'=>'firstname']) }}
</div>

<div class="form-group">
	{{ Form::label('lastname', 'Lastname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'lastname', '', ['class'=>'form-control', 'id'=>'lastname']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'E-mail', ['class'=>'control-label']); }}
	{{ Form::input('text', 'email', '', ['class'=>'form-control', 'id'=>'email']) }}
</div>

<div class="form-group">
	{{ Form::label('password', 'Password', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'Gender', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'Female', 1=>'Male'], '', ['class'=>'form-control', 'id'=>'gender']); }}
</div>

{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}
@stop