#planck-id V0.7.84
![shrinking](http://jonlieffmd.com/wp-content/uploads/2012/01/512px-Scale_one_to_thousand_volume.svg_3.png)

## What is it?
Minifies (almost) all HTML ids + classes, & CSS + JS selectors.

## Example
Turns this:
```html
<a href="https://packagist.org/login/github" class="pull-right btn btn-primary btn-github">
    <span class="icon-github"></span>Use Github
</a>
<style>.pull-right, .btn, .btn-primary, .btn-github, .icon-github {}</style>
<style>.btn{}</style>
<script>var githubButtons = document.getElementsByClassName('btn-github');</script>
<script>githubIconButtons = $('.icon-github');</script>
```
Into this: 
```html
<a href="https://packagist.org/login/github" class="c e a d">
    <span class="b"></span>Use Github
</a> 
<style>.c, .e, .a, .d, .b {}</style>
<style>.e{}</style> 
<script>var githubButtons = document.getElementsByClassName('d');</script>
<script>githubIconButtons = $('.b');</script>
```

## Graphs
Put the .json files from [planck-id/graphs](http://github.com/aretecode/planck-id/graphs/) into [NoFlo](http://noflojs.org)

## Installation
It can be installed from [Packagist](https://packagist.org/planck-id) using [Composer](https://getcomposer.org/). Make sure your `composer.json` contains:
```json
require {
    "aretecode/planck-id"
}
```

then, run: 
```
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

## Use
Either

1. Open command line and change directories to `your-project/planck-id`, then run `php index.php YourFileNameHere`
2. Navigate your browser to `your-project/planck-id/index.php?filename=yourFullFileUrl` or `your-project/planck-id/index.php?content=allOfYourContentHere`

## Terminology
* _Planck_: ([Planck length](https://en.wikipedia.org/wiki/Planck_length), in principle, the shortest measurable length.) an instance of the shortest available valid class/id/selector. 
* _Original_: the _class/id/selector_ before it was turned into a Planck. (I'm open to changing this, feel free to suggest a new term.)

## Running tests
1. Run in the browser by navigating to `your-project/planck-id/tests/Run.php`
2. Run via the command line by changing your directory to  `planck-id/bin`
3. Run through the command line by going to `planck-id` and running `phpunit`

(_these tests use a snippet from thegrids website_)

## [Todos](https://github.com/aretecode/planck-id/TODO.md)

[![Build Status](https://secure.travis-ci.org/aretecode/planck-id.svg)](https://travis-ci.org/aretecode/planck-id)]