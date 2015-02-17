@extends('freelancer.profile.layout')
@section('feedback')
	<div class="ibox margin-bottom">
	<div class="ibox-title">
		<h4>
			temo
		</h4>
	</div>
	<div class="ibox-content">
		<p>asdlfkhsdkfj hask;fhg akfjgkl asjdnfkaj </p>
	</div>
</div>

<div class="ibox margin-bottom">
	<div class="ibox-title">
		<h4>
			tata
		</h4>
	</div>
	<div class="ibox-content">
		<p>asdlfkhsdkfj hask;fhg akfjgkl asjdnfkaj </p>
	</div>
</div>

<div class="ibox margin-bottom">
	<div class="ibox-title">
		<h4>
			nika
		</h4>
	</div>
	<div class="ibox-content">
		<p>asdlfkhsdkfj hask;fhg akfjgkl asjdnfkaj </p>
	</div>
</div>
@stop
@if($user->projects)
	@section('projects')
		<ol class='no-list-style'>
		@foreach($user->projects as $project)
			<li><a href="{{ URL::to('freelancer/projects',$project->id) }}">{{ $project->title }}</a></li>
		@endforeach
		</ol>
	@stop
@endif

@section('buttons')
	<div class='clearfix'>
		<button type="button" id="modal_launcher" class="btn btn-primary" data-toggle="modal" data-target="#edit-profile">
		  Edit
		</button>
		<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="edit-profileLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4 class="modal-title" id="edit-profileLabel">Edit Profile</h4>
			  </div>
			   {{ Form::open(array('url' => ['freelancer/profile'],'id' => 'form-edit', 'method' => 'put')) }}
				  <div class="modal-body">

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
					<div class="form-group">
						{{ Form::label('bio', 'Biography', ['class'=>'control-label']); }}
						{{ Form::textarea('bio', $user->bio, ['class'=>'form-control']); }}
					</div>
				  </div>
				  <div class="modal-footer">
				    {{ Form::submit('Edit', ['class'=>'btn btn-primary pull-right'])}}
				  </div>
					{{ Form::close(); }}
				</div>
			</div>
	</div>
	<script>
	$(function(){
		$('#form-edit').validate({
			rules:{
				firstname: {
					required: true
				},
				lastname: {
					required: true
				},
				email: {
					required:true
				}
				
			}
		})
	})
	</script>
		@if(!$github)
			<a href='https://github.com/login/oauth/authorize?client_id=6b8637f220950dcec79c' type="button" class="btn btn-success">
			  Add Github
			</a>
		@else
			<a href='{{ URL::to("freelancer/profile/github/remove") }}' type="button" class="btn btn-danger">
			  Remove Github
			</a>
		@endif
	</div>
@stop

@section('name')
	 ({{ $user->email }})
@stop

@if($github)
	@section('sidebar')
		<div class="ibox border-bottom">
		  <div class="ibox-title">GitHub details</div>
		  <div class="ibox-content">
		    <ul class='attributes'>
		    	@if($github['location'])
		    		<li><b class='attribute'>Location:</b> <span class='value'>{{ $github['location'] }}</span></li>
		    	@endif
		    	@if($github['company'])
		    		<li><b class='attribute'>Company:</b> <span class='value'>{{ $github['company'] }}</span></li>
		    	@endif
		    	<li><b class='attribute'>Username:</b> <span class='value'><a href="https://github.com/{{ $github['login'] }}">{{ $github['login'] }}</a></span></li>
		    	<li><b class='attribute'>Public Repositories:</b> <span class='value'>{{ $github['public_repos'] }}</span></li>
		    	<li><b class='attribute'>Followers:</b> <span class='value'>{{ $github['followers'] }}</span></li>
		    </ul>
		  </div>
		</div>
	@stop
@endif

