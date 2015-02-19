@extends('layouts.freelancer.master')

@section('body')
<div class='clearfix row'>
	<div class='col-xs-18'>
	<div class="ibox border-bottom">
		<div class="ibox-title"><h4>{{ $project->title }}</h4></div>
		<div class="ibox-content"><p>{{ $project->body }}</p></div>
	</div>
		<div style="margin-top:50px">
		<div class="ibox float-e-margins">
			<div class="ibox-title"><h4>Other projects from this client</h4></div>
			<div class="ibox-content">
			<ol class='no-list-style'>
				@foreach($user_projects as $user_project)
						<li><a href="{{ URL::to('freelancer/projects',$user_project->id) }}">{{ $user_project->title }}</a>
				@endforeach
			</ol>
			</div>
			</div>
		</div>
	</div>
	<div class='col-xs-6'>
		<div class="clearfix">
			<button type="button" id="modal_launcher" style="width:100%" class="btn btn-primary margin-bottom block" data-toggle="modal" data-target="#create-offer">
			  Make an Offer
			</button>
		</div>
		<div class="ibox border-bottom">
		  <div class="ibox-title">Project details</div>
		  <div class="ibox-content">
		    <ul class='attributes'>
		    	<li><b class='attribute'>Project Added:</b> <span class='value'>{{ $project->created_at->diffForHumans() }}</span></li>
		    	<li><b class='attribute'>Expires:</b> <span class='value'>{{ $project->expires->diffForHumans() }}</span></li>
		    	<li><b class='attribute'>Number of offers:</b> <span class='value'>{{ $project->offers->count() }}</span></li>
		    </ul>
		  </div>
		</div>

		<div class="ibox border-bottom">
		  <div class="ibox-title">Client details</div>
		  <div class="ibox-content">
		    <ul class='attributes'>

		    	<li><b class='attribute'>Name:</b> <span class='value'>{{ $project->user->firstname }} {{ $project->user->lastname }}</span></li>
		    	<li><b class='attribute'>Registered:</b> <span class='value'>{{ $project->user->created_at->diffForHumans() }}</span></li>
		    	<li><b class='attribute'>Total Projects:</b> <span class='value'>{{ $total_projects_by_user }}</span></li>

		    </ul>
		  </div>
		</div>
	</div>
</div>

<div class="modal" id="create-offer" tabindex="-1" role="dialog" aria-labelledby="create-offerLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title" id="create-offerLabel">Make an Offer</h4>
		  </div>
		   {{ Form::open(array('route' => ['freelancer.offers.store'], 'id' => 'offer-form', 'method' => 'POST')) }}
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

<div class='comments'>
	@include('misc.comments.show',['comments'=>$project->comments])
	
	@include('misc.comments.create',['project_id'=>$project->id])
</div>

<script>
	$(function(){
		$('#offer-form').validate({
			rules:{
				price: {
					required: true,
					number: true
				},
				message: {
					required: true
				}
			}
		})
	})
</script>
@stop

