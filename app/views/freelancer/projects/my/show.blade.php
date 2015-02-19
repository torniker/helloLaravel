@extends('layouts.freelancer.master')

@section('body')
<div class='clearfix row'>
	<div class='col-xs-18'>
		<div class='ibox border-bottom'>
			<div class='ibox-title'>
				<h4>{{ $project->title }}</h4>
			</div>
			<div class='ibox-content'>
				<p>{{ $project->body }}</p>
			</div>
		</div>
		<div class='margin-top-big'>
			<h4>Offers</h4>
			@if($project->offers->count()>0)
				@foreach($project->offers as $offer)
				<div class='ibox border-bottom' style="margin-bottom:0">
					<div class='ibox-title ibox-title-padding icon clearfix'>
						<div class="pull-left" >
							<b>{{ $offer->user->firstname }} {{ $offer->user->lastname }}</b> - 
							<b class="label label-primary floatdel"  > {{ $offer->price }} {{ $offer->currencyText() }}</b>
						</div>
						<div class="ibox-tools">
							@if($offer->status==1)
								<a class='btn btn-primary btn-xs' href='{{ URL::to("freelancer/projects/my/".$project->id."/hire/".$offer->id) }}'>Hire</a>
							@elseif($offer->status==2)
								<a class='btn btn-primary btn-xs' href='{{ URL::to("freelancer/projects/my/".$project->id."/finish/".$offer->id) }}'>Finish</a>
							@elseif($offer->status==3)
								<a class='btn btn-primary btn-xs leave-feedback' data-feedback='{{ $offer->feedback }}' data-offerid='{{ $offer->id }}' href='#'>Leave feedback</a>
							@endif
	                        <a class="">
	                            <i class="fa fa-chevron-up collapse-link"></i>
	                        </a>
						</div>
					</div>
					<div class='ibox-content custom-padding hide-by-default'> 
						<p class='margin-sm-top' style="margin:0">{{ $offer->message }} {{ $offer->message }} {{ $offer->message }} {{ $offer->message }}</p>
					</div>
				</div>
				@endforeach
			@else
				No offers
			@endif
		</div>
	</div>
	<div class='col-xs-6'>
		<div class="clearfix">
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
	</div>
</div>

<div class='comments'>
	@include('misc.comments.show',['comments'=>$project->comments])
	
	@include('misc.comments.create',['project_id'=>$project->id])
</div>

<div class="modal" id="leave-feedback" tabindex="-1" role="dialog" aria-labelledby="leave-feedbackLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title" id="create-offerLabel">Leave feedback</h4>
		  </div>
		   {{ Form::open(array('url' => ['freelancer/offers/feedback'], 'id' => 'leave-feedback-form', 'method' => 'POST')) }}
		  <div class="modal-body">
			<div class="form-group">
				{{ Form::label('feedback', 'Feedback', ['class'=>'control-label']); }}
				{{ Form::textarea('feedback', '', ['class'=>'form-control', 'id'=>'feedback_value']) }}
			</div>

			{{ Form::hidden('project_id',$project->id,['id' => 'project_id_value']) }}
			{{ Form::hidden('offer_id','',['id' => 'offer_id_value']) }}


		  </div>
		  <div class="modal-footer">
		    {{ Form::submit('Leave feedback', ['class'=>'btn btn-primary pull-right'])}}
		  </div>
			{{ Form::close(); }}
		</div>
	</div>
</div>

<script>

$(function(){
	$('.offer').on('click',function(){
		message = $(this).find('.message').toggleClass('one-line-text');
	});

	$('.leave-feedback').on('click',function(){
		offerid = $(this).data('offerid');
		feedback = $(this).data('feedback');
		$('#offer_id_value').val(offerid);
		$('#feedback_value').val(feedback);
		$('#leave-feedback').show();
		debugger;
	});

});

</script>
@stop