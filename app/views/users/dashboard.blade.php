@extends('layouts.guest')
@section('content')
<?php if (session_status() == PHP_SESSION_NONE) {
	session_start();
	$user=Auth::user();
}?>
@if(null!==Session::get('msg'))
<div class="alert alert-warning">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	{{ Session::get('msg') }}
</div>
@endif
<div class="row not_bar">
	<div class="col-lg-3 col-md-6">
		<a href="{{URL::to('my-projects')}}" class="block">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$_SESSION['alljob']}}</div>
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
		<a href="{{URL::to('my-completed')}}" class="block">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-tasks fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$_SESSION['compl']}}</div>
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
		<a href="{{URL::to('my-ongoing')}}" class="block">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$_SESSION['ong']}}</div>
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
		<a href="{{URL::to('my-failed')}}" class="block">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-support fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$_SESSION['failed']}}</div>
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
<div class="scroll">
	@foreach($jobs as $job)
	
		<?php $get=''; ?>
		@if($job->author==$user->id)
		<?php $get = '?author=1'; ?>
		@endif



		<div class="container single_job" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="edit_delete">
				<a href="jobs/edit/{{$job->id}}" class="jobedit btn btn-primary">რედაქტირება</a>
				<a href="jobs/delete/{{$job->id}}" class="jobdelete btn btn-danger">წაშლა</a>
			</div>

			<div class="offer_wrapper" id="form_{{$job->id}}" style="background:none">
				<div class="offer_form">
					<div id="close_button"></div>
					@if($job->open)
					<form method="POST" action="{{URL::to('jobs/apply')}}" class="off_form">
						<div class="form-group">
							<div class="bid_itm">
								{{ Form::submit('უფასოდ დაგეხმარები', ['class'=>'btn btn-success free','name'=>'free'])}}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5" class="bid_itm" style="padding-left:0">
								{{ Form::input('number', 'bid', Input::old("bid"), ['class'=>'form-control useredit bid-input', 'id'=>'company_name']) }}
							</div>
						</div>
						<input type="hidden" value="{{$job->id}}" name="job">

						{{ Form::submit('დაბიდვა', ['class'=>'btn btn-primary bid-submit pull-left'])}}
					</form>
					@else
					<div class="closed">პროექტი დახურულია</div>
					@endif
				</div>
			</div>

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
						<a href="{{URL::to('jobs/show/'.$job->id.$get)}}" class="mylink big">
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
				<?php 
				$bck = "";
				$offer='offer';
				if($job->author==$user->id){
					$bck = "isauth";
					$offer='';
				};
				?>
				@if($job->author==$user->id)

				<a class="well_job job_btn left {{$offer}} offerbtn {{$bck}}" style="background-color:#f0ad4e" href="{{URL::to('jobs/show/'.$job->id.'?author=1')}}">OFFERS</a>
				@else
				<div class="well_job job_btn left {{$offer}} offerbtn {{$bck}}" id="offer_{{$job->id}}">OFFER</div>
				@endif
				<a class="well_job job_btn srulad left" style="background-color:#f0ad4e" href="{{URL::to('jobs/show/'.$job->id.$get)}}">სრულად ნახვა</a>
				<a class="well_job job_btn left mylink likes" id="likes-{{$job->id}}" style="background-color:#337ab7; color:white" href="{{URL::to('jobs/like/'.$job->id)}}"><i class="fa fa-thumbs-o-up fa-lg"></i> {{$job->rating}}</a>
			</div>
		</div>
		</div>
@endforeach
<?php echo $jobs->links(); ?>
</div>

<script type="text/javascript">
	
	$(function() {
		$('.scroll').jscroll({
			autoTrigger: true,
			nextSelector: '.pagination li.active + li a', 
			contentSelector: 'div.scroll',
			callback: function() {
				$('.navbar-default').height($(document).height());
			}
		});
	});

	$( ".offerbtn" ).click(function() {
		var offerid = $(this).attr('id');
		offerid = offerid.substring(6);
		var wrapid="form_"+offerid;



		//$(".content").fadeTo( "slow", 0.1 );
		$( "#"+wrapid ).fadeIn( "slow") 
	}
	)

	$( "#close_button" ).click(function() {
		$( ".offer_wrapper" ).hide();
		$(".content").fadeTo( "slow", 1 );
	}
	)

	$( ".likes" ).click(function() {
		event.preventDefault();
		var url = $(this).attr('href');
		var id = $(this).attr('id');
		$.get( url, function( data ) {
			$("#"+id).html('<i class="fa fa-thumbs-o-up fa-lg"></i>'+data);
			$("#"+id).css("background-color", "#619BCD");
		});
	}
	)

	$('.jobdelete').click(function(e){
		if(confirm("დარწმუნებული ხარ რომ გინდა წაშლა?")){

		}else{
			e.preventDefault();
		}	
	});
</script>
@stop