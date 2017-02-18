---
extends: _layouts.blog
section: content
title: "Laravel 4: Route parameter binding"
summary: "A useful feature that lets you DRY out your controllers."
date: "2013-05-27"
---

The final release of Laravel 4.0 is right around the corner.
In fact, it’s tomorrow that the new version will see the light of the world.

So much has changed and improved in this new version that it is hard to keep track of all the good new things.
Thus, I decided to start a little series on some hidden gems of the framework: let us dive into some of the lesser-known features that can really make daily development even more pleasant – if you know they exist!

In your controllers, you might find yourself writing code like this pretty often:

~~~php
public function view($id)
{
    $model = MyModel::find($id);
    if (is_null($model))
    {
        App::abort(404);
    }
    // Render view etc.
}
~~~

Now, this can become quite repetitive and boring.
Thankfully, Taylor added a new feature in Laravel 4 that allows you to bind the respective model to your parameter during routing.
Behold, route parameter binding:

~~~php
Route::bind('mymodel', function($value, $route) {
    return MyModel::findOrFail($value);
});
~~~

This makes sure the closure will be executed every time you name a parameter “mymodel” in your routes.
Note the use of the `findOrFail()` method.
This takes care of throwing an exception in case the model can not be found.
To actually use this feature, you need to adapt your routes, too:

~~~php
Route::get('models/{mymodel}', 'MyController@view');
~~~

That also means that your controller method will now be passed a Model instance instead of the parameter value:

~~~php
public function view(MyModel $model)
{
    // Render view etc.
}
~~~

And last but not least, for this classic model use-case, the framework offers another shortcut that fetches a model for the given class name by ID:

~~~php
Route::model('mymodel', 'MyModel');
~~~

This does exactly what we did earlier with `Route::bind()`, except we don’t have to write the code ourselves.
Isn’t that great?
For more information, refer to the [documentation][1].

[1]: http://laravel.com/docs/routing#route-model-binding "Laravel documentation on route model binding"
