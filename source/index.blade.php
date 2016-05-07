@extends('_layouts.master')

@section('body')

    <h1>Hi, I'm Franz Liedke.</h1>
    <h2>Software Developer, Open-Source Enthusiast.</h2>

    <p>...</p>

    <a href="#">Twitter</a>
    <a href="#">GitHub</a>

    <h2>Latest articles</h2>

    @foreach (getArticles()->sortByDesc('date')->take(3) as $article)
        <article class="link">
            <time>{{ $article['date'] }}</time>
            <h3>
                <a href="/blog/{{ $article['filename'] }}.html">{{ $article['title'] }}</a>
            </h3>
        </article>
    @endforeach

@endsection
