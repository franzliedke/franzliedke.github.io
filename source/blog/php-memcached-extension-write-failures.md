---
extends: _layouts.blog
section: content
title: "PHP's Memcached extension and write failures"
date: "2012-02-15"
---

After two hours of debugging (which is no fun on a remote continuous integration server) what turned out to be not a bug, but rather a pretty horrible design decision, as one might call it, I feel I should share this.
Maybe it will save somebody else the hassle of trying to read Memcached logs and find out what on earth went wrong.

I was working on FluxBB’s new cache library which has adapters for quite a few different backends – one of them Memcached, one of two PHP bindings for, well, Memcached, the memory caching system.
The second PHP extension, Memcache, worked well, but for some reason our unit testing suite gave us a `Memcached::RES_WRITE_FAILURE` status message when trying to write entries to the data store.
That error code [means][1] “Failed to write network data”.

Well, that was surprising.
Empty error logs, no error when connecting to the server.

Which is very annoying because in the end, it turned out that Memcached won’t work with “localhost” as server host (which worked with the Memcache extension), but rather expects “127.0.0.1”.
Go figure, I say.

To sum it up, let’s close this with what somebody commented on IRC:

> Most of developers develop their libraries for the unicorns’ and rainbows’ world.
> When things never fail, nothing goes wrong and thus there is no need to worry about error messages.

[1]: http://php.net/manual/en/memcached.constants.php "Explanation of constants in PHP's Memcached extension"
