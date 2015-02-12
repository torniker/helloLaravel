@extends('layouts.freelancer.master')

@section('body')
<div class='clearfix row'>
	<div class='col-xs-9'>
		<h2>{{ $project->title }}</h2>
		<p>{{ $project->body }}</p>

		<div class='margin-top-big'>
			<h4>Offers</h4>
			@foreach($project->offers as $offer)
				<div class="panel panel-default offer">
				  <div class="panel-body">
				    <div>{{ $offer->user->firstname }} {{ $offer->user->lastname }}</div>
				    <div>Offer Price: {{ $offer->price }} {{ $offer->currencyText() }}</div>
				    <p class='one-line-text message margin-sm-top'>{{ $offer->message }} {{ $offer->message }} {{ $offer->message }} {{ $offer->message }}</p>
				  </div>
				</div>
			@endforeach
		</div>
	</div>
	<div class='col-xs-3'>
		<div class="clearfix">
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
	</div>
</div>
<script>
	$('.offer').on('click',function(){
		message = $(this).find('.message').toggleClass('one-line-text');
	});
</script>
@stop