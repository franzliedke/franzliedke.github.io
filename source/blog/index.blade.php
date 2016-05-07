@extends('_layouts.master')

@section('body')

    <h1>Blog articles</h1>
    @foreach (getArticles()->sortByDesc('date') as $article)
        <article class="link">
            <time>{{ $article['date'] }}</time>
            <h3>
                <a href="/blog/{{ $article['filename'] }}.html">{{ $article['title'] }}</a>
            </h3>
        </article>
    @endforeach

@endsection
