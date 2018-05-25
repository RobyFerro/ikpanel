<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }} - @ikpanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="apple-touch-icon" href="{{ asset('ikpanel/pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ikpanel/pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('ikpanel/pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('pages/ico/152.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN Vendor CSS-->
    <link href="{{ asset('ikpanel/assets/plugins/pace/pace-theme-flash.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/font-awesome/css/font-awesome.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}"
          rel="stylesheet"
          type="text/css"
          media="screen"/>
    <link href="{{ asset('ikpanel/assets/plugins/bootstrap-select2/select2.css') }}"
          rel="stylesheet"
          type="text/css"
          media="screen"/>
    <link href="{{ asset('ikpanel/assets/plugins/switchery/css/switchery.min.css') }}"
          rel="stylesheet"
          type="text/css"
          media="screen"/>
    <!-- BEGIN Pages CSS-->
    <link href="{{ asset('ikpanel/pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{ asset('ikpanel/pages/css/pages.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('ikpanel/plugins/fontawesome-pro-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('ikpanel/assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!--[if lte IE 9]>
    <link href="{{ asset('ikpanel/pages/css/ie9.css') }}" rel="stylesheet" type="text/css"/>
    <![endif]-->
    @yield('initial_link')
    <script type="text/javascript">
        window.onload = function () {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{ asset('ikpanel/pages/css/windows.chrome.fix.css') }}" />'
        }

        if(ikpanel_url !== undefined){
            delete ikpanel_url;
        } // if

        var ikpanel_url = "{{ env('IKPANEL_URL') }}";
    </script>
</head>
<body class="fixed-header">
@yield('beforebody')
<!-- END Overlay Content !-->

<!-- region MODAL CARICAMENTO -->
<div class="modal fade fill-in" data-backdrop="static" data-keyboard="false" id="mloading-gui">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="text-align: center">
                <i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw"></i>
                <h2 id="mloading-message"></h2>
            </div>
        </div>
    </div>
</div>
<!-- endregion MODAL CARICAMENTO -->

