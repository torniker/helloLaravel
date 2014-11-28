@extends('layouts.master')
@section('content')

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>Gender</th>
		<th>Skills</th>
	</thead>
	<tbody>
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