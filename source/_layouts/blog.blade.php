@extends('_layouts.master')

@section('body')

    <article>
        <h1>{{ $title }}</h1>
        <time class="article-date" datetime="{{ $date }}T12:00">{{ $date }}</time>
        @yield('content')

        @include('_partials.disqus')
    </article>

@endsection
