@extends('layouts.admin')
@section('content')
{{ Form::open(array('url' => 'admin/trainings/update/'.$training->id, 'method' => 'POST')) }}

<div class="form-group">
	{{ Form::label('name', 'Name', ['class'=>'control-label']); }}
	{{ Form::input('text', 'name', $training->name, ['class'=>'form-control', 'id'=>'name']) }}
</div>
{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}
@stop