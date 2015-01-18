@extends('layouts.admin')
@section('content')
<div style="width:400px">
{{ Form::open(array('url' => 'jobs/create', 'method' => 'POST')) }}
<div class="form-group">
	{{ Form::label('name', 'სათაური', ['class'=>'control-label']); }}
	{{ Form::input('text', 'heading', '', ['class'=>'form-control', 'id'=>'name']) }}
</div>
<div class="form-group" class="jobtext">
	{{ Form::label('content', 'ტექსტი', ['class'=>'control-label']); }}
	<textarea rows="10" name="content" class="form-control" id="content"></textarea>
</div>
<div class="form-group" class="jobprice">
	{{ Form::label('name', 'სავარაუდო ფასი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'price', '', ['class'=>'form-control', 'id'=>'name']) }}
</div>
{{ Form::input('hidden', 'author', $user->id) }}
{{ Form::submit('დამატება', ['class'=>'btn btn-primary pull-left'])}}

{{ Form::close(); }}
</div>
@stop