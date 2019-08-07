<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>{{ env('APP_NAME') }} - @ikpanel</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>
    <link rel="apple-touch-icon" href="{{ asset('ikpanel/pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ikpanel/pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('ikpanel/pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('ikpanel/pages/ico/152.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('ikpanel/favicon.ico') }}"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="{{ asset('ikpanel/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('ikpanel/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet"
          type="text/css" media="screen"/>
    <link href="{{ asset('ikpanel/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{{ asset('ikpanel/assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>
    <link href="{{ asset('ikpanel/pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="{{ asset('ikpanel/pages/css/pages.css') }}" rel="stylesheet" type="text/css"/>
    {!! css('ikpanel/assets/css/style.css') !!}
</head>
<body class="fixed-header ">
<div class="login-wrapper ">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{ asset('ikpanel/assets/img/wallpaper.jpg') }}"
             data-src="{{ asset('ikpanel/assets/img/wallpaper.jpg') }}"
             data-src-retina="{{ asset('ikpanel/assets/img/wallpaper.jpg') }}"
             alt=""
             class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
            <h2 class="semi-bold text-white">
                Interactive Knowledge Development</h2>
            <p class="small">
                Koh Rong Island, Cambodia 2016.
                Roberto Ferro © 2016-2018 @ikdev.
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 alt="logo"
                 data-src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 data-src-retina="{{ asset('ikpanel/assets/img/logo.png') }}"
                 class="img img-responsive"
                 width="100%"
                    {{--width="78"
                    height="22"--}}>
            <p class="p-t-35">Sign into your ikpanel account</p>
            <!-- START Login Form -->
            <form id="form-login" class="p-t-15" role="form" action="{{ env('IKPANEL_URL') }}/login" method="POST">
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label>Login</label>
                    <div class="controls">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="email"
                               placeholder="User Name"
                               class="form-control"
                               autocomplete="off"
                               required>
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label>Password</label>
                    <div class="controls">
                        <input type="password"
                               class="form-control"
                               name="password"
                               autocomplete="off"
                               placeholder="Credentials"
                               required>
                    </div>
                </div>
                <!-- START Form Control-->
                <div class="row">
                    <div class="col-md-6 no-padding sm-p-l-10">
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="checkbox1">
                            <label for="checkbox1">Keep Me Signed in</label>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <a href="#" class="text-info small">Help? Contact Support</a>
                    </div>
                </div>
                <!-- END Form Control-->
                <button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
            </form>
            <!--END Login Form-->
        </div>
    </div>
    <!-- END Login Right Container-->
</div>
<!-- START OVERLAY -->
<div class="overlay hide" data-pages="search">
    <!-- BEGIN Overlay Content !-->
    <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
            <!-- BEGIN Overlay Logo !-->
            <img class="overlay-brand"
                 src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 alt="logo"
                 data-src="{{ asset('ikpanel/assets/img/logo.png') }}"
                 data-src-retina="{{ asset('ikpanel/assets/img/logo_2x.png') }}" width="78" height="22">
            <!-- END Overlay Logo !-->
            <!-- BEGIN Overlay Close !-->
            <a href="#" class="close-icon-light overlay-close text-black fs-16">
                <i class="pg-close"></i>
            </a>
            <!-- END Overlay Close !-->
        </div>
    </div>
    <!-- END Overlay Content !-->
</div>
<!-- END OVERLAY -->
<!-- BEGIN VENDOR JS -->
<script src="{{ asset('ikpanel/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/tether/js/tether.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ikpanel/assets/plugins/classie/classie.js') }}"></script>
<script src="{{ asset('ikpanel/assets/plugins/switchery/js/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ikpanel/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<!-- END VENDOR JS -->
<script src="{{ asset('ikpanel/pages/js/pages.min.js') }}"></script>
<script>
  $(function () {
    $('#form-login').validate()
  })
</script>
</body>
</html>