<!--region MODAL CONFIRM-->
<div class="modal fade fill-in" data-backdrop="static" data-keyboard="false" id="mconfirm-gui" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h2 id="mconfirm-message">###</h2>
            </div>
            <div class="modal-footer" style="width: 100%;">
                <div class="btn-group" style="margin:0 auto">
                    <button type="button" id="mconfirm-ok" class="btn btn-info" style="min-width:100px;">OK</button>
                    <button type="button" id="mconfirm-cancel" class="btn btn-default" style="min-width:100px;">
                        Annulla
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--endregion END MODAL CONFIRM -->

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar" data-pages="sidebar">
    <div id="appMenu" class="sidebar-overlay-slide from-top">
    </div>
    <!-- BEGIN SIDEBAR HEADER -->
    <div class="sidebar-header">
        <img src="{{ asset('ikpanel/assets/img/ikpanel-white.png') }}"
             alt="logo"
             class="brand"
             data-src="{{ asset('ikpanel/assets/img/ikpanel-white.png') }}"
             data-src-retina="{{ asset('ikpanel/assets/img/ikpanel-white.png') }}"
             width="78"
             height="22">
        <div class="sidebar-header-controls">
            <button data-pages-toggle="#appMenu" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" type="button">
                <i class="fa fa-angle-down fs-16"></i>
            </button>
            <button data-toggle-pin="sidebar"
                    class="btn btn-link visible-lg-inline"
                    type="button"><i
                        class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR HEADER -->
    <!-- BEGIN SIDEBAR MENU -->
    <div class="sidebar-menu">
        <ul class="menu-items">
            @component('ikpanel::navigation',
            ['items' => \ikdev\ikpanel\App\Http\Controllers\ikpanelController::getUserMenu()])
            @endcomponent
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
<!-- START PAGE-CONTAINER -->
<div class="page-container">
    <!-- START PAGE HEADER WRAPPER -->
    <!-- START HEADER -->
    <div class="header ">
        {{--<!-- START MOBILE CONTROLS -->
        <div class="container-fluid relative">
            <!-- LEFT SIDE -->
            <div class="pull-left full-height visible-sm visible-xs">
                <!-- START ACTION BAR -->
                <div class="header-inner">
                    <a href="#"
                       class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5"
                       data-toggle="sidebar">
                        <span class="icon-set menu-hambuger"></span>
                    </a>
                </div>
                <!-- END ACTION BAR -->
            </div>
            <div class="pull-center hidden-md hidden-lg">
                <div class="header-inner">
                    <div class="brand inline">
                        <img src="{{ asset('ikpanel/assets/img/logo.png') }}"
                             alt="logo"
                             data-src="{{ asset('ikpanel/assets/img/logo.png') }}"
                             data-src-retina="{{ asset('ikpanel/assets/img/logo_2x.png') }}" width="78" height="22">
                    </div>
                </div>
            </div>
            <!-- RIGHT SIDE -->
            <div class="pull-right full-height visible-sm visible-xs">
                <!-- START ACTION BAR -->
                <div class="header-inner">
                    <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview"
                       data-toggle-element="#quickview">
                        <span class="icon-set menu-hambuger-plus"></span>
                    </a>
                </div>
                <!-- END ACTION BAR -->
            </div>
        </div>
        <!-- END MOBILE CONTROLS -->--}}
        <div class=" pull-left sm-table hidden-xs hidden-sm">
            <div class="header-inner">
                <div class="brand inline">
                    <img src="{{ asset('ikpanel/assets/img/ikpanel.png') }}"
                         alt="logo"
                         data-src="{{ asset('ikpanel/assets/img/ikpanel.png') }}"
                         data-src-retina="{{ asset('assets/img/ikpanel.png') }}"
                         width="78"
                         height="22">
                </div>
                {{--<!-- START NOTIFICATION LIST -->
                <ul class="notification-list no-margin hidden-sm hidden-xs b-grey b-l b-r no-style p-l-30 p-r-20">
                    <li class="p-r-15 inline">
                        <div class="dropdown">
                            <a href="javascript:;" id="notification-center" class="icon-set globe-fill"
                               data-toggle="dropdown">
                                <span class="bubble"></span>
                            </a>
                            <!-- START Notification Dropdown -->
                            <div class="dropdown-menu notification-toggle" role="menu"
                                 aria-labelledby="notification-center">
                                <!-- START Notification -->
                                <div class="notification-panel">
                                    <!-- START Notification Body-->
                                    <div class="notification-body scrollable">
                                        <!-- START Notification Item-->
                                        <div class="notification-item unread clearfix">
                                            <!-- START Notification Item-->
                                            <div class="heading open">
                                                <a href="#" class="text-complete pull-left">
                                                    <i class="pg-map fs-16 m-r-10"></i>
                                                    <span class="bold">Carrot Design</span>
                                                    <span class="fs-12 m-l-10">David Nester</span>
                                                </a>
                                                <div class="pull-right">
                                                    <div class="thumbnail-wrapper d16 circular inline m-t-15 m-r-10 toggle-more-details">
                                                        <div><i class="fa fa-angle-left"></i>
                                                        </div>
                                                    </div>
                                                    <span class=" time">few sec ago</span>
                                                </div>
                                                <div class="more-details">
                                                    <div class="more-details-inner">
                                                        <h5 class="semi-bold fs-16">“Apple’s Motivation - Innovation
                                                            <br>
                                                            distinguishes between <br>
                                                            A leader and a follower.”</h5>
                                                        <p class="small hint-text">
                                                            Commented on john Smiths wall.
                                                            <br> via pages framework.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Notification Item-->
                                            <!-- START Notification Item Right Side-->
                                            <div class="option" data-toggle="tooltip" data-placement="left"
                                                 title="mark as read">
                                                <a href="#" class="mark"></a>
                                            </div>
                                            <!-- END Notification Item Right Side-->
                                        </div>
                                        <!-- START Notification Body-->
                                        <!-- START Notification Item-->
                                        <div class="notification-item  clearfix">
                                            <div class="heading">
                                                <a href="#" class="text-danger pull-left">
                                                    <i class="fa fa-exclamation-triangle m-r-10"></i>
                                                    <span class="bold">98% Server Load</span>
                                                    <span class="fs-12 m-l-10">Take Action</span>
                                                </a>
                                                <span class="pull-right time">2 mins ago</span>
                                            </div>
                                            <!-- START Notification Item Right Side-->
                                            <div class="option">
                                                <a href="#" class="mark"></a>
                                            </div>
                                            <!-- END Notification Item Right Side-->
                                        </div>
                                        <!-- END Notification Item-->
                                        <!-- START Notification Item-->
                                        <div class="notification-item  clearfix">
                                            <div class="heading">
                                                <a href="#" class="text-warning-dark pull-left">
                                                    <i class="fa fa-exclamation-triangle m-r-10"></i>
                                                    <span class="bold">Warning Notification</span>
                                                    <span class="fs-12 m-l-10">Buy Now</span>
                                                </a>
                                                <span class="pull-right time">yesterday</span>
                                            </div>
                                            <!-- START Notification Item Right Side-->
                                            <div class="option">
                                                <a href="#" class="mark"></a>
                                            </div>
                                            <!-- END Notification Item Right Side-->
                                        </div>
                                        <!-- END Notification Item-->
                                        <!-- START Notification Item-->
                                        <div class="notification-item unread clearfix">
                                            <div class="heading">
                                                <div class="thumbnail-wrapper d24 circular b-white m-r-5 b-a b-white m-t-10 m-r-10">
                                                    <img width="30" height="30"
                                                         data-src-retina="{{ asset('ikpanel/assets/img/profiles/1x.jpg') }}"
                                                         data-src="{{ asset('ikpanel/assets/img/profiles/1.jpg') }}"
                                                         alt=""
                                                         src="{{ asset('ikpanel/assets/img/profiles/1.jpg') }}">
                                                </div>
                                                <a href="#" class="text-complete pull-left">
                                                    <span class="bold">Revox Design Labs</span>
                                                    <span class="fs-12 m-l-10">Owners</span>
                                                </a>
                                                <span class="pull-right time">11:00pm</span>
                                            </div>
                                            <!-- START Notification Item Right Side-->
                                            <div class="option" data-toggle="tooltip" data-placement="left"
                                                 title="mark as read">
                                                <a href="#" class="mark"></a>
                                            </div>
                                            <!-- END Notification Item Right Side-->
                                        </div>
                                        <!-- END Notification Item-->
                                    </div>
                                    <!-- END Notification Body-->
                                    <!-- START Notification Footer-->
                                    <div class="notification-footer text-center">
                                        <a href="#" class="">Read all notifications</a>
                                        <a data-toggle="refresh" class="portlet-refresh text-black pull-right" href="#">
                                            <i class="pg-refresh_new"></i>
                                        </a>
                                    </div>
                                    <!-- START Notification Footer-->
                                </div>
                                <!-- END Notification -->
                            </div>
                            <!-- END Notification Dropdown -->
                        </div>
                    </li>
                    <li class="p-r-15 inline">
                        <a href="#" class="icon-set clip "></a>
                    </li>
                    <li class="p-r-15 inline">
                        <a href="#" class="icon-set grid-box"></a>
                    </li>
                </ul>
                <!-- END NOTIFICATIONS LIST -->--}}
                {{--
                <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span
                      class="bold">search</span></a>
                 --}}
            </div>
        </div>
        <div class=" pull-right">
            <div class="header-inner">
                <a href="#" class="btn-link icon-set menu-hambuger-plus m-l-20 sm-no-margin hidden-sm hidden-xs"
                   data-toggle="quickview" data-toggle-element="#quickview"></a>
            </div>
        </div>
        <div class=" pull-right">
            <!-- START User Info-->
            <div class="visible-lg visible-md m-t-10">
                <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                    <span class="semi-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    <span class="text-master">{{ \Illuminate\Support\Facades\Auth::user()->surname }}</span>
                </div>
                <div class="dropdown pull-left">
                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="{{ asset('ikpanel/assets/img/profiles/user-3.png') }}"
                     alt=""
                     data-src="{{ asset('ikpanel/assets/img/profiles/user-3.png') }}"
                     data-src-retina="{{ asset('ikpanel/assets/img/profiles/user-3.png') }}"
                     width="32"
                     height="32">
            </span>
                    </button>
                    <ul class="dropdown-menu profile-dropdown" role="menu">
                        <li class="bg-master-lighter">
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="clearfix">
                                <span class="pull-left">Logout</span>
                                <span class="pull-right"><i class="pg-power"></i></span>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END User Info-->
        </div>
    </div>
    <!-- END HEADER -->
    <!-- END PAGE HEADER WRAPPER -->
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
            <!-- START JUMBOTRON -->
            <div class="jumbotron" data-pages="parallax">
                <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                    <div class="inner">
                        <!-- START BREADCRUMB -->
                        <ul class="breadcrumb">
                            <li>
                                <a class="active" href="{{env('APP_URL')}}">{{ config('app.name') }}</a>
                            </li>
                            <li>
                                @yield('section_name')
                            </li>
                        </ul>
                        <!-- END BREADCRUMB -->
                    </div>
                </div>
            </div>
            <!-- END JUMBOTRON -->
            <!-- START CONTAINER FLUID -->
            <div class="container-fluid container-fixed-lg">
                <!-- NAVBAR ACTION -->
                @yield('action_navbar')
                <hr>
                <!-- NAVBAR ACTION -->
                <!-- BEGIN PlACE PAGE CONTENT HERE -->
            @yield('content')
            <!-- END PLACE PAGE CONTENT HERE -->
            </div>
            <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER -->
        <div class="container-fluid container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright © 2018</span>
                    <span class="font-montserrat">Interactive Knowledge Development</span>.
                    <span class="hint-text">All rights reserved.</span>
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> |
                        <a href="#" class="m-l-10">Privacy Policy</a>
                    </span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    <span class="font-montserrat"><i>{{ env('APP_NAME') }} {{ Session::get('version') }}</i></span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->
