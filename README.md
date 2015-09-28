#PlanckId (planck-id)
[![Build Status](https://secure.travis-ci.org/aretecode/planck-id.svg)](https://travis-ci.org/aretecode/planck-id)
[![License](https://poser.pugx.org/aretecode/planck-id/license)](http://packagist.org/packages/aretecode/planck-id)
[![Latest Unstable Version](https://poser.pugx.org/aretecode/planck-id/v/unstable)
[![Codacy Badge](https://api.codacy.com/project/badge/6ea69f611cb84c63862b2750a5e48563)](http://www.codacy.com/app/aretecode/planck-id)
![shrinking](http://jonlieffmd.com/wp-content/uploads/2012/01/512px-Scale_one_to_thousand_volume.svg_3.png)

## What is it?
Minifies (almost) all HTML ids + classes, & CSS + JS selectors.

## Example
Turns this:
```html
<a href="https://packagist.org/login/github" class="pull-right btn btn-primary btn-github">
    <span class="icon-github" id="special_github"></span>Use Github
</a>
<style>.pull-right, .btn, .btn-primary, .btn-github, .icon-github {} #special_github</style>
<style>.btn{}</style>
<script>var githubButtons = document.getElementsByClassName('btn-github'); var specialGithub = document.getElementById('special_github');</script>
<script>githubIconButtons = $('.icon-github');</script>
```
Into this: 
```html
<a href="https://packagist.org/login/github" class="c e a d">
    <span class="b" id="f"></span>Use Github
</a>
<style>.c, .e, .a, .d, .b {} #f</style>
<style>.e{}</style>
<script>var githubButtons = document.getElementsByClassName('d'); var specialGithub = document.getElementById('f');</script>
<script>githubIconButtons = $('.b');</script>
```

## Graphs
Put the .json files from [planck-id/graphs](http://github.com/aretecode/planck-id/graphs/) into [NoFlo](http://noflojs.org)

## Installation
It can be installed from [Packagist](https://packagist.org/planck-id) using [Composer](https://getcomposer.org/). Make sure your `composer.json` contains:
```json
{
    "require": {
        "aretecode/planck-id"
    }
}
```

then, run: 
```
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```


## Use
### Basic Usage
## [See examples](https://github.com/aretecode/planck-id/blob/master/examples)

## Command Line
#### Converting a file named markup.html:
`planck markup.html`
#### Converting a file named markup.html:
`planck markup.html --debug`
#### Converting a file and saving its output:
`planck markup.html > output.html`
#### Converting a file using an existing map replacing a style file:
`planck style.css map.json style Replace` 
#### Converting a file using an existing map, extracting more to add to the map, then replacing a style file:
`planck style.css map.json style ExtractAndReplace`
#### Extracting the the contents of a file and adding it to a map:
`planck markup.html map.json markup Extract`
#### Converting from STDIN
```echo -e '<section class="post-simple media-adjacent"></section><style>.post-simple{}</style>' | planck```
#### Converting from STDIN and saving the output:
```echo -e '<section class="post-simple media-adjacent"></section><style>.post-simple{}</style>' | planck > output.html```


## Terminology
* _Planck_: ([Planck length](https://en.wikipedia.org/wiki/Planck_length), in principle, the shortest measurable length.) an instance of the shortest available valid class/id/selector. 
* _Original_: the _class/id/selector_ before it was turned into a Planck. (I'm open to changing this, feel free to suggest a new term.)

## How does it do this?
Using [Flow Based Progamming](http://www.jpaulmorrison.com/fbp/) it creates a  `map<original, planck>` according to the requirements, then passes the content into the series of components to achieve the desired outcome. 

## Running tests
1. Run in the browser by navigating to `planck-id/tests/Run.php`
2. Run via the command line by changing your directory to `planck-id/bin` and then running `behat`
3. Run via the command line by going to `planck-id` and running `phpunit`

(_these tests use a snippet from thegrids website_)

## [Todos](https://github.com/aretecode/planck-id/blob/master/TODO.md)