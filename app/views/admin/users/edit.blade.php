@extends('layouts.admin-new')
@section('content')
<div class="job_add_form">
	<div class="job_form_center"> 
{{ Form::open(array(
		'route' => array('admin.user.update', $user->id),
		'files'=>true,
		'method' => 'PUT'
	)) }}

<div class="form-group">
	{{ Form::label('firstname', 'სახელი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'firstname', $user->firstname, ['class'=>'form-control', 'id'=>'firstname']) }}
</div>

<div class="form-group">
	{{ Form::label('lastname', 'გვარი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'lastname', $user->lastname, ['class'=>'form-control', 'id'=>'lastname']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'ელ-ფოსტა', ['class'=>'control-label']); }}
	{{ Form::input('text', 'email', $user->email, ['class'=>'form-control', 'id'=>'email']) }}
</div>

<div class="form-group">
	{{ Form::label('password', 'პაროლი', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'სქესი', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'Female', 1=>'Male'], $user->gender, ['class'=>'form-control', 'id'=>'gender']); }}
</div>
<div class="form-group">
	{{ Form::label('file', 'ავატარი', ['class'=>'control-label']); }}
	{{ Form::file('file','',array('id'=>'','class'=>'')) }}
</div>

<div class="form-group">
	<h4>skills</h4>
	<?php
		
	?>
	@foreach($skills as $skill)

	{{$checked = false; $disabled='disabled'; $sklevel='';}}
	@foreach($user->skills as $user_skill)
	@if($skill->id==$user_skill->id)
	<?php 
		$checked = true; 
		$disabled='';
		$sklevel = $user_skill->pivot->level; 
	 ?> 
	@endif
	@endforeach
	<div class="col-md-4">
		{{ Form::checkbox('skill[]',$skill->id,$checked,array('id' => $skill->id, 'class'=>'skcheckbox')) }}
		{{ Form::label($skill->id,$skill->name , ['class'=>'control-label']) }}
		{{ Form::input('text', 'level['.$skill->id.']', $sklevel, 
		['class'=>'form-control','id' => 'for_'.$skill->id, $disabled] ) }}
	</div>
	@endforeach
	<div class="clear"></div>
</div>

<div class="form-group trlist">
	<h4>ტრენინგები</h4>
	<?php
		
	?>
	@foreach($trainings as $training)

	{{$trchecked = false; $trdisabled='disabled'; $trlevel='';}}
	@foreach($user->trainings as $user_training)
	@if($training->id==$user_training->id)
	<?php 
		$trchecked = true; 
		$trdisabled='';
		$trlevel = $user_training->pivot->level; 
	 ?> 
	@endif
	@endforeach
	<div class="col-md-4">
		{{ Form::checkbox('training[]',$training->id,$trchecked,array('id' => 'tr'.$training->id, 'class'=>'trcheckbox')) }}
		{{ Form::label('tr'.$training->id,$training->name , ['class'=>'control-label']) }}
		{{ Form::input('text', 'trlevel['.$training->id.']', $trlevel, 
		['class'=>'form-control','id' => 'trfor_'.$training->id, $trdisabled] ) }}
	</div>
	@endforeach
	<div class="clear"></div>
</div>


{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}
</div>
</div>


<script type="text/javascript">

	$('.job_form_center').height($(document).height());

	$('.skcheckbox').change(function() {
		var inpId = 'for_'+this.id;
		if(this.checked) {
			$("#"+inpId).prop('disabled', false);
		}
		else{
			$("#"+inpId).prop('disabled', true);
		}
	});
	$('.trcheckbox').change(function() {
		var temp = this.id;
		temp = temp.substring(2,temp.length);
		var inpId = 'trfor_'+temp;
		if(this.checked) {
			$("#"+inpId).prop('disabled', false);
		}
		else{
			$("#"+inpId).prop('disabled', true);
		}
	});
</script>


@stop