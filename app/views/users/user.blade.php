@extends('layouts.master')
@section('content')
	<div class="profilewrapper">
	<a class="profileimage left" href="show/{{$user->id}}">
		@if(!empty($user->avatar))
			<img src="{{URL::to('uploads/'.$user->avatar)}}" 
			width="100px" height="100px">
		@else
			<img src="http://fc07.deviantart.net/fs71/f/2012/145/4/b/death_note_avatar__l_by_lartovio-d513nsb.jpg" width="100px" height="100px">
		@endif
	</a>
	<div class="profileinfowrapper left">
		<a href="show/{{$user->id}}" style="display:block">{{ $user->firstname." ".$user->lastname }}</a>
		<div class="skilllist left">
			@foreach($user->skills as $skill)
				<div class="skill_item">
					{{ 
					'<div class="skill_name left">'.$skill->name.'</div>' . 
					'<div class="skill_level left">'.$skill->pivot->level.'</div>' 
					}}
					<div class="clear"></div>
				</div>
			@endforeach
		</div>
		<div class="trainingslist trainingsonprofile left">
			@foreach($user->trainings as $training)
				<div class="skill_name training_name">{{ $training->name }}</div>
			@endforeach
		</div>
		<div class="phonesonprofile left">
			@foreach($user->phones as $phone)
				<div class="phone_on_profile">
				<img src="{{URL::to('uploads/phone.png')}}" width="40px"> 
				{{ $phone->phone }}</div>
			@endforeach
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
@stop