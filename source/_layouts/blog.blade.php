@extends('_layouts.master')

@section('head_meta')
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@franzliedke" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{ $summary }}" />
@endsection

@section('body')

    <article>
        <h1>{{ $title }}</h1>
        <time class="article-date" datetime="{{ $date }}T12:00">{{ $date }}</time>
        @yield('content')

        @include('_partials.disqus')
    </article>

@endsection
