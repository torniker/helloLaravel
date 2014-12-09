@extends('layouts.admin')
@section('content')

<h1>
	{{ $skill->name }}
	<span class="label label-default">{{ $skill->count() }} Users</span>
</h1>
@stop