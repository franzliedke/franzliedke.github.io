---
extends: _layouts.blog
section: content
title: "Laravel 4: Eloquent attribute mutators"
date: "2012-11-06"
---

Custom getters and setters for Eloquent model attributes have existed for a while in Laravel.
They allow you to manipulate your attributes when storing or retrieving them.

The canonical example is saving a user’s password: for security reasons, you want to store only a hash of your password in the database – so you write a custom setter that automatically hashes any password passed to the user object.
Your application won’t have to worry about the implementation details of hashing your password and there’s no way to forget about it.
And there’s lots of room for improvements: for example, you could also extend the function to send a confirmation email with the password when generating it for the first time.

In the upcoming Laravel 4 release, these custom getters and setters will work a little differently, though.

First of all, they are now called **mutators**.
Why not.

Also, as Laravel 4 adheres to the PSR-0 standard, the mutators’ method names will now be “properly” (we’ll argue about that another time) camel-cased.
So, if you have an attribute called “user_password”, the appropriate setter mutator would be called `setUserPasswordAttribute()`.
Once more, some fancy method calling magic behind the scenes.

With Eloquent working all its magic behind the scenes, a password setter might look like this:

~~~php
public function setPasswordAttribute($value)
{
    $this->attributes['password'] = Hash::make($value);
}
~~~

Now go forth and mutate!

**UPDATE (2/21/2013):**
At some point, this functionality was changed.
I updated the article to reflect the new behavior.
