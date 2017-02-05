---
extends: _layouts.blog
section: content
title: "Laravel 4: CSS error classes in forms"
date: "2012-09-15"
---

Laravel and its [validation system][1] make it easy to handle form errors.

But what if you want to add a special CSS class to your form fields if the submitted value was invalid?
Well, here you go:

~~~php
<input
    type="text"
    name="field"
    class="input-text<?php echo $errors->first('field', ' errorclass'); ?>"
/>
~~~

See what we did there?
The `first()` helper of Laravel’s Message class has two arguments: the field name and, optionally, a format string for the output of the error message.
Usually, this can be used to customize the HTML around the error message.
Without a placeholder for the actual error message, the output will simply be a static string.

If the given field did not produce any error message, the return value of `first()` will simply be an empty string.

Serves the purpose.

[1]: http://laravel.com/docs/validation "Documentation about validation in Laravel"
