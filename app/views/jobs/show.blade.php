<div class="offer_wrapper">
	<div class="offer_form">
		<div id="close_button"></div>
		<form method="POST" action="{{URL::to('jobs/apply')}}" class="off_form">
			<div class="form-group">
				<div class="col-sm-5" style="margin-right:30px">
					{{ Form::input('text', 'bid', Input::old("bid"), ['class'=>'form-control useredit', 'id'=>'company_name']) }}
				</div>
			</div>
			<input type="hidden" value="{{$job->id}}" name="job">

			{{ Form::submit('დაბიდვა', ['class'=>'btn btn-primary pull-left'])}}
		</form>
	</div>
</div>

@extends('layouts.guest')
@section('content')

@if(null!==Session::get('msg'))
<div class="alert alert-warning">
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	{{ Session::get('msg') }}
</div>
@endif

@if(Auth::check())
<?php $user=Auth::user() ?>
@endif

<div class="container single_job" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row panel">
		<div class="col-md-4 bg_blur ">
			<a href="#" class="follow_btn hidden-xs">ვებ-საიტი</a>
		</div>
		<div class="col-md-8  col-xs-12">
			@if(empty($job->picture))
			<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail picture_job hidden-xs" />
			@else
			<img src="{{URL::to('uploads/'.$job->picture)}}" class="img-thumbnail picture_job hidden-xs">
			@endif
			<?php
			$author = User::find($job->author);
			if (!empty($author->avatar)) {
				$avatar = $author->avatar;
			}
			?>

			@if(isset($avatar))
			<img src="{{$avatar}}" class="img-thumbnail visible-xs picture_mob" />
			@else
			<img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="img-thumbnail visible-xs picture_mob" />
			@endif

			<div class="header_job">
				<h1>
					<a href="{{URL::to('jobs/show/'.$job->id)}}" class="mylink big">
						{{$job->heading}}
					</a>
				</h1>
				<h4>{{$author->firstname.' '.$author->lastname}}</h4>
				<div class="job-content">{{$job->content}}</div>
			</div>
		</div>
	</div>   

	<div class="row nav">    
		<div class="col-md-4"></div>
		<div class="col-md-8 col-xs-12 well_row" style="padding: 0px;">
			<div class="well_job job_btn left" style="background-color:#5cb85c" id="offerbtn">		OFFER
			</div>
			<div class="well_job job_btn left" style="background-color:#f0ad4e">სრულად ნახვა</div>
			<div class="well_job job_btn left" style="background-color:#337ab7"><i class="fa fa-thumbs-o-up fa-lg"></i> 26</div>
		</div>
	</div>


	<?php
		$colors=array('success','info','warning','danger','default');
	?>

	@if(!empty($bids))
	<div class="heading">ბიდები</div>
	<div class="bids_wrapper">
		@foreach($bids as $bid)
		<ul class="list-group recent-comments">
			<li class="list-group-item clearfix comment-{{$colors[array_rand($colors)]}}">
				<div class="avatar pull-left mr15">
					<a href="{{URL::to('show/'.$bid['applicant_id'])}}" class="mylink">
					@if(!empty($bid['avatar']))
					<img src="{{URL::to('uploads/'.$bid['avatar'])}}" alt="avatar"
					width="80px" height="80px" style="border-radius:100px">
					@else
					<img src="{{URL::to('uploads/noavatar.png')}}" alt="avatar"
					width="80px" height="80px" style="border-radius:100px">
					@endif
					</a>
				</div>
				<p class="text-ellipsis">
				<a href="{{URL::to('show/'.$bid['applicant_id'])}}" class="mylink">
					<span class="name strong">{{$bid['applicant_name']}}</span>
				</a>
				<div class="bid_price">
						{{$bid['bid']}} ლარი
				</div>
				</p>
			</li>
		</ul>
		@endforeach
	</div>
	@endif


	
	@if(!empty($comments))
	<div class="heading">კომენტარები</div>
	<ul class="list-group recent-comments">
		@foreach($comments as $comment)
		<?php
			$curus = User::find($comment->user_id);
			if(!empty($curus->avatar))
				$avatar=$curus->avatar;
		?>

		<li class="list-group-item clearfix comment-{{$colors[array_rand($colors)]}}">
			<div class="avatar pull-left mr15">
				<a href="{{URL::to('show/'.$comment->user_id)}}" class="mylink">
				@if(isset($avatar))
				<img src="{{URL::to('uploads/'.$avatar)}}" alt="avatar"
				width="80px" height="80px" style="border-radius:100px">
				@else
				<img src="{{URL::to('uploads/noavatar.png')}}" alt="avatar"
				width="80px" height="80px" style="border-radius:100px">
				@endif
				</a>
			</div>
			<p class="text-ellipsis">
				@if(isset($user))
				@if(
					$user->id==$comment->user_id || 
					$user->id==$job->author ||
					$user->type==4
					)
					<div class="comment_delete">
						<form method="POST" action="{{URL::to('comments/delete/'.$comment->id)}}">
							<input type="hidden" name="authorid" value="{{$comment->user_id}}">
							<input type="hidden" name="jobauthor" value="{{$job->author}}">
							<input type="submit" value="წაშლა" class="delstyle btn btn-danger">
						</form>
					</div>
				@endif
				@endif

					<div class="sng_comment pull-left">
						<a href="{{URL::to('show/'.$comment->user_id)}}" class="mylink">
							<span class="name strong">
								{{$usernames[$comment->user_id]}}
							</span>
						</a>
						<div>
						{{$comment->text}}
						</div>
					</div>
				</p>
			</li>
			@endforeach
		</ul>
		@endif

		@if(isset($user))
		<div style="margin-top:80px;">

			{{ Form::open(array('url' => 'comments/add', 'method' => 'POST')) }}

			<div class="form-group" class="jobtext">
				{{ Form::label('text', 'კომენტარის დამატება', ['class'=>'control-label']); }}
				<textarea rows="6" name="text" class="form-control" id="text"></textarea>
			</div>

			{{ Form::input('hidden', 'user_id', $user->id) }}
			{{ Form::input('hidden', 'job_id', $job->id) }}

			{{ Form::submit('დამატება', ['class'=>'btn btn-primary pull-left'])}}
			{{ Form::close(); }}
		</div>
		@endif

	</div>

	<script type="text/javascript">
		$('.comment_delete').click(function(e){
			if(confirm("დარწმუნებული ხარ რომ გინდა კომენტარის წაშლა?")){

			}else{
				e.preventDefault();
			}	
		});

		$( "#offerbtn" ).click(function() {
			$(".content").fadeTo( "slow", 0.1 );
			$( ".offer_wrapper" ).fadeIn( "slow") }
			)

		$( "#close_button" ).click(function() {
			$( ".offer_wrapper" ).hide() ;
			$(".content").fadeTo( "slow", 1 );
		}
		)

		$('.single_job').height($(document).height());

		
	</script>

	@stop