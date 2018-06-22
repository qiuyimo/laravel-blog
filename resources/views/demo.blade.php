<html>
    <head>
        <link rel="stylesheet" href="{{URL::asset('/css/prism.css')}}" />
        <script type="text/javascript" src="{{URL::asset('/js/prism.js')}}" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style type="text/css">
            body {width:60%; margin-left:auto; margin-right:auto;}
            p > code {border: 1px solid #ddd; background: rgba(240, 224, 229, 0.98);}
        </style>
    </head>

    <body>
        {!! $html !!}
    </body>

    <script type="text/javascript">
        // 代码块添加行号.
        $('pre').addClass("line-numbers");

        // 设置自动换行.
        // $('pre').css("white-space", "pre-wrap");
    </script>
</html>