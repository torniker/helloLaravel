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
    </form>
  </div>

  <div class="form-group" style="margin: 40px 0">
    <h4>ტრენინგები</h4>
    @foreach($trainings as $training)
    <div style="margin-top:5px" id="c_b">
      {{ Form::checkbox('trainings[]',$training->id,false,array('id' => $training->id, 'class'=>'trcheck')) }}
      {{ Form::label($training->id,$training->name, ['class'=>'control-label leftfive']) }}
      {{ Form::input('text', 'trlevel['.$training->id.']', '', ['class'=>'form-control trinp']) }}
    </div>
    @endforeach
    <?php  
    ?>
  </div>
</div>
</div>

<script>
  var ccounter = 0;

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

  function updateTextArea() {         
     var allVals = [];
     var str='';
     $('#c_b :checked').each(function() {
       allVals.push($(this).val());
       str=str+"&val_"+1+"="+$(this).val();
       if(ccounter==0){
        str = "?" + str; 
       }
       ccounter++;
     });
     if($('#link').val()){
        var val = $('#link').val();
        $('#link').val(val+str);
     }
   }
   $(function() {
     $('#c_b input').click(updateTextArea);
     updateTextArea();
   });
</script>

@stop

