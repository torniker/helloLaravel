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
		@foreach($skills as $skill)
		<div class="col-md-2 nopadding columnwrap">
			{{ Form::checkbox('skill[]',$skill->id,false,array('id' => $skill->id)) }}
			{{ Form::label($skill->id,$skill->name , ['class'=>'control-label']) }}
			{{ Form::input('text', 'level['.$skill->id.']','',
			['class'=>'form-control filterlevel', 'id' => 'for_'.$skill->id, 'placeholder'=>'მინ. დონე','disabled'] ) }}
		</div>
		@endforeach
		<div class="clear"></div>
	</div>
</div>

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>სახელი/გვარი</th>
		<th>სქესი</th>
		<th>სკილები</th>
		<th>ტრენინგები</th>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->firstname }} {{ $user->lastname }}</td>
			<td>{{ $user->getGender() }}</td>
			<td style="width:400px">
				@foreach($user->skills as $skill)
				<span class="label label-default">{{ $skill->name }}</span>
				@endforeach
			</td>
			<td style="width:400px">
				@foreach($user->trainings as $training)
				<span class="label label-default">{{ $training->name }}</span>
				@endforeach
			</td>
		</tr>
		@endforeach
	</tbody>
	
</table>
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