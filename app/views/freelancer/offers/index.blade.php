@extends('layouts.freelancer.master')
@section('body')

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th class='col-xs-8'>Message</th>
		<th class='col-xs-2 align'>Price</th>
		<th class='col-xs-2 align'>Date</th>
		<th class='col-xs-2'></th>
	</thead>
	<tbody class = "text-align:center">
	@foreach($offers as $offer)
	<tr>
		<td>{{ $offer->message }}</td>
		<td class = "align"><b>{{ $offer->price }} {{ $offer->currencyText() }}</b></td>
		<td class = "align">{{ $offer->created_at }}</td>
		<td class = "align-center"><a class='btn btn-sm btn-primary' href="{{ URL::to('freelancer/projects',$offer->project_id) }} ">Open project</a></td>
	</tr>
	@endforeach
	</tbody>
</table>

@stop

