<div class="offer_wrapper">
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
	<div class="row panel_low">

		@if(isset($user))
		@if(
			$user->id==$job->author
			)
		@if($job->open)
		<div class="close_project">
			<form action="{{URL::to('jobs/close')}}" method="POST">
				<input type="hidden" value="{{$job->id}}" name="job">
				<input type="submit" class="btn btn-danger" value="პროექტის დახურვა"
				style="border-radius:0">
			</form>
		</div>
		@else
		<div class="project_success">
			<form action="{{URL::to('jobs/success/'.$job->id)}}" method="POST">
				<input type="submit" class="btn btn-success" value="პროექტი დასრულდა წარმატებით" style="border-radius:0">
			</form>
		</div>
		<div class="project_failure">
			<form action="{{URL::to('jobs/failure/'.$job->id)}}" method="POST">
				<input type="submit" class="btn btn-danger" value="პროექტი დასრულდა წარუმატებლად" style="border-radius:0">
			</form>
		</div>
		@endif
		@endif
		@endif

		<div class="col-md-4 bg_blur" 
		style="background-image:url({{(URL::to('uploads/'.$job->picture))}})">
		@if(isset($job->website))
		<a href="{{$job->website}}}" class="follow_btn hidden-xs">ვებ-საიტი</a>
		@endif
		<div class="clear"></div>
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


<div class="clearfix">    
	<div class="col-md-8 col-xs-12 well_row_show" style="padding: 0px;">
		<div class="well_job job_btn left" style="background-color:#5cb85c" id="offerbtn">		OFFER
		</div>
		<div class="well_job job_btn left" style="background-color:#f0ad4e">სრულად ნახვა</div>
		<a class="well_job job_btn left mylink" style="background-color:#337ab7; color:white" href="{{URL::to('jobs/like/'.$job->id)}}"><i class="fa fa-thumbs-o-up fa-lg"></i> {{$job->rating}}</a>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>




<?php
$colors=array('success','info','warning','danger','default');
?>

@if(!empty($bids))
<div class="heading">ბიდები:</div>
<div class="bids_wrapper">
	@foreach($bids as $bid)
	<?php
		$bidus = User::find($bid['applicant_id']);
		$bidclr = $bidus->color;
	?>
	<ul class="list-group recent-comments single-bid">
		<li class="list-group-item clearfix comment-{{$colors[array_rand($colors)]}}"
		style="border-left: 8px solid {{$bidclr}}">
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
					<span class="name bidder_name strong">{{$bid['applicant_name']}}</span>
				</a>
				@if(isset($user))
				@if(
					$user->id==$bid['applicant_id'] || 
					$user->id==$job->author ||
					$user->type==4
					)
				<div class="bid_price">
					@if($bid['bid']==0)
					სურვილისამებრ
					@else
					{{$bid['bid']}} ლარი
					@endif
				</div>

				@endif
				@endif

				@if(isset($user))
				@if(
					$user->id==$job->author
					)
					<div class="choose-form">
						<form action="{{URL::to('jobs/choose')}}" method="POST">
							<input type="hidden" value="{{$job->id}}" name="job">
							<input type="hidden" value="{{$bid['applicant_id']}}" name="user">
							<input type="submit" class="btn btn-default" value="არჩევა"
							style="border-radius:0">
						</form>
					</div>
					@endif
					@endif
				</p>
			</li>
		</ul>
		@endforeach
	</div>
	@endif



	@if(!empty($comments))
	<div class="heading">კომენტარები:</div>
	<ul class="list-group recent-comments">
		@foreach($comments as $comment)
		<?php
		$curus = User::find($comment->user_id);
		if(!empty($curus->avatar))
			$avatar=$curus->avatar;
			$curcolor=$curus->color;
		?>

		<li class="list-group-item clearfix comment-{{$colors[array_rand($colors)]}}"
		style="border-left: 8px solid {{$curcolor}}"">
			<div class="avatar pull-left mr15">
				<a href="{{URL::to('show/'.$comment->user_id)}}" class="mylink">
					@if(isset($avatar))
					<img src="{{URL::to('uploads/'.$avatar)}}" alt="avatar"
					width="60px" height="60px" style="border-radius:100px">
					@else
					<img src="{{URL::to('uploads/noavatar.png')}}" alt="avatar"
					width="60px" height="60px" style="border-radius:100px">
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
							<input type="submit" value="" class="delstyle btn btn-danger">
						</form>
					</div>
					<div class="comment_reply btn btn-success" id="ans-{{$comment->id}}">
						პასუხი
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
			{{ Form::open(array('url' => 'comments/add', 'method' => 'POST', 
			'class' => 'replyform')) }}

			<div class="form-group jobtext jobanswer myhid" id="jobans-{{$comment->id}}">
				<textarea rows="3" name="text" class="form-control" id="txtans-{{$comment->id}}"></textarea>
				{{ Form::submit('პასუხი', ['class'=>'btn btn-success pull-left ansbtn'])}}
			</div>

			{{ Form::input('hidden', 'user_id', $user->id) }}
			{{ Form::input('hidden', 'job_id', $job->id) }}
			{{ Form::input('hidden', 'replied_to', $job->id) }}

			{{ Form::close(); }}
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

		$('.choose-form').click(function(e){
			if(confirm("დარწმუნებული ხარ, რომ ირჩევ ამ აპლიკანტს?")){

			}else{
				e.preventDefault();
			}	
		});

		$('.close_project').click(function(e){
			if(confirm("დარწმუნებული ხარ, რომ გინდა პროექტის დახურვა?")){

			}else{
				e.preventDefault();
			}	
		});


		$( "#offerbtn" ).click(function() {
			$(".content").fadeTo( "slow", 0.1 );
			$( ".offer_wrapper" ).fadeIn( "slow") }
			)

		$( "#close_button" ).click(function() {
			$( ".offer_wrapper" ).hide();
			$(".content").fadeTo( "slow", 1 );
		}
		)

		$('.single_job').height($(document).height());

		$('.comment_reply').click(function(e){
			$( ".jobanswer" ).show("slow");

			var ansid = $(this).attr('id');
			ansid = ansid.substring(4);
			var textid = 'txtans-'+ansid;
			$("#"+textid).focus();


			$("#"+textid).focusout(function(){
    			setTimeout(function() {
		        	$(".jobanswer").hide("slow")
		    	}, 3000);
			});

		});

	</script>

	@stop