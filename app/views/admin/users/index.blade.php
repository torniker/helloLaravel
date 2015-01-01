@extends('layouts.admin')
@section('content')
<p class="text-right">
	<a href="{{ URL::to('admin/user/create') }}" class="btn btn-success">
		<i class="glyphicon glyphicon-plus"></i> Create User
	</a>
</p>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>Gender</th>
		<th colspan="2" class="col-xs-1">Action</th>
	</thead>
	<tbody>
	@foreach($users as $user)
	<tr>
		<td>
			<a href="{{ URL::to('admin/user/'.$user->id) }}">
				{{ $user->firstname }} {{ $user->lastname }}
			</a>
		</td>
		<td>{{ $user->getGender() }}</td>
		<td>
			<a href="{{ URL::to('admin/user/'.$user->id.'/edit') }}" class="btn btn-primary btn-xs">
				<i class="glyphicon glyphicon-pencil"></i>
			</a>
		</td>
		<td>
			{{ Form::open(array('route' => array('admin.user.destroy', $user->id), 'method' => 'delete')) }}
	    		<button type="submit" class="btn btn-default btn-xs">
	    			<i class="glyphicon glyphicon-remove text-danger"></i>
	    		</button>
			{{ Form::close() }}
		</td>
	</tr>
	@endforeach
	</tbody>
	
</table>
@stop