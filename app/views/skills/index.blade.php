@extends('layouts.master')
@section('content')

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>Skill</th>
		<th></th>
		<th></th>
	</thead>
	<tbody id="skills-list"> 
	@foreach($skills as $skill)
	<tr>
		<td>{{ $skill->name }}</td> 
		<td><a href="{{ action('SkillsController@edit',$skill->id) }}">Edit</a></td> 
		
	</tr>
	@endforeach
	</tbody>
	
</table>

@stop