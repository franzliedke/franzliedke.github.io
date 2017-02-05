---
extends: _layouts.blog
section: content
title: "Can’t use function return value in write context"
date: "2012-06-07"
---

PHP likes to give this error message when using function return values directly with the `empty` construct.

~~~php
if (empty(some_function())
{
    // ... some code here
}
~~~

This is due to how `empty` is implemented in PHP.

The obvious solution is to store the value in a temporary variable first and then applying `empty`:

~~~
$value = some_function();
if (empty($value))
{
    // ... some code here
}
~~~

There is a shorter way, though.

Depending on whether you use `empty` or `!empty`, the shortest way to use the function return value directly is this:

~~~php
// Replacing empty
if (!some_function())
{
    // ... some code here
}

// Replacing !empty
if ((bool) some_function())
{
    // ... some code here
}
~~~

This solution makes clever use of [PHP's type casting to booleans][1] - and keeps the code short.

**NOTE:** This not only works for arrays, but also for strings.

[1]: http://php.net/manual/en/language.types.boolean.php#language.types.boolean.casting "Explanation of PHP's type casting to booleans"
