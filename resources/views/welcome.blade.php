<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700);
            @import url(http://weloveiconfonts.com/api/?family=entypo);
            [class*="entypo-"]:before {
                font-family: 'entypo', sans-serif;
            }

            .cf:before, .cf:after {
                content: " ";
                display: table;
            }

            .cf:after {
                clear: both;
            }

            .cf {
                *zoom: 1;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                background: #c4e9d9;
                font-size: 16px;
                font-family: "Open Sans";
                font-weight: 300;
            }

            a {
                text-decoration: none;
            }

            .left {
                float: left;
            }

            .right {
                float: right;
            }

            .row {
                width: auto;
                margin: 0 auto;
                max-width: 62.5em;
            }

            h1 {
                min-width: 320px;
                text-align: center;
                color: #3EA377;
            }

            nav {
                position: relative;
                margin: 20px auto 0;
                padding: 0;
                max-width: 62.5em;
                min-width: 20em;
                background: #FFF4E1;
                line-height: 3.125em;
                overflow: visible;
                border: 1px solid white;
                border-radius: 6px;
            }
            @media only screen and (max-width: 62.5em) {
                nav {
                    margin-top: 0;
                    border: 0;
                    border-radius: 0;
                }
            }
            nav:before, nav:after {
                content: "";
                display: table;
                clear: both;
            }
            nav ul {
                margin: 0;
                padding: 0;
                display: inline;
                width: auto;
                height: auto !important;
                list-style: none;
            }
            @media only screen and (max-width: 45em) {
                nav ul {
                    display: none;
                }
            }
            nav ul li {
                float: right;
                margin: 0;
                padding: 0;
                text-align: center;
                cursor: pointer;
            }
            @media only screen and (max-width: 45em) {
                nav ul li {
                    display: block;
                    width: 100%;
                    text-align: left;
                    border-bottom: 1px solid #ffe1ae;
                }
            }
            @media only screen and (max-width: 45em) {
                nav ul li:hover {
                    background: #ffebc8;
                }
            }
            nav ul li > a {
                padding: 0 20px;
                line-height: 3.125em;
                color: #3EA377;
                font-size: 0.875em;
                font-weight: 600;
                width: 100%;
            }
            nav ul li > a span {
                margin-right: 4px;
                color: #307e5c;
            }
            nav ul li > a:hover span {
                color: #F09F47;
            }

            .has-child {
                position: relative;
                left: 0;
            }
            .has-child:after {
                position: absolute;
                margin-top: -5px;
                top: 27px;
                right: 5px;
                content: "";
                width: 0px;
                height: 0px;
                border-style: solid;
                border-width: 8px 5px 0 5px;
                border-color: #F09F47 transparent transparent transparent;
            }
            @media only screen and (max-width: 45em) {
                .has-child:after {
                    position: absolute;
                    margin-top: -5px;
                    top: 25px;
                    right: 20px;
                    content: "";
                    width: 0px;
                    height: 0px;
                    border-style: solid;
                    border-width: 10px 5px 0 5px;
                    border-color: #307e5c transparent transparent transparent;
                }
            }
            .has-child .dropdown {
                position: absolute;
                left: -40px;
                z-index: 99;
                display: none;
                margin-top: 10px;
                width: 200px;
                background: #fffbf5;
                border-radius: 6px;
            }
            @media only screen and (max-width: 45em) {
                .has-child .dropdown {
                    position: relative;
                    left: 0;
                    z-index: auto;
                    margin-top: 0;
                    display: block;
                    width: 100%;
                    border-radius: 0;
                }
            }
            .has-child .dropdown:after {
                position: absolute;
                top: -10px;
                left: 50%;
                margin-left: -10px;
                content: "";
                width: 0px;
                height: 0px;
                border-style: solid;
                border-width: 0 10px 10px 10px;
                border-color: transparent transparent white transparent;
            }
            @media only screen and (max-width: 45em) {
                .has-child .dropdown:after {
                    border: 0;
                }
            }
            .has-child .dropdown > li {
                float: left;
                width: 100%;
                font-size: 0.875em;
                font-weight: 600;
                color: #3EA377;
                border-bottom: 1px solid #EFEFEF;
            }
            @media only screen and (max-width: 45em) {
                .has-child .dropdown > li {
                    padding-left: 20px;
                    background: #fffbf5;
                    border-bottom-color: #ffebc8;
                }
            }
            .has-child .dropdown li a {
                display: block;
                padding: 10px;
            }
            .has-child .dropdown li a:hover {
                color: #296c4f;
            }

            .logo {
                float: left;
                margin: 0;
                padding: 0 15px;
                font-size: 1.25em;
                font-weight: 700;
                color: #FFF4E1;
                background: #F09F47;
                border-right: 1px solid white;
                border-radius: 6px 0 0 6px;
            }
            @media only screen and (max-width: 45em) {
                .logo {
                    width: 100%;
                    border: 0;
                    border-radius: 0;
                }
            }
            @media only screen and (max-width: 62.5em) {
                .logo {
                    border-radius: 0;
                }
            }

            #toggle-menu {
                position: absolute;
                right: 1em;
                top: 0;
                display: none;
                cursor: pointer;
                font-size: 1.5em;
                color: #FFF4E1;
            }
            @media only screen and (max-width: 45em) {
                #toggle-menu {
                    display: block;
                }
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <nav role="navigation">
                    <span class="entypo-menu" id="toggle-menu"></span>
                    <div class="logo">
                        <span class="entypo-compass"></span> QiuYu Blog
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
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="{{ asset('/js/nav.js') }}"></script>
</html>
