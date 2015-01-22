@extends('layouts.admin')
@section('content')
{{ Form::open(array('route' => ['admin.course.update',$course->id], 'method' => 'PUT')) }}
<div class="form-group">
	{{ Form::label('name', 'Name', ['class'=>'control-label']); }}
	{{ Form::input('text', 'name', $course->name, ['class'=>'form-control', 'id'=>'name']) }}
</div>
{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }} 
@stop 