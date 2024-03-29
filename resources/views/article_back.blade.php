<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">


        <link rel="stylesheet" href="{{URL::asset('/css/prism.css')}}" />
        <script type="text/javascript" src="{{URL::asset('/js/prism.js')}}" ></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style type="text/css">
            .article-next, .article-prev {
                margin: 10px;
                padding: 10px;
                border: 1px solid #eee;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <h1>{{ $title }}</h1>

            {!! $html !!}

            <div class="row">
                <div class="col-md-6">
                    <a href="/article/{{ $prevAndNextArticle['prev']['url'] }}/{{ strtotime($prevAndNextArticle['prev']['created_at']) }}">
                        <div class="article-prev">
                            <h2>{{ $prevAndNextArticle['prev']['title'] }}</h2>
                            <div>{{ $prevAndNextArticle['prev']['summary'] }}</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="/article/{{ $prevAndNextArticle['prev']['url'] }}/{{ strtotime($prevAndNextArticle['next']['created_at']) }}">
                        <div class="article-next">
                            <h2>{{ $prevAndNextArticle['next']['title'] }}</h2>
                            <div>{{ $prevAndNextArticle['next']['summary'] }}</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript">$('pre').addClass("line-numbers");</script>
    </body>


</html>