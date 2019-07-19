<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link href="{{ asset('ikpanel/plugins/fontawesome-pro-5.2.0/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
	<title>{{ env('APP_NAME') }}  @if(View::hasSection('section_name')) - @yield('section_name') @endif</title>
</head>
<body>
	<div id="app"></div>
	<script src="{{ asset('ikpanel/template/react-template/app.js') }}"></script>
</body>
</html>