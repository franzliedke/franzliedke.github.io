---
extends: _layouts.blog
section: content
title: "Laravel 4: Model query scopes"
date: "2013-05-30"
---

Query scopes are a wonderful way to make queries with Eloquent even more readable.
They also help you encapsulate your actual database logic inside your model class and avoid repetitive code.

If you have used Yii or Ruby on Rails, you might already know this concept.
Well, Laravel 4 now has it, too.
(And with a little bit of pride I might add: it was my idea!)

Imagine (my favorite use case) a forum software.
A pretty common query for all “closed” (or resolved) topics might then read like this:

~~~php
Topic::where('closed', '=', 1)->get();
~~~

We directly check for the `closed` field in the database table to have the value `1`.
This type of query for closed topics might actually happen rather frequently in different places across the forum.
Now imagine a situation in the future where you have to change the structure of your database (for whatever reason).
For example, you might mark closed topics with the value `0` in the `opened` column instead: you will have to change every single one of those queries.

You guessed it: query scopes to the rescue! We want our query to look like this:

~~~php
Topic::closed()->get();
~~~

Now, of course Laravel can not know how this scope called `closed` should be resolved in the query, so we have to tell it.
Add this method to your topic model class:

~~~php
public function scopeClosed($query)
{
    // Note that the second parameter can be omitted
    // if we're checking for equality.
    return $query->where('closed', 1);
}
~~~

As you can see, the scope method accepts a query object as parameter.
In the method body, we can manipulate that query and then have to return it.

### Combining scopes

Where scopes really shine is when you combine them.
In a forum with a lot of topics, you probably want to show only the 25 most recent ones quite often.

So, you might decide to create another scope that orders the topics by post date and applies a LIMIT clause to the query:

~~~php
public function scopeLatest($query)
{
    // We're ordering by post date and apply
    // a LIMIT clause to the query.
    return $query->orderBy('post_date', 'desc')->take(25);
}
~~~

To get only the latest closed topics, you can now combine both scopes like this:

~~~php
Topic::latest()->closed()->get();
~~~

Marvel at the readability.
Code and text are almost equal.

Less, but official, info can be found in the [documentation][1].

[1]: http://laravel.com/docs/eloquent#query-scopes
