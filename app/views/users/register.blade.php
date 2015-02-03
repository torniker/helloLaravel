@extends('layouts.guest')
@section('content')

<div class="job_add_form">
	<div class="job_form_center"> 
		<div class="wrapper"> 
			<div class="errors" style="margin-bottom:20px">
				@if($errors->any())
				@foreach($errors->all() as $error)
				<div class="erroritem">{{ $error }}</div>
				@endforeach
				@endif
			</div>
			{{ Form::open(array('url'=>URL::to('storestud'), 'method' => 'POST')) }}

			<div class="form-group">
				{{ Form::label('username', 'ნიკი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'username', Input::old("username"), ['class'=>'form-control', 'id'=>'username']) }}
			</div>

			<div class="form-group">
				{{ Form::label('firstname', 'სახელი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'firstname', Input::old("firstname"), ['class'=>'form-control', 'id'=>'firstname']) }}
			</div>

			<div class="form-group">
				{{ Form::label('lastname', 'გვარი', ['class'=>'control-label']); }}
				{{ Form::input('text', 'lastname', Input::old("lastname"), ['class'=>'form-control', 'id'=>'lastname']) }}
			</div>

			<div class="form-group">
				{{ Form::label('email', 'ელ-ფოსტა', ['class'=>'control-label']); }}
				{{ Form::input('text', 'email', Input::old("email"), ['class'=>'form-control', 'id'=>'email']) }}
			</div>

			<div class="form-group">
				{{ Form::label('password', 'პაროლი', ['class'=>'control-label']); }}
				{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
			</div>

			<div class="form-group" style="margin: 40px 0">
				<h4>ტრენინგები</h4>
				@foreach($trainings as $training)
				<div style="margin-top:5px">
					{{ Form::checkbox('trainings[]',$training->id,false,array('id' => $training->id, 'class'=>'trcheck')) }}
					{{ Form::label($training->id,$training->name, ['class'=>'control-label leftfive']) }}
					{{ Form::input('text', 'trlevel['.$training->id.']', '', ['class'=>'form-control']) }}
					<?php $trs[]=$training->name; ?>
				</div>
				@endforeach
				<?php 
				$trs = array_flip(array_map(function($el){ return $el + 1; }, array_flip($trs))); 
				?>
			</div>


		<div class="myhid">
			<div class="form-group" style="margin: 40px 0">
				<h4>ძირითადი პროფილი</h4>
				{{ Form::select('mainprofile', array('default' => 'აირჩიეთ ძირითადი პროფილი') + $trs, '', ['class'=>'form-control', 'id'=>'typeselector']); }}
			</div>
		</div>

		{{ Form::submit('რეგისტრაცია', ['class'=>'btn btn-success'])}}
		</div>
	</div>
</div>

<input type="hidden" name="token" value="{{$_GET['token']}}"/> 


{{ Form::close(); }}

<script type="text/javascript">
	$(".trcheck").click(function()
	{
		var countchecked = $("input:checkbox:checked").length;
		if(countchecked>1){
			$(".myhid").show();
		}else{
			$(".myhid").hide();
		}
	})
</script>

@stop
