@extends('layouts.admin')
@section('content')
@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}">
        {{ Session::get('message') }}
    </div>
@endif
<p class="text-right">
	<a href="{{ URL::to('admin/trainings/create') }}" class="btn btn-success">
		<i class="glyphicon glyphicon-plus"></i> ტრენინგის დამატება
	</a>
</p>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>დასახელება</th>
		
		<th colspan="2" class="col-xs-1">მოქმედება</th>
	</thead>
	<tbody>
	@foreach($trainings as $training)
	<tr>
		<td>
			<a href="{{ URL::to('admin/training/'.$training->id) }}">
				{{ $training->name }}
			</a>
		</td>
		
		<td>
			<a href="{{ URL::to('admin/trainings/edit/'.$training->id) }}" class="btn btn-primary btn-xs">
				<i class="glyphicon glyphicon-pencil"></i>
			</a>
		</td>
		<td>
			{{ Form::open(array('url' => 'admin/trainings/delete/'.$training->id, 'method' => 'POST')) }}
	    		<button type="submit" class="delete btn btn-default btn-xs">
	    			<i class="glyphicon glyphicon-remove text-danger"></i>
	    		</button>
			{{ Form::close() }}
		</td>
	</tr>
	@endforeach
	</tbody>
	
</table>
<script type="text/javascript">
	$('form.delete_form').submit(function(e){
		if(confirm("დარწმუნებული ხარ რომ გინდა წაშლა?")){

		}else{
			e.preventDefault();
		}	
	});
</script>
@stop

