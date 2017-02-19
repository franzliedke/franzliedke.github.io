@extends('_layouts.master')

@section('body')

    <h1>Blog articles</h1>
    @foreach (getArticles()->sortByDesc('date') as $article)
        <article class="link">
            <h3 class="article-title">
                <a href="/blog/{{ $article['filename'] }}.html">{{ $article['title'] }}</a>
            </h3>
            <time>{{ $article['date'] }}</time>
            <p class="article-summary">{{ $article['summary'] }}</p>
        </article>
    @endforeach

@endsection
