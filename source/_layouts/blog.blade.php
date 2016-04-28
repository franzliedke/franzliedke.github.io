@extends('_layouts.master')

@section('body')

    <div class="article">
        <h1>{{ $title }}</h1>
        <time class="article-date" datetime="{{ $date }}T12:00">{{ $date }}</time>
        @yield('content')
    </div>

@endsection
