<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Document</title>
    <style>
        html {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
<table id="notification" width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <td style="text-align: center">
            <img src="{{asset('ikpanel/assets/img/ikdev.jpg')}}" alt="ikdev" style="width:250px">
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            @yield('content')
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
