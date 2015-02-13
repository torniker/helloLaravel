@extends('layouts.freelancer.master')
@section('body')
{{ Form::open(array('route' => ['freelancer.projects.store'], 'method' => 'POST')) }}
<div class="form-group">
	{{ Form::label('title', 'Title', ['class'=>'control-label']); }}
	{{ Form::input('text', 'title', '', ['class'=>'form-control', 'id'=>'title']) }}

	{{ Form::label('body', 'Body', ['class'=>'control-label']); }}
	{{ Form::textarea('body', '', ['class'=>'form-control', 'id'=>'body']) }}
</div>
{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}
@stop