<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title> @yield('page-title') </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
    <link href="{{ asset('admin_assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/admin/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/css/components.css') }}" id="style_components') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/admin/layout/css/layout.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/admin/layout/css/themes/darkblue.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{ asset('admin_assets/admin/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>

    @yield('styles')

</head>

<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">

<input type="hidden" name="_token" id="site_token" value="{{ csrf_token() }}" />

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<div style="margin: 10px;font-size: 20px;color:#FFF" class="logo-default">GENERIC | CMS</div>
			<!-- <a href="index.html"> -->
			<!-- <img src="{{ asset('admin_assets/admin/layout/img/logo.png') }}" alt="logo" class="logo-default"/> -->
			<!-- </a> -->
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		
        @if( \Request::route()->getName() != 'login' )
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle"> <!--http://beloacne.dev/admin/user_profile-->
                            <span class="username username-hide-on-mobile">{{ Auth::user()->name }}</span>
                        </a>
                    </li>

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
        @endif

	</div>
</div>

<div class="clearfix"></div>

@if( \Request::route()->getName() != 'login' )
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 46px">
                <li class="sidebar-toggler-wrapper">
                    <div class="sidebar-toggler"></div>
                </li>

                <li class="heading">
                    <h3 class="uppercase">Website Content</h3>
                </li>

                <li class="nav-item start ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">Pages</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start ">
                            <a href="/admin/page1" class="nav-link ">
                                <span class="title">Home</span>
                            </a>
                        </li>
                        <li class="nav-item start ">
                            <a href="/admin/page1" class="nav-link ">
                                <span class="title">About</span>
                            </a>
                        </li>
                        <li class="nav-item start ">
                            <a href="/admin/page1" class="nav-link ">
                                <span class="title">FAQ</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Website Content</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="#" class="nav-link ">
                                <span class="title">Default Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="heading">
                    <h3 class="uppercase">User Setting</h3>
                </li>

                <!-- Admin -->
                <li class=" nav-item">
                        <a href="javascript:;">
                            <i class="icon-settings"></i>
                            <span class="title">Admin</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item ">
                                <a href="{{ url('admin/user_settings') }}">User Settings</a>
                            </li>
                        </ul>
                    </li>

                <!-- My Account -->
                <li class="">
                    <a href="#">
                        <i class="icon-user"></i>
                        <span class="title">My Account</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
@endif

<div class="{{ \Request::route()->getName() == 'login' ? 'page-container' : 'page-content-wrapper' }}" style="padding-top: 46px !important;">
    <div class="{{ \Request::route()->getName() == 'login' ? '' : 'page-content' }}">
        @yield('content')
    </div>
</div>

<div class="page-footer">
	<div class="page-footer-inner">
        <!--copyright-->
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>

<!--[if lt IE 9]>
<script src="{{ asset('admin_assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('admin_assets/global/plugins/excanvas.min.js') }}"></script> 
<![endif]-->

<script src="{{ asset('admin_assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>

<!--
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
-->

<!-- 
    <script src="{{ asset('admin_assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
-->

<script src="{{ asset('admin_assets/global/scripts/metronic.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/layout/scripts/demo.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/pages/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/pages/scripts/tasks.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/admin/pages/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script>
	jQuery(document).ready(function() {    
	   Metronic.init(); // init metronic core componets
	   Layout.init(); // init layout
	   QuickSidebar.init(); // init quick sidebar
	   Demo.init(); // init demo features
	   Index.init();   
	   // Index.initDashboardDaterange();
	   // Index.initJQVMAP(); // init index page's custom scripts
	   // Index.initCalendar(); // init index page's custom scripts
	   // Index.initCharts(); // init index page's custom scripts
	   // Index.initChat();
	   // Index.initMiniCharts();
	   // Tasks.initDashboardWidget();
	});
</script>

@yield('scripts')

</body>

</html>