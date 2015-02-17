@extends('old.layouts.freelancer')
@section('content')

<table class="table table-bordered table-hover table-striped">
	<thead>
		<th class='col-xs-8'>Message</th>
		<th class='col-xs-2'>Price</th>
		<th class='col-xs-2'>Date</th>
		<th class='col-xs-2'></th>
	</thead>
	<tbody>
	@foreach($offers as $offer)
	<tr>
		<td>{{ $offer->message }}</td>
		<td>{{ $offer->price }} {{ $offer->currencyText() }}</td>
		<td>{{ $offer->created_at }}</td>
		<td><a class='btn btn-sm btn-primary' href="{{ URL::to('freelancer/projects',$offer->project_id) }} ">Open project</a></td>
	</tr>
	@endforeach
	</tbody>
</table>

@stop

