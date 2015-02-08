@extends('old.layouts.admin')
@section('content')
{{ Form::open(array('route' => array('admin.user.update', $user->id), 'method' => 'PUT')) }}

<div class="form-group">
	{{ Form::label('firstname', 'Firstname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'firstname', $user->firstname, ['class'=>'form-control', 'id'=>'firstname']) }}
</div>

<div class="form-group">
	{{ Form::label('lastname', 'Lastname', ['class'=>'control-label']); }}
	{{ Form::input('text', 'lastname', $user->lastname, ['class'=>'form-control', 'id'=>'lastname']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'E-mail', ['class'=>'control-label']); }}
	{{ Form::input('text', 'email', $user->email, ['class'=>'form-control', 'id'=>'email']) }}
</div>

<div class="form-group">
	{{ Form::label('password', 'Password', ['class'=>'control-label']); }}
	{{ Form::input('password', 'password', '', ['class'=>'form-control', 'id'=>'password']) }}
</div>
<div class="form-group">
	{{ Form::label('gender', 'Gender', ['class'=>'control-label']); }}
	{{ Form::select('gender', [0=>'Female', 1=>'Male'], $user->gender, ['class'=>'form-control', 'id'=>'gender']); }}
</div>
@foreach($user->integrations as $integration)
	<div class="form-group">
		{{ Form::label($integration->service, $integration->service, ['class'=>'control-label']); }}
		{{ Form::input($integration->service, $integration->service, $integration->username, ['class'=>'form-control', 'id'=>'github']) }}
	</div>
@endforeach

<div class="form-group">
<h4>Courses</h4>
	
@foreach($courses as $course)
	{{$checked = false}}
	@foreach($user->courses as $user_course)
		@if($course->id==$user_course->id)
			<?php $checked = true ?> 
		@endif
	@endforeach
	<div class="col-md-4">
	{{ Form::checkbox('course[]',$course->id,$checked,array('id' => $course->id)) }}
	{{ Form::label($course->id,$course->name , ['class'=>'control-label']) }}
	{{ $score = '' }}
	@if($curCourse = $user->courses->find($course->id)) 
		<?php $score = $curCourse->pivot->score; ?>
	@endif
	{{ Form::input('text', 'score['.$course->id.']', $score, ['class'=>'form-control score_level'] ) }}
	</div>
@endforeach
</div> 


{{ Form::submit('Save', ['class'=>'btn btn-primary pull-right'])}}

{{ Form::close(); }}

<script type="text/javascript">
	
</script>


@stop