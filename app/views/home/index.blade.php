@extends('layouts.master')
@section('content')
@if(Session::has('message'))
<div class="alert alert-{{ Session::get('message_type') }}">
	{{ Session::get('message') }}
</div>
@endif

<div class="filtration">
	<a id="filterskills">ფილტრაცია სკილებით</a>
	<div class="skills_wrapper">
	<form method="POST" action="/">
		@foreach($skills as $skill)
		<div class="col-md-2 nopadding columnwrap">
			{{ Form::checkbox('skill[]',$skill->id,false,array('id' => $skill->id)) }}
			{{ Form::label($skill->id,$skill->name , ['class'=>'control-label']) }}
			{{ Form::input('text', 'level['.$skill->id.']','',
			['class'=>'form-control filterlevel', 'id' => 'for_'.$skill->id, 'placeholder'=>'მინ. დონე','disabled'] ) }}
		</div>
		@endforeach
		<div class="clear"></div>
		{{ Form::submit('ფილტრაცია', ['class'=>'btn btn-primary'])}}
	</form>
	</div>
</div>

@foreach($users as $user)
<div class="profilewrapper left">
	<a class="profileimage left" href="show/{{$user->id}}">
		@if(!empty($user->avatar))
			<img src="{{URL::to('uploads/'.$user->avatar)}}" 
			width="100px" height="100px">
		@else
			<img src="http://fc07.deviantart.net/fs71/f/2012/145/4/b/death_note_avatar__l_by_lartovio-d513nsb.jpg" width="100px" height="100px">
		@endif
	</a>
	<div class="profileinfowrapper left">
		<a href="show/{{$user->id}}">{{ $user->firstname." ".$user->lastname }}</a>
		<div class="skilllist">
			@foreach($user->skills as $skill)
				<span>{{ $skill->name }}</span>
			@endforeach
		</div>
		<div class="trainingslist">
			@foreach($user->trainings as $training)
				<span>{{ $training->name }}</span>
			@endforeach
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
@endforeach

<script>
	$( document ).ready(function() {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-red',
			radioClass: 'iradio_square-red',
    			increaseArea: '20%' // optional
    		});
	});
	$('input').on('ifChecked', function(event){
		var inpId = 'for_'+this.id;
		$("#"+inpId).prop('disabled', false);
		$("#"+inpId).css("visibility", "visible");
	});
	$('input').on('ifUnchecked', function(event){
		var inpId = 'for_'+this.id;
		$("#"+inpId).prop('disabled', true);
		$("#"+inpId).css("visibility", "hidden");
	});

	$("#filterskills").click(function() {
		$(".skills_wrapper").toggle();
	});
</script>
@stop