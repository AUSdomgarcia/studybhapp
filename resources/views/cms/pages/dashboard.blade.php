@extends('cms.templates.cms_template')

@section('page-title', 'CMS | Generic')

@section('top-nav')
	<div class="top-menu">
	    <ul class="nav navbar-nav pull-right">
	        <li class="dropdown dropdown-quick-sidebar-toggler">
	            <a href="{{ route('logout') }}" class="dropdown-toggle"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="icon-logout"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
	        </li>
	    </ul>
	</div>
@endsection

@section('side-nav')
	<div class="page-sidebar-wrapper">
    	<div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 46px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                
                <li class="nav-item start ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start ">
                            <a href="index.html" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard 1</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="heading">
                    <h3 class="uppercase">Features</h3>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">UI Features</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="ui_metronic_grid.html" class="nav-link ">
                                <span class="title">Metronic Grid System</span>
                            </a>
                        </li>
                    </ul>
                </li>
    	    </ul>
        </div>
	</div>
@endsection

@section('content')
	Hello content
@endsection