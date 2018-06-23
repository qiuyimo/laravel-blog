<html>
    <head>
        <link rel="stylesheet" href="{{URL::asset('/css/prism.css')}}" />
        <script type="text/javascript" src="{{URL::asset('/js/prism.js')}}" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style type="text/css">
            body {width:60%; margin-left:auto; margin-right:auto;}
            p > code {background: rgba(242, 243, 247, 0.98);}
            table {font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;width:100%;border-collapse:collapse;}

            table td, table th {font-size:1em;border:1px solid #8b89bf;padding:3px 7px 2px 7px;}

            table th {font-size:1.1em;text-align:left;padding-top:5px;padding-bottom:4px;background-color: #b6c4c9;color:#ffffff;}

            table tr.alt td {color:#000000;background-color:#EAF2D3;}
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