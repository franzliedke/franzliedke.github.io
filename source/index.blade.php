@extends('_layouts.master')

@section('body')

    <h1>Hi, I'm Franz Liedke.</h1>
    <h2>Software Developer, Open-Source Enthusiast.</h2>

    <ul class="social-links">
        <li class="twitter">
            <a href="https://twitter.com/franzliedke">franzliedke</a>
        </li>
        <li class="github">
            <a href="https://github.com/franzliedke">franzliedke</a>
        </li>
    </ul>

    <p>&nbsp;</p>

    <h2>Latest articles</h2>

    @foreach (getArticles()->sortByDesc('date')->take(3) as $article)
        <article class="link">
            <h3 class="article-title">
                <a href="/blog/{{ $article['filename'] }}.html">{{ $article['title'] }}</a>
            </h3>
            <time>{{ $article['date'] }}</time>
            <p class="article-summary">{{ $article['summary'] }}</p>
        </article>
    @endforeach

@endsection
