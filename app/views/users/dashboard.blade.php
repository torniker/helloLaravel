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
			შენი მონაცემები: (<a href="editprofile" target="_blank" class="logout">პროფილის რედაქტირება</a>)
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
			<div class="item">
				<span class="before">სქესი:</span>
				<span class="mon">
					{{$user->gender}}
				</span>
			</div>
			<a class="mybtn" href="github">Github აუტენტიფიკაცია</a>
			<?php 
				session_start();
				//session_destroy();
				//var_dump($_SESSION); 
			?>
		</div>
	</div>
@stop