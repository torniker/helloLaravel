@extends('layouts.master')
@section('content')
<div id="skill-search" class="margin-bottom input-group">
	{{ Form::label('skills','Search Skills') }}
	{{ Form::text('skills','',array('class'=>'form-control')) }}
	
</div>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>Gender</th>
		<th>Skills</th>
	</thead>
	<tbody id="users-list"> 
	@foreach($users as $user)
	<tr>
		<td>{{ $user->firstname }} {{ $user->lastname }}</td>
		<td>{{ $user->gender }}</td>
		<td>
			@foreach($user->skills as $skill)
				<span class="label label-default">{{ $skill->name }}</span>
			@endforeach
		</td>
	</tr>
	@endforeach
	</tbody>
	
</table>
@stop