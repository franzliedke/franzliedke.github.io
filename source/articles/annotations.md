---
extends: _layouts.blog
section: content
title: "Annotations – show me the benefits!"
date: "2014-10-21"
---

Last week, a discussion was raging in the Laravel community.
Taylor recently introduced the usage of annotations throughout the framework.
Developers can now, for example, declare their routes inside controllers.

~~~php
class TreesController {
    /**
     * @Get("/trees/{id}", as="tree")
     */
    public function view($id)
    {
        // Retrieve tree and return
    }
}
~~~

Annotations are not a core feature of the PHP programming language.
This has started a lot of [controversy][1] and heated discussion in the community.

I am not trying to add to the fire, but I do want to state my objections against annotations.

Before I start, let us not forget the benefits.
I understand the argument that annotations can speed up development.
Thus, I see it as another feature that enables rapid application development.
This is useful when quickly building prototypes or creating small APIs.

In the discussions that I have read, and in the answers I got when asking in the developer channel, this was the only real benefit I could find.
And it is a good one.
Laravel has proven before that one of its main goals is the simplification of common tasks.

In my opinion, though, the disadvantages outweigh the benefit in this case.

### Disadvantages
Embedding routes inside controllers **breaks the separation of concerns**.
Even though the two are related, they still represent two different concepts and responsibilities.
Controllers are responsible for the application flow.
This usually means retrieving data from the domain layer and passing it on to views.
Routes map HTTP requests to controller actions.
This is not necessarily a one-to-one mapping.

The single responsibility principle states: Classes should have only one reason to change.
This principle is clearly broken in this case.
Controllers are suddenly affected by changes in a site’s URL structure.
We can also turn this principle around.
In a perfect world, I only want to look at one place when I change one aspect of a project.
In this case, for changing URLs, this would be my routes file.
With annotations, my **routes are [scattered][3]** all over my project.

Then, of course, **annotations are comments**.
This is not a question of purity.
Even though the PHP interpreter [parses doc blocks][4], they are still comment blocks.
And never, ever should my code’s behavior change when I change or remove comments.

I would argue that annotations are also **harder to understand**.
Apart from the routing annotation, they do not add any new features.
In Laravel 4, you could include or exclude filters to be run before or after controller actions.
Within a line of code.
This feature was removed in Laravel 5 and replaced by middleware annotations.

> As far as I understand, one of the goals in changing the controllers in version 5 was to make them less framework-dependent.
> Thus, the ability to include or exclude filters from within special methods of your controller had to go.
> And yet, they were reintroduced in the form of these annotations.

In my opinion, one of the biggest strengths of Laravel has always been its immense flexibility.
I could dive into the source code, and because everything was just PHP, it was easy to follow the trail of method calls.
With annotations, not so much.
When looking at a controller, where do you even start if you want to understand their implementation?

### Conclusion
At the end of the day, I want my code to be maintainable in the long run.
This should always be on our minds when we make decisions about architecture.
For me, annotations do not help with maintainability.
As mentioned before, they break the separation of concerns.
Magical things happen because of code comments.
And my code becomes harder to read for other developers.

From my experience, a little bit of explicitness can go a long way toward maintainability.
With all my routes explicitly declared in one place, I get a nice overview and a single place to change routes.
With all of them scattered across my controllers, maintainability suffers.

That said, I don’t want to bash the introduction of annotations.
But I do not understand why they are advertised in the way they are.
I can see how they could speed up development for small apps, but is that enough?

Of course I don’t have to use annotations.
But would you agree that annotations in this form may harm long-term maintainability?
If so, you might also agree that they should not be promoted as best practices.

So what do you think?
Do you hate annotations or love the new feature?
And if so, can you explain the benefits?
Are the aforementioned disadvantages relevant to you?

[1]: https://laracasts.com/discuss/channels/general-discussion/route-annotation-in-laravel-5 "Laracasts discussion on route annotations"
[2]: http://www.reddit.com/r/laravel/comments/2jex9b/introducing_route_annotations_in_laravel_50/ "Discussion about route annotations on Reddit"
[3]: http://en.wikipedia.org/wiki/Aspect-oriented_programming#Motivation_and_basic_concepts "Scattering in the context of Aspect-oriented programming"
[4]: http://php.net/manual/en/reflectionfunctionabstract.getdoccomment.php "PHP documentation on function doc blocks"
