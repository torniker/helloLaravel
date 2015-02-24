@extends('layouts.guest')
@section('content')

<div class="job_add_form">
	<div class="job_form_center"> 
		{{ Form::open(array('url' => 'jobs/create', 'method' => 'POST', 'files'=>true,)) }}
		<div class="form-group">
			{{ Form::label('name', 'სათაური', ['class'=>'control-label']); }}
			{{ Form::input('text', 'heading', '', ['class'=>'form-control', 'id'=>'jobname']) }}
		</div>
		<div class="form-group" class="jobtext">
			{{ Form::label('content', 'ტექსტი', ['class'=>'control-label']); }}
			<textarea rows="10" name="content" class="form-control" id="jobcontent"></textarea>
		</div>
		<div class="form-group" class="jobprice">
			{{ Form::label('price', 'სავარაუდო ფასი', ['class'=>'control-label']); }}
			{{ Form::input('text', 'price', '', ['class'=>'form-control', 'id'=>'jobprice']) }}
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
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	$('#deadline').datepicker({
	});
	$('#expires').datepicker({
	});
</script>
@stop