<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>

    <style>
        body {
            font-size: 14px;
        }
        .main {
            padding: 0;
        }
        .header {
            background: black;
            padding: 12px;
        }
        .content {
            padding: 10px;
        }
        .mini {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
        <div class="content">
            @yield('content')

            <hr>
            <p class="mini">Este es un correo electrónico generado automáticamente. Por favor, no lo respondas. Si tienes alguna duda puedes contactarte con el administrador a través de https://genubi.com.ar</p>
        </div>
    </div>
</body>
</html>