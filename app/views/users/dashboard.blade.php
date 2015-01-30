@extends('layouts.guest')
@section('content')
<div class="row not_bar">
	<div class="col-lg-3 col-md-6">
		<a href="#" class="block">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">26</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left my_not">დამატებული პროექტები</span>
					<div class="clearfix"></div>
				</div>

			</div>
		</div>
	</a>
	<div class="col-lg-3 col-md-6">
		<a href="#" class="block">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-tasks fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">12</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left my_not">დასრულებული პროექტები</span>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</a>
	<div class="col-lg-3 col-md-6">
		<a href="#" class="block">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">124</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left my_not">მიმდინარე პროექტები</span>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</a>
	<div class="col-lg-3 col-md-6">
		<a href="#" class="block">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-support fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">13</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<span class="pull-left my_not">ჩავარდნილი პროექტები</span>
				</div>
			</div>
		</div>
	</a>
</div>

@foreach($jobs as $job)

<div class="container single_job" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row panel">
		<div class="col-md-4 bg_blur" 
		style="background-image:url({{(URL::to('uploads/'.$job->picture))}})">
		@if(isset($job->website))
		<a href="{{$job->website}}}" class="follow_btn hidden-xs">ვებ-საიტი</a>
		@endif
	</div>
	<?php
	$author = User::find($job->author);
	if (!empty($author->avatar)) {
		$avatar = $author->avatar;
	}
	?>
	<div class="col-md-8  col-xs-12">
		@if(!isset($avatar))
		<img src="{{URL::to('uploads/noavatar.png')}}" class="img-thumbnail picture_job hidden-xs" />
		@else
		<img src="{{URL::to('uploads/'.$avatar)}}" class="img-thumbnail picture_job hidden-xs">
		@endif
		<div class="header_job">
			<h1>
				<a href="{{URL::to('jobs/show/'.$job->id)}}" class="mylink big">
					{{$job->heading}}
				</a>
			</h1>
			<a class="mylink" href="{{URL::to('show/'.$job->author)}}">
				<h4>{{$author->firstname.' '.$author->lastname}}</h4>
			</a>
			<div class="job-conten">{{$job->content}}</div>
		</div>
	</div>
</div>   

<div class="row nav">    
	<div class="col-md-4"></div>
	<div class="col-md-8 col-xs-12 well_row" style="padding: 0px;">
		<div class="well_job job_btn left" style="background-color:#5cb85c">OFFER</div>
		<div class="well_job job_btn left" style="background-color:#f0ad4e">სრულად ნახვა</div>
		<div class="well_job job_btn left" style="background-color:#337ab7"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
	</div>
</div>
</div>

@endforeach
@stop