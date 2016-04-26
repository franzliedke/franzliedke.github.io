@extends('_layouts.master')

@section('body')

    <div class="article">
        <h1>{{ $title }}</h1>
        @yield('content')
    </div>

@endsection
