<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                position: relative;
                font-weight: 400;
                list-style-type: none;
                font-style: normal;
            }

            body {
                padding: 50px;
                background: #1d1f20;
                color: #cfd8dc;
                line-height: 1.4;
                font-family: "Space Mono", monospace;
            }

            ::-webkit-scrollbar {
                display: none;
            }

            h1 {
                color: #efc371;
                margin: 0 0 10px;
                font-size: 35px;
            }

            strong {
                color: #b5bc67;
            }

            em {
                color: #dd925f;
            }

            h2 {
                color: #ae94c0;
                margin: 10px 0;
                text-transform: uppercase;
            }

            blockquote,
            ul,
            ol {
                border-left: 1px solid #4d4d4c;
                margin: 10px 0 10px 20px;
                padding: 0 0 0 20px;
                color: #efc371;
            }

            blockquote {
                margin: 10px 0 10px 40px;
                font-style: italic;
            }

            h3 {
                color: #ae94c0;
                margin: 10px 0;
            }

            img {
                display: none;
            }

            .comment {
                color: #4d4d4c;
            }

            p:nth-of-type(8) {
                color: #b5bc67;
            }

        </style>

        <link rel="stylesheet" href="{{URL::asset('/css/prism.css')}}" />
        <script type="text/javascript" src="{{URL::asset('/js/prism.js')}}" ></script>
    </head>

    <body>

        <div class="container">
            <h1>{{ $title }}</h1>

            {{--<p>{{ $summary }}</p>--}}

            <div class="article-content">
                <div class="article">{!! $html !!}</div>

                <div class="row">
                    <div class="col-md-6">
                        @if (!empty($prevAndNextArticle['prev']))
                            <a href="/article/{{ $prevAndNextArticle['prev']['url'] }}/{{ strtotime($prevAndNextArticle['prev']['created_at']) }}">
                                <div class="article-prev">
                                    <h2>{{ $prevAndNextArticle['prev']['title'] }}</h2>
                                    <div>{{ $prevAndNextArticle['prev']['summary'] }}</div>
                                </div>
                            </a>
                        @endif
                    </div>

                    <div class="col-md-6">
                        @if (!empty($prevAndNextArticle['next']))
                        <a href="/article/{{ $prevAndNextArticle['next']['url'] }}/{{ strtotime($prevAndNextArticle['next']['created_at']) }}">
                            <div class="article-next">
                                <h2>{{ $prevAndNextArticle['next']['title'] }}</h2>
                                <div>{{ $prevAndNextArticle['next']['summary'] }}</div>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
    {{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>--}}
        <link rel="stylesheet" href="{{URL::asset('/css/prism.css')}}" />
        <script type="text/javascript" src="{{URL::asset('/js/prism.js')}}" ></script>
        <script type="text/javascript">$('pre').addClass("line-numbers");</script>

        <script>
            // document.getElementsByTagName("p")[1].innerHTML =
            //     "<span class='comment'>/* ---------- <br/>img: src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-1/cherry-blossoms-unsplash.jpg'<br/>alt='cherry blossoms'</br> -------- */</span></br></br>";
            //
            // var str = document.body.innerHTML.toString();
            // // var str = $(".container > h1").prop("outerHTML");
            // // var content = $(".article-content").prop("outerHTML");
            //
            // var i = 0;
            // document.body.innerHTML = "";
            //
            // setTimeout(function() {
            //     var se = setInterval(function() {
            //         i++;
            //         document.body.innerHTML = str.slice(0, i) + "|";
            //         if (i > 1000) {
            //             clearInterval(se);
            //             document.body.innerHTML = str;
            //         }
            //     }, 1);
            // });


            // document.body.innerHTML = content;

        </script>


    </body>


</html>