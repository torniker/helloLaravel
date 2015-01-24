@extends('layouts.master')
@section('content')
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
		{{ Form::checkbox('trainings[]',$training->id,false,array('id' => $training->id)) }}
		{{ Form::label($training->id,$training->name, ['class'=>'control-label leftfive']) }}
		{{ Form::input('text', 'trlevel['.$training->id.']', '', ['class'=>'form-control']) }}
	</div>
	@endforeach
</div>
<div class="form-group">
	{{ Form::label('type', 'მომხმარებლის ტიპი', ['class'=>'control-label']); }}
	{{ Form::select('type', [1=>'სტუდენტი', 2=>'მომხმარებელი',3=>'კომპანია', 4=>'ადმინისტრატორი'], Input::old("type"), ['class'=>'form-control', 'id'=>'typeselector']); }}
</div>

<div class="myhidden">
	<div class="form-group">
		{{ Form::label('company_name', 'კომპანიის დასახელება', ['class'=>'control-label red']); }}
		{{ Form::input('text', 'company_name', Input::old("company_name"), ['class'=>'form-control', 'id'=>'company_name']) }}
	</div>

	<div class="form-group">
		{{ Form::label('identification_code', 'საიდენტიფიკაციო კოდი', ['class'=>'control-label red']); }}
		{{ Form::input('text', 'identification_code', Input::old("identification_code"), ['class'=>'form-control', 'id'=>'identification_code']) }}
	</div>
</div>

<input type="hidden" name="token" value="{{$_GET['token']}}"/> 

{{ Form::submit('რეგისტრაცია', ['class'=>'btn btn-primary'])}}

{{ Form::close(); }}

<script>
	$( document ).ready(function() {
    	var val = $( "#typeselector" ).val();
    	if (val==3) {
    		$(".myhidden").show();
    	};

    	$('input').iCheck({
				checkboxClass: 'icheckbox_square-red',
    			radioClass: 'iradio_square-red',
    			increaseArea: '20%' // optional
		});
	});
	$('#typeselector').on('change', function() {
		if(this.value==3){
			$(".myhidden").show("slow");
		}
		else{
			$(".myhidden").hide("slow");
		}
	});
</script>
@stop
</div>