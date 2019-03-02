---
extends: _layouts.blog
section: content
title: "Laravel 4: Query results caching"
summary: "With Laravel's database layer, results of database queries can easily be stored and retrieved from cache."
date: "2013-05-29"
---

It is here!
Laravel 4.0 was released yesterday.
Obviously, Taylor was very busy in the past days, trying to fix remaining bugs.
Still, he even had time to introduce some nice new features every now and then.

A very recent example for such a feature would be query results caching.

With a very simple chained method call, you can make sure that long-running or frequently-run queries are executed only once every hour, with the result being cached in the meantime.

~~~php
$users = DB::table('users')
           ->orderBy('num_posts', 'desc')
           ->take(5)
           ->remember(60)
           ->get();
~~~

What this does behind the scenes: it executes the query once and stores it along with the results using the cache adapter, with an expiration time of 60 minutes.
When this code is run again, the cached query statement will be found, and the query won’t be executed, but instead the results will be taken directly from the cache.

Of course, this also works with Eloquent queries.
If you have a user model, you can do this instead:

~~~php
$users = User::orderBy('num_posts', 'desc')
             ->take(5)
             ->remember(60)
             ->get();
~~~

Who’s looking sharp now?
