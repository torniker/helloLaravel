@extends('layouts.admin-new')
@section('content')
<?php $trainings = Training::all(); ?>
<div class="job_add_form">
  <div class="job_form_center"> 
    <div class="generator_wrapper">    
     <form method="POST" name="generator" id="generator" action="{{URL::to('admin/generate')}}">
      {{ Form::input('text', 'link', '', ['class'=>'form-control pull-left link', 'id'=>'link', 'disabled']) }}
      {{ Form::submit('გენერაცია', ['class'=>'btn btn-success pull-left generate'])}}
      <div class="clear"></div>

      <div class="form-group" style="margin: 40px 0">
        <h4>ტრენინგები</h4>
        @foreach($trainings as $training)
        <div style="margin-top:5px" id="c_b">
          {{ Form::checkbox('trainings[]',$training->id,false,array('id' => $training->id, 'class'=>'trcheck')) }}
          {{ Form::label($training->id,$training->name, ['class'=>'control-label leftfive']) }}
          {{ Form::input('text', 'trlevel['.$training->id.']', '', ['class'=>'form-control trinp']) }}
        </div>
        @endforeach
      </div>
    </form>
  </div>
</div>
</div>

<script>

  jQuery(document).ready(function($){
    $('#generator').on('submit', function(){    
      var data = $("form").serialize();
      $.ajax({
        url:  $(this).prop('action'),
        type: "POST",
        async: true,
        cache: false,
        data: data,
        success: function(data){ 
          $('#link').prop("disabled", false); 
          data=$.trim(data);
          $('#link').val(data); 
       }
   });
      return false;
    });
  });


$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-red',
    radioClass: 'iradio_square-red',
            increaseArea: '20%' // optional
          });
});

</script>

@stop

