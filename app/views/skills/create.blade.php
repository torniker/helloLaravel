@extends('layouts.master')
@section('content')
<h2>Create a new skill</h2>
{{ Form::open(array('action'=>'SkillsController@store','method'=>"post")) }}
	<div class="col-xs-2">
		<div class="form-group clearfix">
			{{ Form::label('name','Skill')}}
			{{ Form::text('name',Input::old('name'),array('class'=>'form-control')) }}
		</div>

		{{ Form::submit('Create',array('class'=>'btn btn-primary')) }} 
	</div>
{{ Form::close() }}

@stop 