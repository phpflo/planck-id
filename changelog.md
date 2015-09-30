# Changelog

## 0.11.2 - 30/09/15
### Fixed
* bootstrap.php removed & files loaded using composer

## 0.11.1 - 28/09/15
### Added
* [PlanckId\App\Traits\MixedExtractStrategy] created
* [PlanckId\App\Traits\MixedReplaceStrategy] created
* [PlanckId\App\Traits\MarkupExtractAndReplaceStrategy] created
* [PlanckId\App\Traits\MarkupReplaceStrategy] created
* [PlanckId\App\Traits\MarkupExtractStrategy] created

### Fixed
* index.php removed, later an ajax solution will be added
* tests upgraded to use [src/App/] similar to [example/

## 0.11.0 - 27/09/15
### Added
* [PlanckId\App\Traits\ExtractStyle] created
* [PlanckId\App\Traits\ExtractStyleBlocks] created
* [PlanckId\App\Traits\ExtractMarkup] created
* [PlanckId\App\Traits\ExtractAndReplaceFlo] created
* [PlanckId\App\Traits\ExtractFlo] created
* [PlanckId\App\Traits\ReplaceFlo] created
* [PlanckId\App\Traits\ReplaceAfter] created
* [PlanckId\App\Traits\ReplaceMarkup] created
* [PlanckId\App\Traits\ReplaceScript] created
* [PlanckId\App\Traits\ReplaceScriptBlocks] created
* [PlanckId\App\Traits\ReplaceStyle] created
* [PlanckId\App\Traits\ReplaceStyleBlocks] created
* [PlanckId\App\Factory] created
* [PlanckId\App\StyleReplaceStrategy] created
* [PlanckId\App\StyleExtractStrategy] created
* [PlanckId\App\StyleExtractAndReplaceStrategy] created
* [PlanckId\App\ScriptReplaceStrategy] created
* [PlanckId\example\AbstractExample] created
* [PlanckId\example\Example0], [PlanckId\example\Example1], [PlanckId\example\Example2], [PlanckId\example\Example3], [PlanckId\example\Example4] created
* implement saving of graphs to json files

### Fixed
* updated Readme testing instructions and API usage.
* removed symfony/command dependency
* removed monolog dependency
* [bin/Planck.php] changed to [bin/planck]
* [PlanckId\App\NetworkBuilder] removed for now until it is more
* [PlanckId\App\ReadRepeaterFinal] removed 

## 0.10.0 - 26/09/15
### Added
* [PlanckId\App\GraphBuilder] created
* [PlanckId\App\NetworkBuilder] created
* [PlanckId\App\PlanckFactory] created
* [PlanckId\App\GraphStrategy] created
* [PlanckId\App\AbstractGraphStrategy] created
* [PlanckId\App\ReplaceStrategy] created
* [PlanckId\App\MixedExtractAndReplaceStrategy] created

### Fixed
* [PlanckId\Replace\JavaScript] big revamp
* [PlanckId\Content\ContentFinal] removed


## 0.9.3 - 24/09/15
### Fixed
* [PlanckId\Replace\JavaScript] big revamp
* [PlanckId\Content\ContentFinal] removed

## 0.9.2 - 23/09/15
### Added
* composer.json `extra` added
* [PlanckId\Regex\PhpBlocksRegex] created, needs work
* [PlanckId\Regex\RegexInOut] in `regexpiece` port and its respective setter function
* [PlanckId\Regex\JavaScriptSelectorRegex] created

### Fixed
* [PlanckId\Utilities\Callback] calling the variable function - was calling the method
* test/* style blocks
* [PlanckId\Replace\ReplaceJavaScript] using preg_replace_callback made the context a bit more specific

## 0.9.1 - 22/09/15
### Added
* [bin/Planck.php] created for running commands
* [example/] created
* symfony/console to composer.json
* [PlanckId\Utilities\Callback] created
* [PlanckId\Regex\StyleIdentitiesRegex] added global single line modifier

### Fixed
* removed [PlanckId\Output\OutputFile]
* removed [PlanckId\Output\OutputFinal] 
* updated composer dependency versions
* [PlanckId\Utilities\JsonDecode] added in ports "asarray" & "asobject"
* 

## 0.9.0 - 21/09/15
### Added
* Added Changelog
* Added testOnlyExtract
* [PlanckId\Utilities\ArrayKeys] created
* [PlanckId\Utilities\JsonEncode] created 
* [PlanckId\Utilities\JsonDecode] created 
* Added PHP5.6+ requirement to composer
* create [PlanckId\Core][\setupNodes()] to share graph node setup across the index & tests
* [PlanckId\Planck\PlanckCollectionBuilder::singleUppercaseLetter()] created function for UPPERCASE letter range
* [PlanckId\Planck\OriginalAndPlanckMap::hasPlanck()] added
* [PlanckId\Planck] created

### Fixed
* [PlanckId\Output\OutputOriginalForTesting] deleted, using ArrayKeys instead
* [PlanckId\Utilities\ForEachRepeat] typo using || insteadof &&
* [PlanckId\Replace\ReplaceJavaScriptContent], [PlanckId\Replace\ReplaceMarkupClasses],  [PlanckId\Replace\ReplaceMarkupIdentities],  [PlanckId\Replace\ReplaceStyleSelectors], changed to use ::sendIfAttached() 
* [PlanckId\Replace\Replace] changed to extend [PlanckId\Flo\InvokableFloComponent]
* [PlanckId\Utilities\FlattenAndUniqueArray] fixing Laravel namespace
* [bin\floidentity\features\bootstrap\FeatureContext as FeatureContext] 
* [FeatureContext::setMapAsOutput()], [FeatureContext::setPlancksAsOutput()], [FeatureContext::setOriginalsAsOutput()] changed from using `identity` & `minified`, upgraded in order to relieve TestingContentOutput of responsibilities it does not need to be doing
* [PlanckId\Output\TestingContentOutput] changed to not do more than it needs
* change `setUp` to `setup`
* [(file) PlanckId\tests\ExtractStyleOriginalTest] mismatch for classname [(class) PlanckId\tests\ExtractStyleClassTest] renamed file and class to [PlanckId\tests\ExtractStyleTest] 
* same as ^ with ExtractMarkupClassesTest & ExtractMarkupClassesTest
* change Run.php to use PHPUnit tests which run Behat & eliminate that duplication
* changed composer.json to use PSR-4 & autoload, removing bootstrap.php manual loading
* updated composer dependencies
* [PlanckId\Planck\OriginalAndPlanckMap] /** docblocked */
* [PlanckId\Planck\PlanckCollectionBuilder] visibility added to functions
* trailing whitespace cleaned up
* [PlanckId\Flo\ExtendedFloNetwork] moved phpflo/Network contents over, since the properties were @private
* updated behat version in composer

## 0.8.0 - 21/09/15
### Added
* Added Todos.
* Completed some Todos (StyleFileSourceRegex)
* [PlanckId\Utilities\ForEachRepeat] created
* [PlanckId\Flo\ExtendedFloNetwork] created
* [Flo/ExtendedFloPort] & [Flo/ExtendedFloArrayPort] created
* Initial Testing for [PlanckId\Flo\ExtendedFloPort] & [PlanckId\Flo\ExtendedArrayPort]
* [PlanckId\Flo\FloComponent::sendThenDisconnect] created
* [PlanckId\Flo\FloComponent::sendIfAttached] created
* [PlanckId\Flo\FloComponent::disconnectIfAttached] created
* [PlanckId\Flo\FloComponent::sendAndDisconnectAll] created
* [PlanckId\Core\ExtractOriginals] created
* [PlanckId\Core\ContentAndMap] created
* [PlanckId\Core\ExtractOriginals] created
* [PlanckId\Originals\WriteOriginalAndPlanckMap] create

### Fixed
* [PlanckId\Flo\FloComponent::errorOut] using isAttached()
* [PlanckId\Core\FloReplace] update to use new arrayPortOut convenience methods
* [PlanckId\Core\ReadExternalFile] removed some unnecessary code, used some of the new convenience methods in FloComponent
* 'err' changed back to 'error' 
* 'error' to ['out', 'error']
