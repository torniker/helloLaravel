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
			@foreach($project->offers as $offer)
			<div class='ibox border-bottom' style="margin-bottom:0">
				<div class='ibox-title ibox-title-padding collapse-link icon clearfix'>
					<div class="pull-left" >
						<b>{{ $offer->user->firstname }} {{ $offer->user->lastname }}</b> - 
						<b class="label label-primary floatdel"  > {{ $offer->price }} {{ $offer->currencyText() }}</b>
					</div>
					<div class="ibox-tools">
                        <a class="">
                            <i class="fa fa-chevron-up"></i>
                        </a>
					</div>
				</div>
				<div class='ibox-content custom-padding hide-by-default'> 
					<p class='margin-sm-top' style="margin:0">{{ $offer->message }} {{ $offer->message }} {{ $offer->message }} {{ $offer->message }}</p>
				</div>
			</div>
			@endforeach
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
<script>
	$('.offer').on('click',function(){
		message = $(this).find('.message').toggleClass('one-line-text');
	});
</script>
@stop