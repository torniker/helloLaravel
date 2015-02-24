@extends('layouts.guest')
@section('content')
@if(Session::has('message'))
<div class="alert alert-{{ Session::get('message_type') }}">
	{{ Session::get('message') }}
</div>
@endif
@if(null!==Session::get('msg'))
<div class="alert alert-warning">
  <a href="#" class="close" data-dismiss="alert">&times;</a>
  {{ Session::get('msg') }}
</div>
@endif

<div class="left scroll">
	@foreach($users as $user)
	<div class="row users_row left">
		<div class="single_user">
      <div class="well profile">
        <div class="col-sm-12 trainings_wrapper">
          <div class="col-xs-12 col-sm-8">
            <h2>
             <a href="{{URL::to('show/'.$user->id)}}" class="jtextfill mylink"
              style="width:200px;height:34px;">
              <span class="bigtext">{{ $user->firstname." ".$user->lastname }}</span>
            </a>
          </h2>
          <div><strong>ძირითადი პროფილი </strong></div>
          <div class="main_training">
            {{Training::find($user->mainprofile)->name}}
          </div> 
          <p><strong>ტრენინგები: </strong>
            <?php $index = 0;  $go = true; ?>
            @foreach($user->trainings as $training)
            <?php $index++; ?>
            @if($go)
            <a href="{{URL::to('filter/'.$training->id)}}" class="reset">
              <span class="tags">{{$training->name}}</span>
            </a> 
            <?php 
            if($index>2){ 
              $go=false;
              ?>
              <a href="{{URL::to('show/'.$user->id)}}" class="inlinelink"><span class="tags more">...</span></a>
              <?php
            }
            ?>
            @else
            @endif
            @endforeach
          </p>
        </div>             
        <div class="col-xs-12 col-sm-4 text-center">
          <figure>
           @if(empty($user->avatar))
           <a href="{{URL::to('show/'.$user->id)}}"><img src="{{URL::to('uploads/default_avatar.png')}}" alt="" class="img-circle img-responsive"></a>
           @else
           <a href="{{URL::to('show/'.$user->id)}}"><img src="{{URL::to('uploads/'.$user->avatar)}}" width="100px" height="100px"></a>
           @endif
           <figcaption class="ratings">
            <div class="point">ITDC Point: {{$user->point}}</div>
            <?php $width = $user->point/100*120 ?>
            <div class="point_slider">
             <div class="point_slide" style="width:{{$width}}px"></div>
           </div>
         </figcaption>
       </figure>
     </div>
   </div>            
   <div class="col-xs-12 divider text-center">
     <a class="col-xs-12 col-sm-4 emphasis githublink" id="{{'gt-'.$user->id}}" href="{{$user->github}}" onclick="gitFunction(this.id)">
      <button class="btn btn-success btn-block my_btn github"> Github </button>
    </a>
    <div class="col-xs-12 col-sm-4 emphasis">
      <a href="{{URL::to('show/'.$user->id)}}" class="emphasis">
        <button class="btn btn-info btn-block my_btn">
          <span class="fa fa-user"></span> პროფილი 
        </button>
      </a>
    </div>
    <div class="col-xs-12 col-sm-4 emphasis">
    <a class="btn-group dropup btn-block fblink" id="{{'fb-'.$user->id}}" href="{{$user->facebook}}" onclick="fbFunction(this.id)">
        <button type="button" class="btn btn-primary my_btn facebook"> Facebook </button>
      </a>
    </div>
  </div>
</div>                 
</div>
</div>
@endforeach
<div class="clear"></div>
<?php echo $users->links(); ?>
</div>

<script>
 $(function() {
  $('.scroll').jscroll({
    autoTrigger: true,
    nextSelector: '.pagination li.active + li a', 
    contentSelector: 'div.scroll',
    callback: function() {
     $('.pagination').css("display:none");
     $('.navbar-default').height($(document).height());
   }
 });
});

 $(".bigtext").bigText({
  rotateText: null,
  fontSizeFactor: 0.8,
  maximumFontSize: 20,
  limitingDimension: "both",
  horizontalAlign: "left",
  verticalAlign: "center",
  textAlign: "left"
});

 function fbFunction(id) {
  var href = $('#'+id).attr('href');
  if(!href){
   sweetAlert("არ აქვს ფეისბუქი");
   event.preventDefault();
 }
}

function gitFunction(id) {
  var href = $('#'+id).attr('href');
  if(!href){
   sweetAlert("არ აქვს გიტჰაბი");
   event.preventDefault();
 }
}
</script>

</script>

@stop