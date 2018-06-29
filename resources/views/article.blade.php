@extends('layouts.app')

@section('title', $title)

@section('style')
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('/css/article.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('/css/prism.css') }}" />
@endsection

@section('content')
    <div class="container blog-article">
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
@endsection


@section('javascript')
    <script type="text/javascript" src="{{ asset('/js/prism.js') }}" ></script>
    <script type="text/javascript">$('pre').addClass("line-numbers");</script>
    <script type="text/javascript">$('#page ul').addClass("pagination");</script>
@endsection
