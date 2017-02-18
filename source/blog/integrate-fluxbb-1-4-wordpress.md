---
extends: _layouts.blog
section: content
title: "Integrate FluxBB 1.4 with a WordPress site"
summary: "Learn how to integrate a FluxBB forum into your WordPress site's design."
date: "2010-05-23"
---

Somebody asked me to integrate [FluxBB][1] into his WordPress site.
I was once more surprised to see how simple it actually is to integrate FluxBB into another piece of software after already experiencing that with the new FluxBB website, though I do not know whether that is a general fact or just luck on my side.

This article will not deal with integrating the FluxBB and the WordPress user accounts, but rather making the forum fit nicely into the overall site design, for example using the site main menu.

## Recommendations

In general, I have a few recommendations to make regarding integration:

- **Only use one style.**
  While it can seem nice to offer your forum users multiple styles to choose from, this is most likely a bad idea when integrating the forum into a site which probably already has some kind of color scheme.
  Not only that: different styles sometimes use different font families and sizes, which would make your integration less seamless and probably more clumsy on some styles.
  Only using one style also makes it easier to accomodate changes in the FluxBB core or the style itself.
- **Rename the default style.**
  Assuming you are going to start making a forum style that fits well into your site based on the default Air style, it is definitely a good idea to rename that style (or whatever style you use).
  As the integration process probably requires some editing of the stylesheets, this keeps them from being overridden when updating the source code.
- **CSS selectors should use prefixes.**
  It is very useful if your style – just like the default styles do it – uses some prefix on its CSS selectors.
  That means that all forum pages should be wrapped in a `<div>` container (`#punwrap` in the default styles).
  This makes integration easier, as there are far less conflicts between the forum’s and the site’s stylesheet rules.

## Step 1: Loading the WordPress Core

Integrating parts of another site into a FluxBB style is very easy thanks to the `<pun_include>` tags.
These can be used to include custom PHP (or other) files from either the `include/user/` directory (if it does not exist, simply create it yourself) of your FluxBB copy or the directory of the style itself.
   
So, in our imaginary WordPress site, we would want to display the site’s dynamic header and footer above and below the forum, too.
WordPress’ theme architecture helps us with this: It’s themes’ files are split up into different sections, two of them header and footer.

Both template files contain a lot of WordPress functions, though, which means that they cannot just be included from the forum template.
To gain access to WordPress’ functionality, we have to include it’s loader file, `wp-load.php`, too.
The good news is that that makes loading the header and footer templates even easier, since we now have access to convenient functions.
   
So, to get started, create a file called `header.php` with the following contents in your forum’s `include/user/` directory.

~~~php
<?php
define('WP_ROOT', PUN_ROOT.'../');

require WP_ROOT.'wp-blog-header.php';
get_header();
~~~

Note: You need to set `WP_ROOT` to the directory where the WordPress files are located.
In this case, I assumed that FluxBB sits in a subfolder (e.g. `forums/`) of the main site.
You can use `PUN_ROOT` to specify a directory relative to the FluxBB base path.

In the same way, we create a file `footer.php`:

~~~php
<?php
get_footer();
~~~

This time we don’t have to load any WordPress files, since they are already included in the header.

Now we have some files with dynamic contents for our FluxBB template.
To actually insert them into the header, we have to use the `<pun_include>` tags mentioned above.

So, to use WordPress’ header, open your style’s main template file.
It is called `main.tpl` and you can usually find it in the `/style/<your_style_name>` directory.
If it doesn’t exist, switch to the `/include/template` directory and copy the `main.tpl` from there to your style’s folder.
This again prevents your changes from being overwritten when upgrading.
In that file, replace everything from the very beginning down to and including the opening `<body>` tag with the following code snippet:

~~~html
<pun_include "header.php">
~~~

We do the same for the footer by replacing everything starting at the closing `</body>` tag down to the end of the file with this code:

~~~html
<pun_include "footer.php">
~~~

If you visit your forum now, you will probably see its output between your site’s header and footer, but without any styling.

**UPDATE:**
A few readers reported problems with executing some actions in the forum.
Adding the following line right after the opening PHP tag in FluxBB’s `header.php` file seemed to solve the issue:

~~~php
global $wp, $wp_query, $wp_the_query;
~~~

## Step 2: Loading the FluxBB stylesheets from WordPress

Loading the WordPress header also means that the WordPress stylesheets are included instead of the FluxBB ones.
That means that we somehow have to insert those in the WordPress header template.
The problem: stylesheet inclusions and other header elements like RSS feed links etc. are generated dynamically.
   
Replicating that functionality in WordPress is possible, but not recommendable, because changes in the core would have to be replicated, too.
Luckily enough, the `<pun_head>` tag is used to insert the dynamic header code into the FluxBB templates, too.
Even better: `<pun_include>` tags are executed before other tags, so that we can actually use the `<pun_head>` tag in the WordPress template.

The header code which is generated by FluxBB consists of stylesheets, meta tags and feed links as well as a page title.
The latter would cause conflicts with the WordPress template, as that already contains this tag.
Instead of somehow stripping the title from FluxBB’s header code, we just use the one from the forum instead.

This only requires a small edit to the WordPress theme header file.
Somewhere in it there should be an opening `<title>` and a closing `</title>` tag with some content in between (probably PHP code).
We switch between the forum’s header and the site’s title by replacing the title tag mentioned above with the following code snippet:

~~~php
<?php if (defined('PUN_ROOT')) : ?>
<pun_head>
<?php else: ?>
<title>...here goes the old title code...</title>
<?php endif; ?>
~~~

With this done, you can now try visiting the forum.
You should see it sitting properly between your site’s header and footer. Well done!

## Step 3: Finishing

Integration probably wouldn’t be integration if it worked correctly from the very beginning on.
Well, it should be working now.
However, usually there are some rules in the forum stylesheet that make the display a little weird (obviously depending on the site’s markup).

As an example:
Assuming you are using the default “Air” style as a starting point for your forum style, you will probably notice that there is a lot of whitespace on the top and the bottom as well as on the sides of the forum.
In this case, you would have to remove the following lines from your `/style/<your_style_name>.css` file:

~~~css
.pun {
    padding: 30px 40px;
}
~~~

And now enjoy your integrated forum!


[1]: http://fluxbb.org/
