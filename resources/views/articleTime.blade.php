@extends('layouts.app')

@section('title', 'Time')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('/css/time.css') }}" />
@endsection

@section('content')
    <section id="cd-timeline" class="cd-container">
        @foreach ($articles as $article)
            <div class="cd-timeline-block">
                <div class="cd-timeline-img cd-picture">
                </div>

                <div class="cd-timeline-content">
                    <a href="/article/{{ $article['url'] }}/{{ strtotime($article['created_at']) }}" class="custom-hover">
                        <h2>{{ $article['title'] }}</h2>
                    </a>
                    <div class="timeline-content-info">
                    <span class="timeline-content-info-title">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        @foreach ($article['has_many_cate'] as $category)
                            {{ $category['belongs_to_category']['name'] }}
                        @endforeach
                    </span>
                        <span class="timeline-content-info-date">
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            {{ $article['keywords'] }}
                    </span>
                    </div>

                    <a href="/article/{{ $article['url'] }}/{{ strtotime($article['created_at']) }}" class="custom-hover">
                        <p>{{ $article['summary'] }}</p>
                        <span class="cd-date">{{ date("Y-m-d", strtotime($article['created_at'])) }}</span>
                    </a>

                    <ul class="content-skills">
                        @foreach ($article['has_many_tag'] as $tag)
                            <li>{{ $tag['tag_name'] }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
        @endforeach
    </section>
@endsection


@section('javascript')
@endsection
