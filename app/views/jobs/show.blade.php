@extends('layouts.master')
@section('content')

@if(Auth::check())
<?php $user=Auth::user() ?>
@endif


<div class="jobswrapper">
	<div class="singlejobwrap">
		<a href="{{URL::to("jobs/show/$job->id")}}" class="jobheading">
			{{ $job->heading }}
		</a>
		<div class="jobtext">
			{{ $job->content }}
		</div>
		<div class="jobprice">
			{{ $job->price }}
		</div>
		<div class="jobauthor">
			{{ $job->author }}
		</div>
		@if(isset($user))
		<div>
			<form method="POST" action="{{URL::to('jobs/apply')}}">
				<input type="text" placeholder="თქვენი ფასი" name="bid" class="form-control pull-left" style="margin-right:5px">
				<input type="hidden" value="{{$job->id}}" name="job">
				{{ Form::submit('დაბიდვა', ['class'=>'btn btn-primary pull-left'])}}
			</form>
		</div>
		<div class="clear"></div>
		@endif

		<div class="bids_wrapper">
			@foreach($bids as $bid)
			<div class="single_bid">
				<div class="left">
					<a class="profileimage" href="show/{{$user->id}}">
						@if(!empty($bid['avatar']))
						<img src="{{URL::to('uploads/'.$bid['avatar'])}}" 
						width="100px" height="100px">
						@else
						<img src="http://fc07.deviantart.net/fs71/f/2012/145/4/b/death_note_avatar__l_by_lartovio-d513nsb.jpg" width="100px" height="100px">
						@endif
					</a>
				</div>
				<div class="left">
					<a class="bidder_name" href="{{URL::to('show/'.$bid['applicant_id'])}}">
						{{$bid['applicant_name']}}
					</a>
					<div class="bid_price">
						{{$bid['bid']}}
					</div>
				</div>
				<div class="clear"></div>
			</div>
			@endforeach
		</div>


	</div>
	@if(!empty($comments))
	@foreach($comments as $comment)
	<div class="comment_wrapper">
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
					<input type="submit" value="წაშლა" class="delstyle">
				</form>
			</div>
			@endif
			@endif
			<div>
				<a href="{{URL::to('show/'.$comment->user_id)}}">{{$usernames[$comment->user_id]}}</a>
			</div>
			<div>
				{{$comment->text}}
			</div>
		</div>
		@endforeach
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
	</script>

	@stop