@extends('layouts.admin')
@section('content')

<div class="generator_wrapper">
	<form method="POST" name="generator" id="generator" action="{{URL::to('admin/generate')}}">
		{{ Form::input('text', 'link', '', ['class'=>'form-control pull-left link', 'id'=>'link', 'disabled']) }}
		{{ Form::submit('გენერაცია', ['class'=>'btn btn-primary pull-left generate'])}}
	</form>
</div>

<script>
jQuery(document).ready(function($){
    $('#generator').on('submit', function(){ 		 
        $.post(
            $(this).prop('action'),
            function(code){
               $('#link').prop("disabled", false); 
               code=$.trim(code);
               $('#link').val(code); 
            }
        ); 
        return false;
    }); 
});
</script>

@stop