<!--START QUICKVIEW -->
{{--<div id="quickview" class="quickview-wrapper" data-pages="quickview">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="">
            <a href="#quickview-notes" data-toggle="tab">Notes</a>
        </li>
        <li>
            <a href="#quickview-alerts" data-toggle="tab">Alerts</a>
        </li>
        <li class="active">
            <a href="#quickview-chat" data-toggle="tab">Chat</a>
        </li>
    </ul>
    <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i
                class="pg-close"></i></a>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- BEGIN Notes !-->
        <div class="tab-pane fade  in no-padding" id="quickview-notes">
            <div class="view-port clearfix quickview-notes" id="note-views">
                <!-- BEGIN Note List !-->
                <div class="view list" id="quick-note-list">
                    <div class="toolbar clearfix">
                        <ul class="pull-right ">
                            <li>
                                <a href="#" class="delete-note-link"><i class="fa fa-trash-o"></i></a>
                            </li>
                            <li>
                                <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views"
                                   data-view-animation="push"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                        <button class="btn-remove-notes btn btn-xs btn-block" style="display:none"><i
                                    class="fa fa-times"></i> Delete
                        </button>
                    </div>
                    <ul>
                        <!-- BEGIN Note Item !-->
                        <li data-noteid="1" data-navigate="view" data-view-port="#note-views"
                            data-view-animation="push">
                            <div class="left">
                                <!-- BEGIN Note Action !-->
                                <div class="checkbox check-warning no-margin">
                                    <input id="qncheckbox1" type="checkbox" value="1">
                                    <label for="qncheckbox1"></label>
                                </div>
                                <!-- END Note Action !-->
                                <!-- BEGIN Note Preview Text !-->
                                <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam</p>
                                <!-- BEGIN Note Preview Text !-->
                            </div>
                            <!-- BEGIN Note Details !-->
                            <div class="right pull-right">
                                <!-- BEGIN Note Date !-->
                                <span class="date">12/12/14</span>
                                <a href="#"><i class="fa fa-chevron-right"></i></a>
                                <!-- END Note Date !-->
                            </div>
                            <!-- END Note Details !-->
                        </li>
                        <!-- END Note List !-->
                    </ul>
                </div>
                <!-- END Note List !-->
                <div class="view note" id="quick-note">
                    <div>
                        <ul class="toolbar">
                            <li><a href="#" class="close-note-link"><i class="pg-arrow_left"></i></a>
                            </li>
                            <li><a href="#" data-action="Bold"><i class="fa fa-bold"></i></a>
                            </li>
                            <li><a href="#" data-action="Italic"><i class="fa fa-italic"></i></a>
                            </li>
                            <li><a href="#" class=""><i class="fa fa-link"></i></a>
                            </li>
                        </ul>
                        <div class="body">
                            <div>
                                <div class="top">
                                    <span>21st april 2014 2:13am</span>
                                </div>
                                <div class="content">
                                    <div class="quick-note-editor full-width full-height js-input"
                                         contenteditable="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Notes !-->
        <!-- BEGIN Alerts !-->
        <div class="tab-pane fade no-padding" id="quickview-alerts">
            <div class="view-port clearfix" id="alerts">
                <!-- BEGIN Alerts View !-->
                <div class="view bg-white">
                    <!-- BEGIN View Header !-->
                    <div class="navbar navbar-default navbar-sm">
                        <div class="navbar-inner">
                            <!-- BEGIN Header Controler !-->
                            <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-more"></i>
                            </a>
                            <!-- END Header Controler !-->
                            <div class="view-heading">
                                Notications
                            </div>
                            <!-- BEGIN Header Controler !-->
                            <a href="#" class="inline action p-r-10 pull-right link text-master">
                                <i class="pg-search"></i>
                            </a>
                            <!-- END Header Controler !-->
                        </div>
                    </div>
                    <!-- END View Header !-->
                    <!-- BEGIN Alert List !-->
                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                        <!-- BEGIN List Group !-->
                        <div class="list-view-group-container">
                            <!-- BEGIN List Group Header!-->
                            <div class="list-view-group-header text-uppercase">
                                Calendar
                            </div>
                            <!-- END List Group Header!-->
                            <ul>
                                <!-- BEGIN List Group Item!-->
                                <li class="alert-list">
                                    <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                                    <a href="javascript:;" class="" data-navigate="view" data-view-port="#chat"
                                       data-view-animation="push-parrallax">
                                        <p class="col-xs-height col-middle">
                                            <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                                        </p>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-9 overflow-ellipsis fs-12">
                                            <span class="text-master">David Nester Birthday</span>
                                        </p>
                                        <p class="p-r-10 col-xs-height col-middle fs-12 text-right">
                                            <span class="text-warning">Today <br></span>
                                            <span class="text-master">All Day</span>
                                        </p>
                                    </a>
                                    <!-- END Alert Item!-->
                                    <!-- BEGIN List Group Item!-->
                                </li>
                                <!-- END List Group Item!-->
                            </ul>
                        </div>
                        <!-- END List Group !-->
                    </div>
                    <!-- END Alert List !-->
                </div>
                <!-- EEND Alerts View !-->
            </div>
        </div>
        <!-- END Alerts !-->
        <div class="tab-pane fade in active no-padding" id="quickview-chat">
            <div class="view-port clearfix" id="chat">
                <div class="view bg-white">
                    <!-- BEGIN View Header !-->
                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <!-- BEGIN Header Controler !-->
                            <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-plus"></i>
                            </a>
                            <!-- END Header Controler !-->
                            <div class="view-heading">
                                Chat List
                                <div class="fs-11">Show All</div>
                            </div>
                            <!-- BEGIN Header Controler !-->
                            <a href="#" class="inline action p-r-10 pull-right link text-master">
                                <i class="pg-more"></i>
                            </a>
                            <!-- END Header Controler !-->
                        </div>
                    </div>
                    <!-- END View Header !-->
                    <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">
                                a
                            </div>
                            <ul>
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt=""
                                 data-src-retina="{{ asset('ikpanel/assets/img/profiles/1x.jpg') }}"
                                 data-src="{{ asset('ikpanel/assets/img/profiles/1.jpg') }}"
                                 src="{{ asset('ikpanel/assets/img/profiles/1x.jpg') }}"
                                 class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">ava flores</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                            </ul>
                        </div>
                        <div class="list-view-group-container">
                            <div class="list-view-group-header text-uppercase">b</div>
                            <ul>
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt=""
                                 data-src-retina="{{ asset('ikpanel/assets/img/profiles/2x.jpg') }}"
                                 data-src="{{ asset('ikpanel/assets/img/profiles/2.jpg') }}"
                                 src="{{ asset('ikpanel/assets/img/profiles/2x.jpg') }}"
                                 class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bella mccoy</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                                <!-- BEGIN Chat User List Item  !-->
                                <li class="chat-user-list clearfix">
                                    <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view"
                                       class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt=""
                                 data-src-retina="{{ asset('ikpanel/assets/img/profiles/3x.jpg') }}"
                                 data-src="{{ asset('ikpanel/assets/img/profiles/3.jpg') }}"
                                 src="{{ asset('ikpanel/assets/img/profiles/3x.jpg') }}" class="col-top">
                        </span>
                        </span>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                                            <span class="text-master">bob stephens</span>
                                            <span class="block text-master hint-text fs-12">Hello there</span>
                                        </p>
                                    </a>
                                </li>
                                <!-- END Chat User List Item  !-->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- BEGIN Conversation View  !-->
                <div class="view chat-view bg-white clearfix">
                    <!-- BEGIN Header  !-->
                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <a href="javascript:;" class="link text-master inline action p-l-10" data-navigate="view"
                               data-view-port="#chat" data-view-animation="push-parrallax">
                                <i class="pg-arrow_left"></i>
                            </a>
                            <div class="view-heading">
                                John Smith
                                <div class="fs-11 hint-text">Online</div>
                            </div>
                            <a href="#" class="link text-master inline action p-r-10 pull-right ">
                                <i class="pg-more"></i>
                            </a>
                        </div>
                    </div>
                    <!-- END Header  !-->
                    <!-- BEGIN Conversation  !-->
                    <div class="chat-inner" id="my-conversation">
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Hello there
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Them Message  !-->
                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30"
                                     src="{{ asset('ikpanel/assets/img/profiles/avatar_small.jpg') }}"
                                     alt="" data-src="{{ asset('ikpanel/assets/img/profiles/avatar_small.jpg') }}"
                                     data-src-retina="{{ asset('ikpanel/assets/img/profiles/avatar_small2x.jpg') }}">
                            </div>
                            <div class="chat-bubble from-them">
                                Hey
                            </div>
                        </div>
                        <!-- END From Them Message  !-->
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Did you check out Pages framework ?
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Me Message  !-->
                        <div class="message clearfix">
                            <div class="chat-bubble from-me">
                                Its an awesome chat
                            </div>
                        </div>
                        <!-- END From Me Message  !-->
                        <!-- BEGIN From Them Message  !-->
                        <div class="message clearfix">
                            <div class="profile-img-wrapper m-t-5 inline">
                                <img class="col-top" width="30" height="30"
                                     src="{{ asset('ikpanel/assets/img/profiles/avatar_small.jpg') }}"
                                     alt="" data-src="{{ asset('ikpanel/assets/img/profiles/avatar_small.jpg') }}"
                                     data-src-retina="{{ asset('ikpanel/assets/img/profiles/avatar_small2x.jpg') }}">
                            </div>
                            <div class="chat-bubble from-them">
                                Yea
                            </div>
                        </div>
                        <!-- END From Them Message  !-->
                    </div>
                    <!-- BEGIN Conversation  !-->
                    <!-- BEGIN Chat Input  !-->
                    <div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">
                        <div class="row">
                            <div class="col-xs-1 p-t-15">
                                <a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>
                            </div>
                            <div class="col-xs-8 no-padding">
                                <input type="text" class="form-control chat-input" data-chat-input=""
                                       data-chat-conversation="#my-conversation" placeholder="Say something">
                            </div>
                            <div class="col-xs-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">
                                <a href="#" class="link text-master"><i class="pg-camera"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- END Chat Input  !-->
                </div>
                <!-- END Conversation View  !-->
            </div>
        </div>
    </div>
</div>--}}
<!-- END QUICKVIEW-->
<!-- START OVERLAY -->
<div class="overlay" style="display: none" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Logo !-->
            <img class="overlay-brand"
                 src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 alt="logo"
                 data-src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 data-src-retina="{{ asset('ikpanel/assets/img/logo_2x.png') }}"
                 width="78" height="22">
            <!-- END Overlay Logo !-->
            <!-- BEGIN Overlay Close !-->
            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>
            <!-- END Overlay Close !-->
        </div>
        <!-- END Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Controls !-->
            <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Search..."
                   autocomplete="off" spellcheck="false">
            <br>
            <div class="inline-block">
                <div class="checkbox right">
                    <input id="checkboxn" type="checkbox" value="1" checked="checked">
                    <label for="checkboxn"><i class="fa fa-search"></i> Search within page</label>
                </div>
            </div>
            <div class="inline-block m-l-10">
                <p class="fs-13">Press enter to search</p>
            </div>
            <!-- END Overlay Controls !-->
        </div>
        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid">
          <span>
                <strong>suggestions :</strong>
            </span>
            <span id="overlay-suggestions"></span>
            <br>
            <div class="search-results m-t-40">
                <p class="bold">Pages Search Results</p>
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>
                                    <img width="50" height="50"
                                         src="{{ asset('ikpanel/assets/img/profiles/avatar.jpg') }}"
                                         data-src="{{ asset('ikpanel/assets/img/profiles/avatar.jpg') }}"
                                         data-src-retina="{{ asset('ikpanel/assets/img/profiles/avatar2x.jpg') }}"
                                         alt="">
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on pages</h5>
                                <p class="hint-text">via john smith</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div>T</div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> related topics
                                </h5>
                                <p class="hint-text">via pages</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                                <div><i class="fa fa-headphones large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> music</h5>
                                <p class="hint-text">via pagesmix</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-info text-white inline m-t-10">
                                <div><i class="fa fa-facebook large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on facebook</h5>
                                <p class="hint-text">via facebook</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular bg-complete text-white inline m-t-10">
                                <div><i class="fa fa-twitter large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Tweats on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via twitter</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                        <!-- BEGIN Search Result Item !-->
                        <div class="">
                            <!-- BEGIN Search Result Item Thumbnail !-->
                            <div class="thumbnail-wrapper d48 circular text-white bg-danger inline m-t-10">
                                <div><i class="fa fa-google-plus large-text "></i>
                                </div>
                            </div>
                            <!-- END Search Result Item Thumbnail !-->
                            <div class="p-l-10 inline p-t-5">
                                <h5 class="m-b-5">Circles on<span class="semi-bold result-name"> ice cream</span></h5>
                                <p class="hint-text">via google plus</p>
                            </div>
                        </div>
                        <!-- END Search Result Item !-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Overlay Search Results !-->
    </div>
</div>
<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
<script src="{{ asset('ikpanel/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-bez/jquery.bez.min.js') }}"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ asset('ikpanel/pages/js/pages.js') }}" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="{{ asset('ikpanel/assets/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/plugins/js/global.js') }}"></script>
<!-- END PAGE LEVEL JS -->
@yield('final_script')
</body>
</html>