<html>
<head>
    <style>
        html, body {
            background-color: #222C32;
            height: 100%;
            font-family: 'Open Sans', sans-serif;
            box-sizing: border-box;
        }

        .cd-container {
            width: 90%;
            max-width: 1080px;
            min-height: 100%;
            margin: 0 auto;
            background: #2B343A;
            padding: 0 10%;
            border-radius: 2px;
        }

        .cd-container::after {
            content: '';
            display: table;
            clear: both;
        }




        #cloud-tag {
            width: 888px;
            margin: 0 auto;
            padding: 2em 0;
            position: relative;
            margin-top: 45px;
            padding-top: 100px;
        }
        #cloud-tag span {
            float: left;
            display: block;
            position: relative;
        }

        #cloud-tag .word-1 {
            top: 1em;
            left: 1.5em;
        }

        #cloud-tag .word-2 {
            top: 0;
            left: 1em;
        }
        #cloud-tag .word-3 {
            top: 1em;
            left: 1.5em;
            font-size: 60px;
        }

        #cloud-tag .word-4 {
            top: 1em;
            left: 0;
            -moz-transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        #cloud-tag .word-5 {
            top: 1.5em;
            right: -0.3em;
            -moz-transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

        #cloud-tag .word-6 {
            bottom: 0;
            right: 1em;
        }

        #cloud-tag .word-7 {
            bottom: 0.6em;
            left: 0;
            -moz-transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg);
            -o-transform: rotate(-90deg);
            transform: rotate(-90deg);
        }

    </style>
</head>

<body>
<section id="cd-timeline" class="cd-container">
    <div id="cloud-tag">
        @foreach ($tags as $key => $tag)
            <span><a href="/tag/{{ $key }}" id="0" tag-id="3">{{ $key }}</a></span>
        @endforeach
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
    $('#cloud-tag a').each(function(){
        $(this).css('color', get_random_color());
        var size =  Math.floor((Math.random()*40));
        $(this).css('font-size',size);
        if (size <= 9) {
            $(this).css('font-size','12px')
        }
    });

    var randomClass = ['word-1','word-2','word-3','word-4','word-5','word-6','word-7'];
    $('#cloud-tag span').each(function (){
        $(this).addClass(randomClass[Math.floor(Math.random()*randomClass.length)]);
    });

    function get_random_color() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.round(Math.random() * 15)];
        }
        return color;
    }

    $("#cloud-tag a").hover(
        function () {
            color = $(this).css("color");
            $(this).css("color", "#fff000");
        },
        function () {
            $(this).css("color", color);
        }
    );
</script>
</body>
</html>


