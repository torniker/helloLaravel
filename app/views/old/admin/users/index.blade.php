@extends('old.layouts.admin')
@section('content')

<div class="">
	<?php echo $users->links(); ?>
	<a href="{{ URL::to('admin/user/create') }}" class="btn btn-success pull-right">
		<i class="glyphicon glyphicon-plus"></i> Create User
	</a>
	<div style="clear:both"></div>
</div>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		<th>Skills</th>
		<th>Course</th>
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
		<td>
			@foreach($user->skills as $skill)
				<span class="label label-default">{{ $skill->name }}</span>
			@endforeach
		</td>
		<td>
			@foreach($user->courses as $course)
				<span class="label label-default">{{ $course->name }}</span>
			@endforeach 
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

<style>
	.pagination {
		margin:0;
	}
</style>

@stop

