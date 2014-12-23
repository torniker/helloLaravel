@extends('layouts.master')
@section('content')
@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}">
        {{ Session::get('message') }}
    </div>
@endif

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>სახელი/გვარი</th>
		<th>სქესი</th>
		<th>სკილები</th>
		<th>ტრენინგები</th>
	</thead>
	<tbody>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->firstname }} {{ $user->lastname }}</td>
		<td>{{ $user->getGender() }}</td>
		<td style="width:400px">
			@foreach($user->skills as $skill)
				<span class="label label-default">{{ $skill->name }}</span>
			@endforeach
		</td>
		<td style="width:400px">
			@foreach($user->trainings as $training)
				<span class="label label-default">{{ $training->name }}</span>
			@endforeach
		</td>
	</tr>
	@endforeach
	</tbody>
	
</table>
@stop