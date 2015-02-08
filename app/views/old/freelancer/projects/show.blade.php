@extends('old.layouts.freelancer')

@section('content')
<div class='clearfix row'>
	<div class='col-xs-9'>
		<h2>{{ $project->title }}</h2>
		<p>{{ $project->body }}</p>

		<div class='margin-top-big'>
			<h4>Other projects from this client</h4>
			<ol class='no-list-style'>
				@foreach($user_projects as $user_project)
						<li><a href="{{ URL::to('freelancer/projects',$user_project->id) }}">{{ $user_project->title }}</a>
				@endforeach
			</ol>
		</div>
	</div>
	<div class='col-xs-3'>
		<div class="clearfix">
			<button type="button" id="modal_launcher" class="btn btn-primary col-xs-12 margin-bottom block" data-toggle="modal" data-target="#create-offer">
			  Make an Offer
			</button> 
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading">Project details</div>
		  <div class="panel-body">
		    <ul class='attributes'>
		    	<li><span class='attribute'>Project Added:</span> <span class='value'>{{ $project->created_at->diffForHumans() }}</span></li>
		    	<li><span class='attribute'>Expires:</span> <span class='value'>{{ $project->expires->diffForHumans() }}</span></li>
		    	<li><span class='attribute'>Number of offers:</span> <span class='value'>{{ $project->offers->count() }}</span></li>
		    </ul>
		  </div>
		</div>

		<div class="panel panel-default">
		  <div class="panel-heading">Client details</div>
		  <div class="panel-body">
		    <ul class='attributes'>

		    	<li><span class='attribute'>Name:</span> <span class='value'>{{ $project->user->firstname }} {{ $project->user->lastname }}</span></li>
		    	<li><span class='attribute'>Registered:</span> <span class='value'>{{ $project->user->created_at->diffForHumans() }}</span></li>
		    	<li><span class='attribute'>Total Projects:</span> <span class='value'>{{ $total_projects_by_user }}</span></li>
		    	
		    </ul>
		  </div>
		</div>
	</div>
</div>

<div class="modal fade" id="create-offer" tabindex="-1" role="dialog" aria-labelledby="create-offerLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4 class="modal-title" id="create-offerLabel">Make an Offer</h4>
			  </div>
			   {{ Form::open(array('route' => ['freelancer.offers.store'], 'method' => 'POST')) }}
			  <div class="modal-body">
				<div class="form-group">
					{{ Form::label('price', 'Price', ['class'=>'control-label']); }}
					{{ Form::input('number', 'price', '', ['class'=>'form-control', 'id'=>'price']) }}
				</div>

				<div class="form-group">
					{{ Form::label('message', 'message', ['class'=>'control-label']); }}
					{{ Form::textarea('message', '', ['class'=>'form-control', 'id'=>'message']) }}
				</div>

				<div class="form-group">
					{{ Form::label('currency', 'Currency', ['class'=>'control-label']); }}
					{{ Form::select('currency', [1=>'USD', 2=>'GEL',3=>'EURO'], '', ['class'=>'form-control', 'id'=>'currency']); }}
				</div>

				{{ Form::hidden('project_id',$project->id,['id' => 'project_id_value']) }}
			

			  </div>
			  <div class="modal-footer">
			    {{ Form::submit('Make an Offer', ['class'=>'btn btn-primary pull-right'])}}
			  </div>
				{{ Form::close(); }}
			</div>
		</div>
	</div>
@stop