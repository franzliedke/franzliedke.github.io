@extends('_layouts.master')

<?php

$articles = glob('source/blog/*.md');

$articles = collect($articles)->map(function ($file) {
    $contents = file_get_contents($file);

    // Extract frontmatter
    $contents = substr($contents, 3);
    $contents = substr($contents, 0, strpos($contents, '---'));

    $lines = explode("\n", trim($contents));

    $articleInfo = [
        'filename' => basename($file, '*.md')
    ];

    foreach ($lines as $line) {
        list($key, $value) = explode(': ', $line, 2);
        $articleInfo[$key] = trim($value, '"');
    }

    return $articleInfo;
});

?>

@section('body')

    <h2>Blog articles</h2>
    @foreach ($articles as $article)
        <h3>{{ $article['title'] }}</h3>
        <time>{{ $article['date'] }}</time>
    @endforeach

@endsection
