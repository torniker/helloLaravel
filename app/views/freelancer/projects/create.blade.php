@extends('layouts.freelancer.master')
@section('body')
<div class='ibox border-bottom'>
	<div class='ibox-title collapse-link'>
		<h5>Create new project</h5>
	</div>
	<div class='ibox-content'>
		{{ Form::open(array('route' => ['freelancer.projects.store'], 'method' => 'POST')) }}
		<div class="form-group">
			{{ Form::label('title', 'Title', ['class'=>'control-label']); }}
			{{ Form::input('text', 'title', '', ['class'=>'form-control', 'id'=>'title']) }}

			{{ Form::label('body', 'Body', ['class'=>'control-label']); }}
			{{ Form::textarea('body', '', ['class'=>'form-control', 'id'=>'body']) }}

			{{ Form::label('expires', 'Number of days before expiring', ['class'=>'control-label']); }}
			{{ Form::number('expires', '', ['class'=>'form-control', 'id'=>'expires']) }}
		</div>
		{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

		{{ Form::close(); }}
	</div>
</div>
@stop 