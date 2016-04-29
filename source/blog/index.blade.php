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

    <h1>Blog articles</h1>
    @foreach ($articles as $article)
        <article class="link">
            <time>{{ $article['date'] }}</time>
            <h3>
                <a href="/blog/{{ $article['filename'] }}.html">{{ $article['title'] }}</a>
            </h3>
        </article>
    @endforeach

@endsection
