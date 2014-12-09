@extends('layouts.admin')
@section('content')
{{ Form::open(array('route' => ['admin.skill.store'], 'method' => 'POST')) }}
<div class="form-group">
	{{ Form::label('name', 'Name', ['class'=>'control-label']); }}
	{{ Form::input('text', 'name', '', ['class'=>'form-control', 'id'=>'name']) }}
</div>
{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}
@stop