---
extends: _layouts.blog
section: content
title: "Laravel 4: Blade helper functions"
summary: "A little trick for exposing helper functions to Laravel's Blade template engine."
date: "2014-07-31"
---

Laravel’s template engine Blade is already very powerful and fairly extensible.
Sometimes you may need special helper functions to simplify your template code.
There is currently no “official” way to extend Blade with those.
Other template engines, such as Twig, offer such a feature.

You could, of course, use global functions as a workaround.
These would, however, be true to their name and clutter the global namespace.
If you want to make sure that these functions are only available in the views, you might want to try this approach.

~~~php
View::share('human_size', function($bytes) {
    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }
    return round($bytes, 2).' '.$units[$i];
});
~~~

In your Blade views, you can then use this simple function call to convert a number into a human-readable size:

~~~php
{{ $human_size(123456789) }}
~~~

This should return “117.74 MiB”.
Note the dollar sign before the function call.
This is due to the nature of Blade, which turns everything you pass into View::share() into variables.
Since in this case we’re passing a closure, it can just be called like a regular function.

Happy templating!
