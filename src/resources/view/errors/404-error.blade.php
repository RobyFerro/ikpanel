<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="{{asset('ikpanel/assets/css/404.css')}}" rel="stylesheet">
	<title>{{ \Illuminate\Support\Facades\Config::get('app.name') }} - Page not found</title>
</head>
<body>
	<a href="{{ admin_url() }}">
		<svg height="0.8em" width="0.8em" viewBox="0 0 2 1" preserveAspectRatio="none">
			<polyline fill="none" stroke="#777777" stroke-width="0.1" points="0.9,0.1 0.1,0.5 0.9,0.9"></polyline>
		</svg>
		Home
	</a>
	<div class="background-wrapper">
		<h1 id="visual">404</h1>
	</div>
	<p>The page you’re looking for does not exist.</p>
	<script src="{{asset('ikpanel/plugins/js/errors/404.js')}}"></script>
</body>
</html>
