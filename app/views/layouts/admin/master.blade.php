@extends('layouts.master')
@section('master_head')
    @yield('head')
@stop
@section('master_body')
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
            	<li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Admin</strong>
                             </span> <span class="text-muted text-xs block">Actions <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        DW
                    </div>
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
        <div class="wrapper wrapper-content animated fadeInDown m-t-xs">
            <div class="row">
                <div class="col-lg-24">
                    @yield('body')
                </div>
            </div>
        </div>
        <div class="footer fixed">
        	@section('footer')
	            <div>
	                <strong>Copyright</strong> Dripway &copy; 2014-2015
	            </div>
            @show
        </div>
    </div>
</div>
@stop