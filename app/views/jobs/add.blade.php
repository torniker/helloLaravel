@extends('layouts.master')
@section('content')

<div style="width:400px; margin-left:200px; margin-bottom:80px;">
{{ Form::open(array('url' => 'jobs/create', 'method' => 'POST', 'files'=>true,)) }}
<div class="form-group">
	{{ Form::label('name', 'სათაური', ['class'=>'control-label']); }}
	{{ Form::input('text', 'heading', '', ['class'=>'form-control', 'id'=>'name']) }}
</div>
<div class="form-group" class="jobtext">
	{{ Form::label('content', 'ტექსტი', ['class'=>'control-label']); }}
	<textarea rows="10" name="content" class="form-control" id="content"></textarea>
</div>
<div class="form-group" class="jobprice">
	{{ Form::label('price', 'სავარაუდო ფასი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'price', '', ['class'=>'form-control', 'id'=>'price']) }}
</div>

<div id="form-group" class="datepick">
	{{ Form::label('expires', 'აპლიკაციების მიღების ვადა', ['class'=>'control-label']); }}
	{{ Form::input('text', 'expires', '', ['class'=>'form-control', 'id'=>'expires']) }}
</div>
<div id="form-group" class="datepick">
	{{ Form::label('deadline', 'პროექტის დასრულების დედლაინი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'deadline', '', ['class'=>'form-control', 'id'=>'deadline']) }}
</div>

<div class="form-group" class="jobprice">
	{{ Form::label('website', 'ვებ-საიტის მისამართი', ['class'=>'control-label']); }}
	{{ Form::input('text', 'website', '', ['class'=>'form-control', 'id'=>'website']) }}
</div>

<div class="form-group">
	{{ Form::label('picture', 'სურათი', ['class'=>'control-label']); }}
	{{ Form::file('picture','',array('id'=>'picture','class'=>'')) }}
</div>


{{ Form::input('hidden', 'author', $user->id) }}
{{ Form::submit('დამატება', ['class'=>'btn btn-primary pull-left'])}}
{{ Form::close(); }}
</div>

<script type="text/javascript">
	$('#deadline').datepicker({
	});
	$('#expires').datepicker({
	});
</script>
@stop