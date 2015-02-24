@extends('layouts.master')
@section('content')
@if(isset($message))
<div class="alert alert-{{ Session::get('message_type') }}" style="margin-left:100px">
	{{ $message }}
</div>
@endif

<div class="jobswrapper">
	@foreach($jobs as $job)
	<div class="singlejobwrap">

		@if(!empty($job->picture))
		<img src="{{URL::to('uploads/'.$job->picture)}}" 
		width="200px" height="200px">
		@else
		<img src="http://fc07.deviantart.net/fs71/f/2012/145/4/b/death_note_avatar__l_by_lartovio-d513nsb.jpg" width="100px" height="100px">
		@endif

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
	</div>
	@endforeach
</div>

@stop