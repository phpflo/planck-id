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
* [ ] should put utilities in its own support library
* [ ] autoload the Components
* [x] put on packagist
* [ ] automatically scale the creation of the PlanckCollectionBuilder
* [x] enable the full range of PlanckBuilder in the meantime
* [x] svg badges for github project
* [ ] upgrade the Planck to use more UPPERCASE letters

(thanks Bad_Advice_Cat for these next 4)
* [ ] flush out the index.php page, remove $_REQUEST use
* [ ] change OutputFinal to emitt an event so the Client can register their own listener to deal with the output
* [ ] put the OutputFinal output as a value object, possibly attaching the correct Component for outputting in different formats (json, html) and on different systems (cli, browser) 
* [ ] fully implement debugging on/off

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
* [ ] Style matching External (href=) Component
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
* [ ] be able to pass in website urls
* [ ] be able to download a zip from the processed website url
* [ ] use FlySystem for files
* [ ] automatically output the json network graphs to their respective files

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