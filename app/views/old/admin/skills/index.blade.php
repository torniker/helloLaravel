@extends('old.layouts.admin')
@section('content')
@if(Session::has('message'))
    <div class="alert alert-{{ Session::get('message_type') }}">
        {{ Session::get('message') }}
    </div>
@endif
<p class="text-right">
	<a href="{{ URL::to('admin/skill/create') }}" class="btn btn-success">
		<i class="glyphicon glyphicon-plus"></i> Create Skill
	</a>
</p>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Firstname/Lastname</th>
		
		<th colspan="2" class="col-xs-1">Action</th>
	</thead>
	<tbody>
	@foreach($skills as $skill)
	<tr>
		<td>
			<a href="{{ URL::to('admin/skill/'.$skill->id) }}">
				{{ $skill->name }}
			</a>
		</td>
		
		<td>
			<a href="{{ URL::to('admin/skill/'.$skill->id.'/edit') }}" class="btn btn-primary btn-xs">
				<i class="glyphicon glyphicon-pencil"></i>
			</a>
		</td>
		<td>
			{{ Form::open(array('route' => array('admin.skill.destroy', $skill->id), 'method' => 'delete' , 'class' => 'delete_form')) }}
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
		if(confirm("Do you really want to delete")){

		}else{
			e.preventDefault();
		}	
	});
</script>
@stop

