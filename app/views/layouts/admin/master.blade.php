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
                                <li><a href="{{ URL::to('account/logout') }}">Logout</a></li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        DW
                    </div>
                </li>
                <li class="{{ $activeMenu == 'admin/domains' ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Domains</span>  <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ $activeSecondLevelMenu == 'admin/domains/view' ? 'active' : '' }}"><a href="{{ URL::to('admin/domains') }}">View domains</a></li>
                        <li class="{{ $activeSecondLevelMenu == 'admin/domains/create' ? 'active' : '' }}"><a href="{{ URL::to('admin/domains/create') }}">Import domains</a></li>
                    </ul>
                </li>
                <li class="{{ $activeMenu == 'admin/users' ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{ $activeSecondLevelMenu == 'admin/users/view' ? 'active' : '' }}"><a href="{{ URL::to('admin/users') }}">View users</a></li>
                        <li class="{{ $activeSecondLevelMenu == 'admin/users/create' ? 'active' : '' }}"><a href="{{ URL::to('admin/users/create') }}">Create an user</a></li>
                    </ul>
                </li>
                <li class="{{ $activeMenu == 'admin/transactions' ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/transactions') }}"><i class="fa fa-money"></i> <span class="nav-label">Transactions</span> </a>
                </li>
                <li class="{{ $activeMenu == 'admin/settings' ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/settings') }}"><i class="fa fa-gears"></i> <span class="nav-label">Settings</span> </a>
                </li>
                <li class="{{ $activeMenu == 'admin/stats' ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/stats') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Statistics</span> </a>
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
                        <a href="{{ URL::to('account/logout') }}">
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