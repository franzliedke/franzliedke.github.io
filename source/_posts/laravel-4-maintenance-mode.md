---
extends: _layouts.blog
section: content
title: "Laravel 4: Maintenance mode"
summary: "This new feature lets you show a nice maintenance page when deploying or working on your website."
date: "2013-05-31"
---

A short tip to finish up the week.

When making changes to your site such as running migrations to update your database, you might want to make sure that it is not accessible from the outside in order to avoid showing intermediate errors.
Laravel 4 adds a very simple, but useful feature for such situations: **maintenance mode**.

Whenever you want to shut down access from the outside for your site, just run this command from the command line:

~~~sh
php artisan down
~~~

Try accessing your site with your browser now.
You will see a message stating “Be right back!”.
To disable maintenance mode, just run this command:

~~~sh
php artisan up
~~~

Of course, you might want to display more information or explain the reasons when your site is in maintenance mode.
Open `app/start/global.php` and find the `App::down()` handler.
You can replace the default string with a custom message.
For more advanced pages, you can even render a view:

~~~php
App::down(function()
{
    return Response::view('maintenance', array(), 503);
});
~~~

This will render the view called “maintenance” in your views directory.
Since we don’t have any custom data, we pass an empty array as second parameter.
The 503 stands for the “Service unavailable” header from the HTTP specification.
