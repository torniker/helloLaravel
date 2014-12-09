@extends('layouts.admin')
@section('content')

<h1>
	{{ $user->firstname }} {{ $user->lastname }}
	<span class="label label-default">{{ $user->gender }}</span>
</h1>
<div class="well well-sm">{{ $user->email }}</div>

<ul class="list-group">
	@foreach($user->phones as $phone)
	<li class="list-group-item">{{ $phone->phone }}</li>
	@endforeach
</ul>
@stop