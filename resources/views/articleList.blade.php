@extends('layouts.app')

@section('title', 'article list')

@section('style')
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection

@section('content')
    <div class="container">
        <h1>Article List</h1>
        @forelse($info as $article)
            <div style="border: solid 1px #ddd; margin-top: 10px;">
                <a href="/article/{{ $article['url'] }}/{{ strtotime($article['created_at']) }}">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ $article['title'] }}</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">{{ $article['summary'] }}</div>
                    </div>
                </a>

                <div class="row">
                    <div class="col-md-2">{{ date("Y-m-d", strtotime($article['created_at'])) }}</div>
                    <div class="col-md-1">like:{{ $article['like'] }}</div>
                    <div class="col-md-1">click:{{ $article['views'] }}</div>
                    <div class="col-md-3">tags:@forelse ($article['has_many_tag'] as $tag) {{ $tag['tag_name'] }} @empty null @endforelse</div>
                    <div class="col-md-3">categories:@forelse ($article['has_many_cate'] as $tag) {{ $tag['belongs_to_category']['name'] }} @empty null @endforelse</div>
                </div>
            </div>
        @empty
            没有记录
        @endforelse

        <div id="page"><nav aria-label="...">{{ $articles->links() }}</nav></div>
    </div>
@endsection


@section('javascript')
    <script type="text/javascript">$('pre').addClass("line-numbers");</script>
    <script type="text/javascript">$('#page ul').addClass("pagination");</script>
@endsection
