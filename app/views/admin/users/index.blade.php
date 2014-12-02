@extends('layouts.admin')
@section('content')

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>Gender</th>
	</thead>
	<tbody>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->firstname }} {{ $user->lastname }}</td>
		<td>{{ $user->gender }}</td>
	</tr>
	@endforeach
	</tbody>
	
</table>
@stop