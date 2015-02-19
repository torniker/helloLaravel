@extends('layouts.master')


@section('master_body')


<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">Hi</h1>
        </div>
        <h3>Welcome to Entity Project</h3>
        <p class = 'custom_margin'>Login in. To see it in action.</p>
        {{ Form::open(array('url' => 'login','method' => 'post')) }}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" required="" name="username">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" required="" name="password" type="password" value="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        {{ Form::close() }}
    </div>
</div>

@stop