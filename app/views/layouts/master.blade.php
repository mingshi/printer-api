<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>{{ $uri }}</title>

    <style type="text/css">
        body {
            padding: 10px 30px;
            font-size: 14px;
            line-height: 20px;
        }

        label.color {
            color: red;
        }

        a {
            color: #e51f5b;
            text-decoration: none;
            outline: none;
        }

        a:hover {
            color: #fb608f;
            outline: 0;
        }

        .submit {
            height: 27px;
            width: 100px;
            margin-top: 10px;
        }

        form div {
            height: 40px;
        }

        form div input {
            margin-left: 30px;
        }
    </style>
</head>

<body>


<h3>接口路径: {{ $uri }}</h3>

<div class="container">
    <form method="post" action="{{ $uri }}" enctype='multipart/form-data'>
        @yield('content')
        <hr/>
        <input type="text" name="device_id"/> device_id<br>
        <input type="text" name="platform"/> platform<br>
        <input type="text" name="platform_version"/> platform_version<br>
        <input type="text" name="client_type"/> client_type<br>
        <input type="text" name="channel"/> channel<br>
        <input type="text" name="app_version"/> app_version<br>
        <input type="text" name="network_type"/> network_type<br>
        <input type="text" name="id_user"/> id_user 用户登陆后此参数必填<br>
        <input type="submit" class="submit" value="点击测试">
    </form>
</div>
</body>
</html>
