@extends('layouts.master')
@section('content')

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
			 	<input type="hidden" value="{{$user->id}}" name="applicant">
			 	<input type="hidden" value="{{$job->id}}" name="job">
			 	{{ Form::submit('აპლიკაცია', ['class'=>'btn btn-primary pull-left'])}}
			 </form>
		</div>
		<div class="clear"></div>
		@endif
	</div>
</div>

@stop