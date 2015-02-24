@extends('layouts.admin-new')
@section('content')
<div class="job_add_form">
	<div class="job_form_center"> 
		{{ Form::open(array('url' => 'admin/trainings/update/'.$training->id, 'method' => 'POST')) }}

		<div class="form-group">
			{{ Form::label('name', 'Name', ['class'=>'control-label']); }}
			{{ Form::input('text', 'name', $training->name, ['class'=>'form-control', 'id'=>'name']) }}
		</div>
		{{ Form::submit('დამახსოვრება', ['class'=>'btn btn-success pull-right'])}}
		<div class="clear"></div>
		{{ Form::close(); }}
	</div>
</div>
@stop