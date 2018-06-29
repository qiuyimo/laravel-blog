<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - 邱宇博客</title>
    @yield('style')
    <link href="{{ asset('/css/global.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/nav.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row blog-nav">
            <nav role="navigation">
                <span class="entypo-menu" id="toggle-menu"></span>
                <div class="logo">
                    <a href="/"><span class="entypo-compass"></span> QiuYu Blog</a>
                </div>
                <ul>
                    <li><a href="#">About Me</a></li>
                    <li class="has-child"><a href="#">Categories</a>
                        <ul class="dropdown">
                            <li><a href="#">PHP</a></li>
                            <li><a href="#">Linux</a></li>
                            <li><a href="#">SQL</a></li>
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </li>
                    <li><a href="/time">Time</a></li>
                    <li><a href="/tags">Tags</a></li>
                    <li><a href="/article">Articles</a></li>
                </ul>
            </nav>
        </div>
    </div>
    @yield('content')
    @yield('foot')
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/nav.js') }}"></script>
    @yield('javascript')
</body>
</html>
