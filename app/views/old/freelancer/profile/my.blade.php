@extends('old.freelancer.profile.layout')

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
	<div class='clearfix margin-bottom'>
		<button type="button" id="modal_launcher" class="btn btn-primary col-xs-6" data-toggle="modal" data-target="#edit-profile">
		  Edit
		</button>
		@if(!$github)
			<a href='https://github.com/login/oauth/authorize?client_id=6b8637f220950dcec79c' type="button" class="btn btn-success col-xs-5  pull-right">
			  Add Github
			</a>
		@else
			<a href='{{ URL::to("freelancer/profile/github/remove") }}' type="button" class="btn btn-danger col-xs-5  pull-right">
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
		<div class="panel panel-default">
		  <div class="panel-heading">GitHub details</div>
		  <div class="panel-body">
		    <ul class='attributes'>
		    	@if($github['location'])
		    		<li><span class='attribute'>Location:</span> <span class='value'>{{ $github['location'] }}</span></li>
		    	@endif
		    	@if($github['company'])
		    		<li><span class='attribute'>Company:</span> <span class='value'>{{ $github['company'] }}</span></li>
		    	@endif
		    	<li><span class='attribute'>Username:</span> <span class='value'><a href="https://github.com/{{ $github['login'] }}">{{ $github['login'] }}</a></span></li>
		    	<li><span class='attribute'>Public Repositories:</span> <span class='value'>{{ $github['public_repos'] }}</span></li>
		    	<li><span class='attribute'>Followers:</span> <span class='value'>{{ $github['followers'] }}</span></li>
		    </ul>
		  </div>
		</div>
	@stop
@endif

<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="edit-profileLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h4 class="modal-title" id="edit-profileLabel">Edit Profile</h4>
		  </div>
		   {{ Form::open(array('url' => ['freelancer/profile'], 'method' => 'put')) }}
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