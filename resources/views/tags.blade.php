@extends('layouts.app')

@section('title', 'Tags')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('/css/tags.css') }}" />
@endsection

@section('content')
    <div class="container">
        <section id="cd-timeline" class="cd-container">
            <div id="cloud-tag">
                @foreach ($tags as $key => $tag)
                    <span><a href="/tag/{{ $key }}" id="0" tag-id="3">{{ $key }}</a></span>
                @endforeach
            </div>
        </section>
    </div>
@endsection


@section('javascript')
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
@endsection
