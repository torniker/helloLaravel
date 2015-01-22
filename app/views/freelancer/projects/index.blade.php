@extends('layouts.freelancer')

@section('content')
	@foreach($projects as $project)
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{ $project->title }} By {{ $project->user->firstname }} {{ $project->user->lastname }}</h3>
		  </div>
		  <div class="panel-body">
		    {{ $project->body }}
		  </div>
		</div>
	@endforeach

	{{ $projects->links(); }}
@stop