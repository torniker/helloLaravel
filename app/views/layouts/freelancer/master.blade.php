<?php
    $user = Auth::user();
?>

@extends('layouts.master')

@section('master_body')
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
            	<li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->username }}</strong>
                             </span> <span class="text-muted text-xs block">Actions <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        DW
                    </div>
                </li>
                <li class="">
                    <a href="{{ URL::to('freelancer/projects') }}"><i class="fa fa-th"></i> <span class="nav-label">All Projects</span></a>
                </li>
                <li class="">
                    <a href="{{ URL::to('freelancer/projects/my') }}"><i class="fa fa-desktop"></i> <span class="nav-label">My Projects</span></a>
                </li>
                <li class="">
                    <a href="{{ URL::to('freelancer/profile') }}"><i class="fa fa-user"></i> <span class="nav-label">Profile</span></a>
                </li>
                <li class="">
                    <a href="{{ URL::to('freelancer/offers') }}"><i class="fa fa-star"></i> <span class="nav-label">My Offers</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ URL::to('logout') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-24">
                    @yield('body')
                </div>
            </div>
        </div>
        <div class="footer fixed">
        	@section('footer')
	            <div>
	                <strong>Copyright</strong> Hello Laravel &copy; 2014-2015
	            </div>
            @show
        </div>

    </div>
</div>
@stop