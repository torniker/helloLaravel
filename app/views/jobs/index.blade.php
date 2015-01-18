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