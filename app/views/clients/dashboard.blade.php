@extends('layouts.master')
@section('content')
	<div class="center">
		<div class="hello">გამარჯობა! შენ შემოსული ხარ როგორც:
			<span class="mon">
				{{ $user->username }}
			</span>
				(
				<a href="logout" class="logout">
					გამოსვლა
				</a>
				)
		</div>
		<div style="margin-bottom:30px">
			შენი მონაცემები: (<a href="{{URL::to('editprofile')}}" class="logout">პროფილის რედაქტირება</a>)
		</div>
		<div style="margin-bottom:30px">
			<a href="{{URL::to('jobs/add')}}" class="logout">პროექტის დამატება</a>
		</div>
		<div class="hello">
			<div class="item">
				<span class="before">სახელი:</span>
				<span class="mon">
					{{$user->firstname}}
				</span>
			</div>
			<div class="item">
				<span class="before">გვარი:</span>
				<span class="mon">
					{{$user->lastname}}
				</span>
			</div>
			<div class="item">
				<span class="before">ელ-ფოსტა:</span>
				<span class="mon">
					{{$user->email}}
				</span>
			</div>
			
			
		</div>
	</div>
@stop