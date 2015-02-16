@extends('layouts.freelancer.master')

@section('body')
<div class='clearfix row'>
	<div class='col-xs-18'>
	
		<div class='clearfix vertical-align-center'>
			<h2 class='pull-left'>{{ $user->firstname }} {{ $user->lastname }}</h2>
			<span class='pull-left'>@section('name') @show </span>
		</div>
		<p>{{ nl2br($user->bio) }}</p>

		<div class='margin-top-big'>
			<h4>Projects from this client</h4>

				@section('projects')
		    		No projects.
		        @show
		</div>
	</div>

	<div class='col-xs-6'>
		<div class="clearfix">
			@section('buttons')

		    @show
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading">Freelancer details</div>
		  <div class="panel-body">
		    <ul class='attributes'>
		    	<li><span class='attribute'>Gender:</span> <span class='value'>{{ $user->getGenderText() }}</span></li>
		    	<li><span class='attribute'>Registered:</span> <span class='value'>{{ $user->created_at->diffForHumans() }}</span></li>
		    	<li><span class='attribute'>Number of offers sent:</span> <span class='value'>{{ $user->offers->count() }}</span></li>
		    	<li><span class='attribute'>Number of projects:</span> <span class='value'>{{ $user->projects->count() }}</span></li>
		    	@section('attributes')

		        @show
		    </ul>
		  </div>
		</div>
		@section('sidebar')@show
</div>
@stop