---
extends: _layouts.blog
section: content
title: "A PHP Short Array Syntax Converter"
date: "2012-12-28"
---

In his [PHP Town Hall podcast][1], Phil Sturgeon mentioned that it would be nice to have an automatic converter for the new [short-hand PHP array syntax][2] that was added in PHP 5.4.
I agreed, but not that it would be hard to create one.
Making use of Symfony’s nice Console package and PHP’s very own [tokenizer][3], it was fairly easy to create.

In fact, the only real issue I faced was making sure that array typehints weren’t removed (as the token parser doesn’t make a difference between array typehints and array definitions).
Maybe I have just missed something…

Anyway, you can find the tool [here on GitHub][4].
Improvements welcome.

[1]: http://phptownhall.com/blog/2012/12/04/episode-2-php-5.5/
[2]: https://wiki.php.net/rfc/shortsyntaxforarrays
[3]: http://en.wikipedia.org/wiki/Lexical_analysis "Lexical analysis"
[4]: https://github.com/franzliedke/php-array-shortener
