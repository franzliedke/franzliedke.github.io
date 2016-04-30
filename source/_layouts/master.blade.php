<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

<?php

// Because we do cache busting on production, we collect all CSS files here, no matter the filename
$cssFiles = collect(glob('source/css/*.css'))
    ->map('basename')
    ->map(function ($filename) {
        return "/css/$filename";
    });

?>

        @foreach ($cssFiles as $file)
            <link rel="stylesheet" href="{{ $file }}">
        @endforeach

    </head>
    <body>
        <header>
            <h1>
                <a href="/">Franz Liedke</a>
            </h1>

            <nav>
                <ul>
                    <li><a href="/about.html">About me</a></li>
                    <li><a href="/blog">Blog</a></li>
                </ul>
            </nav>

            <p class="about">
                Master of Science, IT-Systems Engineering<br />
                Web developer, Laravel core contributor<br />
                Open-source enthusiast, Flarum &amp; FluxBB
            </p>
        </header>

        <main>
            @yield('body')
        </main>
    </body>
</html>
