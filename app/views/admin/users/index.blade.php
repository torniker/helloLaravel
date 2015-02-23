@extends('layouts.admin-new')
@section('content')
<div class="job_add_form">
	<div class="job_form_center uss"> 
@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}">
        {{ Session::get('message') }}
    </div>
@endif
<p class="text-right">
	<a href="{{ URL::to('admin/user/create') }}" class="btn btn-success">
		<i class="glyphicon glyphicon-plus"></i> Create User
	</a>
</p>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>type</th>
		<th colspan="2" class="col-xs-1">Action</th>
	</thead>
	<tbody>
	@foreach($users as $user)
	<tr>
		<td>
			<a href="{{ URL::to('admin/user/'.$user->id.'/edit') }}">
				{{ $user->firstname }} {{ $user->lastname }}
			</a>
		</td>
		<td>{{ $user->type }}</td>
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