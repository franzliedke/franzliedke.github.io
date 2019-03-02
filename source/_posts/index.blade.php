@extends('_layouts.master')

@section('body')

    <h1>Blog articles</h1>

    @foreach ($posts as $post)
        <article class="link">
            <h3 class="article-title">
                <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
            </h3>
            <time>{{ $post->date }}</time>
            <p class="article-summary">{{ $post->summary }}</p>
        </article>
    @endforeach

@endsection
