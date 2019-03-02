@extends('_layouts.master')

@section('head_meta')
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@franzliedke" />
    <meta name="twitter:title" content="{{ $page->title }}" />
    <meta name="twitter:description" content="{{ $page->summary }}" />
@endsection

@section('body')

    <article>
        <h1>{{ $page->title }}</h1>
        <time class="article-date" datetime="{{ $page->date }}T12:00">{{ $page->date }}</time>
        @yield('content')

        @include('_partials.disqus')
    </article>

@endsection
