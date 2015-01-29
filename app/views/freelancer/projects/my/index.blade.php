@extends('layouts.freelancer')

@section('content')
	<div class='clearfix margin-bottom'>
		<a href="{{ URL::to('freelancer/projects/create') }}" class="btn btn-success pull-right">
			<i class="glyphicon glyphicon-plus"></i> Create Project
		</a>
	</div>
	<div>
		@foreach($projects as $project)
			@if($project->isExpired())
				<div class="panel panel-danger">
			@elseif($project->isNew())
				<div class="panel panel-success">
			@else
				<div class="panel panel-default">
			@endif
			  <div class="panel-heading clearfix">
			    <h3 class="panel-title pull-left">{{ $project->title }} By {{ $project->user->firstname }} {{ $project->user->lastname }}</h3>
			    <a class='btn btn-xs btn-primary pull-right' href='{{ URL::to("freelancer/projects/my",$project->id) }}'>View project</a>
			  </div>
			  <div class="panel-body">
			    {{ $project->body }}
			  </div>
			</div>
		@endforeach
	</div>
	{{ $projects->links(); }}
@stop