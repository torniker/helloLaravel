@extends('layouts.master')
@section('content')
<div class="center">
	<form class="form-horizontal" role="form" method="post" action="doedit">
		<div class="errors" style="margin-bottom:20px">
			<div>{{ $errors->first('username') }}</div>
			<div>{{ $errors->first('password') }}</div>
			<div>{{ $errors->first('firstname') }}</div>
			<div>{{ $errors->first('lastname') }}</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">ნიკი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="username" 
				name="username" value="{{$user->username}}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">სახელი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="firstname" 
				name="firstname" value="{{$user->firstname}}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-3 control-label">გვარი</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="lastname" 
				name="lastname" value="{{$user->lastname}}">
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">პაროლი</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="password" name="password" placeholder="პაროლი">
			</div>
		<div class="form-group" style="margin-top:70px">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-default">რედაქტირება</button>
			</div>
		</div>
		<input type="hidden" name="id" value="{{$user->id}}">
	</form>
</div>
@stop