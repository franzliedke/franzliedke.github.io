<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>
    <body>
        <header>
            <h1>
                <a href="/">Franz Liedke</a>
            </h1>

            <nav>
                <ul>
                    <li><a href="/about">About me</a></li>
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
