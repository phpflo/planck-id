# Todo

### general
* [ ] upload the functional version
* [x] upload the FBP version
* [x] fix sortby
* [ ] improve sortby in order to assign the smallest PlanckId to the most used Originals
* [ ] change the value objects and iterator to more functional
* [x] have breakpoints for testing 
* [x] write README.md
* [ ] format the Flo a little better 
* [x] put networks json into the corresponding files
* [ ] put the json into NoFlo for graphs
* [ ] full Documentation
* [x] separate into files
* [x] format the output: 1) Input 2) Output 3) Keys used (Original + new/minified/PlanckId
* [x] output the formatted output only once, at the end
* [x] fix debug connection
* [x] change some of the terms using `Identities` into `Plancks` & `Originals`
* [x] remove unnessecary comments
* [ ] should put Realm as its own lib
* [ ] should put utilities in its own support library and wrap functions in `if !func exists`
* [x] autoload the Components
* [x] put on packagist
* [x] automatically scale the creation of the PlanckCollectionBuilder
* [x] enable the full range of PlanckBuilder in the meantime
* [x] svg badges for github project
* [ ] upgrade the Planck to use more UPPERCASE letters
* [ ] add Inflector on the FloComponent to make an out and in port automatically on connect and disconnect (example: `function onOutExamplePortName()` and `function onInExamplePortName` and `function onExamplePortDisconnect()`
* [ ] move ReadRepeater, ReadRepeaterFinal, StyleRegexRepeater to /Core/
* [x] create Extract Component
* [x] remove need for ReadRepeater and use Extract, 
* [ ] add a .dev/non-minified version of the contents and link to it in the comments
* [x] change FloReplace using `identities` in port to `map`
* [ ] refactor the FloComponent and split inflector responsibilities to another class, possibly as Middleware for the Network - it would be easier if phpflo did not depend on eventement which uses call_user_func_array with the arguments, otherwise additional arguments could be passed in to use for inflecting.
* [ ] addPort related functions should also be moved to another class which can be injected via DI
* [ ] RegexInOut::get remove the array to string and leave that up to a dedicated Component (ArrayToString)
* [PlanckId\Utilities\Callback] add call_user_func_array

* ::isMarkup, ::isScript, ::isStyle, ::hasStyle, ::hasMarkup, ::hasScript, for identifying the content
* a method to define the type (script, style, markup) when it is passed in
* DIC in Example
* split the [Regex/] into sub modules, especially for JavaScript when matching non-vanilla/frameworks+libraries
* [x] fileType for incoming content
* [ ] refactor & rename ContentAndMap
* [ ] extract [$languages] from $content and replace|extract|extractAndReplace [$z]
(thanks Bad_Advice_Cat for these next 4)
* [x] flush out the index.php page, remove $_REQUEST use
* [x] change OutputFinal to emitt an event so the Client can register their own listener to deal with the output
* [x] put the OutputFinal output as a value object, possibly attaching the correct Component for outputting in different formats (json, html) and on different systems (cli, browser) 
* [x] implement debugging on/off

### testing
* [x] ~write it BDD 
* [x] figure out how to test best
* [x] output result to file, WriteFile 
* [x] clean up the piping, do reusable instead of many outs & ins
* [x] write initial tests
* [x] separate tests into different .features
* [x] make the tests all pass
* [x] put the tests into bdd .feature
* [x] integrate travis
* [x] if travis does not run bdd easily, run with PHPUnit
* [ ] in the tests, make sure it works WITHOUT inline scripts or styles
* [ ] test and revise for 500+ ids, remove the unique part for testing?
* [ ] extend PHPFlo tests for my extensions
* [ ] write tests for _every_ Component.
* [ ] fully implement & test Component `error`s
* [x] fix the sub `test` directory the test makes
Scenario: Extract and Minify Markup and Style Selectors from Contents using Filter
* [ ] test with Styles, but no Scripts. Test with Scripts, but no Styles. Test with Styles & Scripts, but no other Markup.
* [ ] test to show ensure that longest is first for the sorting originals
* [x] gzip comparison
* [x] create [PlanckId\Flo\ExtendedFloNetwork]
* [ ] DI in [PlanckId\Flo\ExtendedFloNetwork]
* [x] create [Planck\Flo\ExtendedFloPort] & [Planck\Flo\ExtendedFloArrayPort]to use ::isAttached
* [ ] test ^
* [ ] ask about whether it should use ::isAttached, or if it should create multiple Components
* [x] change Run.php to use PHPUnit tests which run Behat & eliminate that duplication
* [x] change TestingContentOutput to use ArrayToString
* [ ] add the additional PHPunit tests into cucumber syntax for behat

(thanks simensen)
* [x] move behat to require-dev
* [x] put bin/ test files in .gitignore

### js
* [x] JavaScript v0.1
* [ ] JavaScript extracting 
* [ ] JavaScript matching block
* [x] JavaScript replacing block 
* [x] JavaScript matching External (src=) Component
* [ ] JavaScript testing ^ 
* [ ] JavaScript Reading External File
* [ ] JavaScript testing ^
* [ ] FeatureScriptExtract
* [ ] JavaScript testing replacing isolated
* [x] JavaScript testing replacing grouped 

### markup
* [x] Markup v0.1
* [x] Markup extracting 
* [x] Markup matching classes
* [x] Markup matching identities
* [x] Markup replacing & matching contextually
* [ ] Markup replacing & matching more contextually (php)
* [x] Markup replacing classes 
* [x] Markup replacing identities 
* [ ] Markup replacing other attributes
* [x] Markup testing extraction isolated
* [x] Markup testing extraction grouped
* [ ] Markup testing replacing isolated
* [x] Markup testing replacing grouped 

### css
* [x] Style v0.1
* [x] Style extracting 
* [x] Style matching block
* [x] Style replacing block 
* [x] Style matching External (href=) Component
* [ ] testing ^ 
* [ ] Style Reading External File
* [ ] Style testing ^

### feature
* [ ] write core js matching (determine if it's vanilla js) & plugins|strategies for other syntax
* [ ] ^ with css 
* [ ] be able to paste in JS, CSS, OR Script and it identify and minify accordingly
* [ ] add back in sorting by which Selector is used most, not just the length
* [x] selector regex match - not followed by anything except specific characters, for example, it was matching .5 in background-color(0.5)
* [ ] #[keyword-todo] doesn't account for keywords & `content`
* [ ] add client defined keywords & client defined blacklisted Originals.
* [ ] add files, blacklist and whitelist other files
* [ ] be able to pass in website urls
* [ ] be able to download a zip from the processed website url
* [x] use FlySystem for files
* [x] automatically output the json network graphs to their respective files
* [x] set it to only extract from Markup, then replace only those in Script & Style
* [x] have FeatureContext use & test [Planck\Planck]
* [ ] add tests extracting only identities or classes to the app/
* [ ] add support for Twig & other templating systems (thanks @xsanisty)

### possibly in the future 
* [ ] could redo using complete OOP, also could use EDD
* [x] content could have a ReadContent & WriteContent
* [ ] could fully implement ReadContent & WriteContent 
* [ ] find why ArrayPort on the *out* port did not work (specifically, in FloReplace)
* [ ] FlattenClasses component, the nodes that have to be given string aliases each time would be much easier in NoFloJs
* [x] all Regex classes extend RegexInOut (or its subclasse) so they simply define the regex
* [ ] make more dynamic for PLUGIN ability such as attributes
* [ ] variable length arguments in FloComponent
* [ ] implement StaticContent in an alternate way
* [ ] use [phpDaemon](http://daemon.io) 
* [ ] extend or revise how to do debugging ports instead of `isConnected` which is seemingly on the wrong side of the pipe.
* [ ] each of the Regex could be a flo component that calls a RegexComponent and passes in the regex
