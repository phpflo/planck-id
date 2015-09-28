<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\Context as BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use PlanckId\App\Planck;
use PlanckId\Planck\OriginalAndPlanckMap;
use PlanckId\Planck\Plancks;
use PlanckId\Emitter;
use PlanckId\Flo\ExtendedFloGraph;

use PlanckId\App\NetworkFactory;
use PlanckId\App\PlanckFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Memory\MemoryAdapter;

#should do in the .yml
require_once __DIR__.'/../../../../bootstrap.php';

/**
 * using the legend, but also adding new ones
 */
trait FeatureExtractAndReplaceFromOriginalToPlanckMap {}


trait FeatureContents {
    /** @Given /^I have contents:$/ */
    public function iHaveContents(PyStringNode $content) {
        $this->content = $content;
        return $this;
    }
    /** @Given /^I have content "([^"]*)"$/ */
    public function iHaveContent($content) {
        $this->content = $content;
        return $this;
    }
    /** @When /^I put that into a file named "([^"]*)"$/ */
    public function thatGoesIntoAFileNamed($fileName) {
        $this->testFileName = $fileName;
        $fileHandler = fopen($this->testFileName, 'w+');
        fwrite($fileHandler, $this->content);
        fclose($fileHandler);
        return $this;
    }

    /** @Then /^I should get non string equaling "([^"]*)"$/ */
    public function iShouldGetNonStringEqualing($data) {
        if ($data !== $this->output)
            throw new Exception("Actual output is:\n" . var_export($this->output, true). "\n expected: \n" . var_export($data, true));
        return $this;
    }

    /** @Then /^I should get "([^"]*)"$/ */
    public function iShouldGet($string) {
        if ((string) $string !== (string) $this->output)
            throw new Exception("Actual output is:\n" . $this->output);
        return $this;
    }
    /** @Then /^I should gets:$/*/
    public function iShouldGets(PyStringNode $string) {
        if ((string) $string !== $this->output)
            throw new Exception("Actual output is:\n" . $this->output);
        return $this;
    }
}

trait FeatureFile {
    /** @Given /^I have input from file "([^"]*)"$/ */
    public function iHaveInputFromFile($fileName) {
        $this->content = file_get_contents($fileName);
    }
    /** @Then /^I should get the same output as the contents of the file "([^"]*)"$/ */
    public function iShouldGetTheSameOutputAsTheContentsOfTheFile($fileName) {
        $output = file_get_contents($fileName);

        lineOut(__METHOD__);
        lineOut($output);
        lineOut($this->output);
        if ((string) $output !== (string) $this->output)
            throw new Exception("Actual output is:\n" . $this->output);
    }
    /** @Given /^I am in a directory "([^"]*)"$/ */
    public function iAmInADirectory($dir) {
        if (!file_exists($dir))
            mkdir($dir);
        chdir($dir);
    }

    /** @Given /^I have a file named "([^"]*)"$/ */
    public function iHaveAFileNamed($file) {
        #touch($file);
    }

    /** @When /^I write output to a file named "([^"]*)"$/ */
    public function iWriteOutputToAFileNamed($file) {
        $handle = fopen($file, "w+");
        fwrite($handle, $this->output);
    }
}


trait FeatureScriptExtract {}

trait FeatureStyleExtract {
    /** @When /^I extract style classes$/ */
    public function iExtractStyleClasses() {
        $this->setupGraph("ExtractStyleClasses");

        $this->graph->addEdges(array(
            # this goes through some steps defined in ::setup, and then goes to OriginalsToPlancks
            ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],
        ));

        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "StyleClassesRegex_Match", "in");
    }
    /** @When /^I extract style identities$/ */
    public function iExtractStyleIdentities() {
        $this->setupGraph("ExtractStyleIdentities");

        $this->graph->addEdges(array(
            # this goes through some steps defined in ::setup, and then goes to OriginalsToPlancks
            ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],
        ));

        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "StyleIdentitiesRegex_Match", "in");
    }
    /** @When /^I extract selectors from style blocks$/ */
    public function iExtractSelectorsFromStyleBlocks() {
        $this->setupGraph("ExtractSelectorsFromStyleBlocks");

        $this->graph->addEdges(array(
            ["Style", "styleblocks", "StyleBlocksRegex_Match", "in"],
                ["StyleBlocksRegex_Match", "out", "StyleRegexRepeater", "styleblocks"],

            ["Style", "inlinestyles", "InlineStylesRegex_Match", "in"],
                ["InlineStylesRegex_Match", "out", "StyleRegexRepeater", "inlinestyles"],

            ##
            ["StyleRegexRepeater", "identities", "StyleIdentitiesRegex_Match", "in"],
              ["StyleIdentitiesRegex_Match", "out", "AddOriginals", "in"],

            ["StyleRegexRepeater", "classes", "StyleClassesRegex_Match", "in"],
              ["StyleClassesRegex_Match", "out", "AddOriginals", "in"],
        ));

        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "Style", "in");
    }
}

trait FeatureOriginalToPlanck {

    /** @When /^I turn original into planck$/ */
    public function iTurnOriginalIntoPlanck() {
        $this->setupGraph("ExtractSelectorsFromStyleBlocks");

        $this->graph->addEdges(array(
            ["StringToArray", "out", "AddOriginals", "in"],

            ["OriginalsToPlancks", "out", "FlattenAndUniqueArray", "in"],
            ["FlattenAndUniqueArray", "out", "ArrayToString", "in"],
            ["ArrayToString", "out", "TestingOutput", "in"],
        ));
        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "StringToArray", "in");
    }
    # same as iTurnOriginalIntoPlanck, but cannot pass an array in easily with Behat
    /** @When /^I turn originals into plancks$/ */
    public function iTurnOriginalsIntoPlancks() {
        $this->setupGraph("TurnOriginalsIntoPlancks");

        $this->graph->addEdges(array(
            ["StringToArray", "out", "AddOriginals", "in"],
        ));

        $this->setPlancksAsOutput();
        $this->graph->addInitial($this->content, "StringToArray", "in");
    }
}

trait FeatureMarkupExtract {
    /** @When /^I extract markup identification$/ */
    public function iExtractMarkupIdentification() {
        $this->setupGraph("ExtractMarkupIdentification");

        $this->graph->addEdges(array(
            ["Markup", "classes", "EmptyOutputForTesting", "in"],
            ###
            ["Markup", "identities", "MarkupIdentitiesRegex", "in"],
                ["MarkupIdentitiesRegex", "out", "AddOriginals", "in"],
        ));
        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "Markup", "in");
    }

    /** */
    public function initial() {
        $this->graph->addEdge("Read File", "out", "EmptyOutputForTesting", "in");
    }
    /** @When /^I extract markup classes$/ */
    public function iExtractMarkupClasses() {
        $this->setupGraph("ExtractMarkupClasses");

        $this->graph->addEdges(array(
            ["Markup", "identities", "EmptyOutputForTesting", "in"],
            ###
            ["Markup", "classes", "MarkupClassesRegex", "in"],
                ["MarkupClassesRegex", "out", "MarkupClassesFromMatchedRegex", "in"],
                    ["MarkupClassesFromMatchedRegex", "out", "AddOriginals", "in"],
        ));
        $this->setOriginalsAsOutput();
        $this->graph->addInitial($this->content, "Markup", "in");
    }

    public function assertOutput() {
        lineOut($this->output);
    }
}

trait SetupGraph {
    public function setupGraph($graphName) {
        $this->setGraphName($graphName);
        $this->graph = new ExtendedFloGraph($this->graphName);
        \setupNodes($this->graph);

        $this->setGraphEdgeToAddOriginalsToPlancks();

        lineOut($this->graph->toJSON());

        // $network
        // Make the graph "live"
        PhpFlo\Network::create($this->graph);
    }

    public function setContentAsOutput() {
    }

    public function setPlancksAsOutput() {
        $this->graph->addEdges(array(
            ["OriginalsToPlancks", "out", "ArrayToString", "in"],
            ["ArrayToString", "out", "TestingOutput", "in"],
        ));
    }
    public function setOriginalsAsOutput() {
        $this->graph->addEdges(array(
            #OutputOriginalForTesting
            ["OriginalsToPlancks", "out", "ArrayKeys", "in"],
            ["ArrayKeys", "out", "FlattenAndUniqueArray", "in"],
            ["FlattenAndUniqueArray", "out", "ArrayToString", "in"],
            ["ArrayToString", "out", "TestingOutput", "in"],
        ));
    }

    public function setGraphEdgeToAddOriginalsToPlancks() {
        $this->graph->addEdges(array(
            ["AddOriginals", "out", "RemoveUselessOriginals", "in"],
            ["RemoveUselessOriginals", "out", "SortOriginalsByLength", "in"],
            ["SortOriginalsByLength", "out", "OriginalsToPlancks", "in"],
        ));
    }

    public function setGraphEdgeToUniqueMinify() {
        $this->graph->addEdges(array(
            ["AddOriginals", "out", "RemoveUselessOriginals", "in"],
            ["RemoveUselessOriginals", "out", "FlattenAndUniqueArray", "in"],
            ["FlattenAndUniqueArray", "out", "SortOriginalsByLength", "in"],
            ["SortOriginalsByLength", "out", "OriginalsToPlancks", "in"],
        ));
    }
}


/**
 * Features context.
 *
 * [ ] or... preferably... use events to change the state of the test
 * [ ] may need $this for non PHP7
 */
class FeatureContext implements BehatContext
{
    use FeatureContents;
    use FeatureMarkupExtract;
    use FeatureScriptExtract;
    use FeatureStyleExtract;
    use FeatureFile;
    use FeatureOriginalToPlanck;
    use SetupGraph;

    public $content;
    public $output;
    public $testFileName = "";
    public $graph;
    public $graphName = "";
    public $networkFactory;
    public $planckFactory;
    public $filesystem;
    public $memoryFilesystem;


    /**
     * @param string $graphName
     * @return void
     */
    public function setGraphName($graphName) {
        $this->graphName = $graphName;
    }

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $params context params (behat.yml)
     */
    public function __construct($params = []) {
        $this->networkFactory = new NetworkFactory();
        $this->planckFactory = new PlanckFactory();
        $adapter = new Local(__DIR__.'');
        $this->filesystem = new Filesystem($adapter);
        $this->memoryFilesystem = new Filesystem(new MemoryAdapter());

        lineOut("\n<hr>___________________________________________________________________________");

        OriginalAndPlanckMap::reset();
        Plancks::reset();

        $me = $this;
        Emitter::addListener('testing.output', function ($event, $param = null) use ($me) {
            $me->output = $param;
        });
    }

    public function planckTest($name, $content, $contentType, $method, $options = array()) {
        $planck = $this->planckFactory->create($name, $contentType, $method);
        $planck->contentIn($content);
        $planck->setContentType($contentType);

        $planck->contentOut(function ($contents) use ($options) {
            if (!isset($options['mapForOutput']))
                $this->output = $contents;
        });
        $planck->mapOut(function ($map) use ($options) {
            // $this->assertEquals((string) $contents, (string) $expectedMapOutput);
            $this->memoryFilesystem->put('map.json', json_encode($map));
            if (isset($options['mapForOutput']))
                $this->output = $map; 
            if (isset($options['mapOriginalsForOutput']))
                $this->output = implode(",", array_keys($map));
            if (isset($options['mapPlancksForOutput']))
                $this->output = implode(",", $map);
        });

        // it will not be there the first time
        // subsequent times however, it will be
        if ($this->memoryFilesystem->has('map.json')) {
            $mapJson = $this->memoryFilesystem->read('map.json');
            $map = json_decode($mapJson, true);
            $planck->mapIn($map);
        }

        $this->networkFactory->createFromPlanck($planck);

        return $planck;
    }

    /** @When /^I only extract$/ */
    public function onlyExtract() {
        $this->planckTest(__METHOD__, $this->content, 'mixed', Planck::EXTRACT, ['mapForOutput' => true, 'mapOriginalsForOutput' => true]);
    }
    /** @When /^I extract using existing map$/ */
    public function extractUsingExistingMap($map) {            
        $this->memoryFilesystem->put('map.json', json_encode($map));
        $this->planckTest(__METHOD__, $this->content, 'mixed', Planck::EXTRACT_AND_REPLACE, ['mapForOutput' => true]);
    }

    /** @When /^I replace using existing map$/ */
    public function replaceUsingExistingMap($map = null) {        
        if (!$map) {
            $map = [
                "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
                "post-simple-media-adjacent-left-8-media" => "b",
                "media-adjacent" => "c",
                "post-simple" => "d",
                "left" => "e",
                "else" => "f",];
        }
        $this->memoryFilesystem->put('map.json', json_encode($map));
        $this->planckTest(__METHOD__, $this->content, 'mixed', Planck::EXTRACT_AND_REPLACE);    
    }

    /** @When /^I extract style selector originals$/ */
    public function iExtractStyleSelectorOriginals() {
        $this->planckTest(__METHOD__, $this->content, 'style', Planck::EXTRACT, ['mapForOutput' => true, 'mapOriginalsForOutput' => true]);
    }

    /** @When /^I extract and minify$/ */
    public function iExtractAndMinify() {      
        $this->planckTest(__METHOD__, $this->content, 'mixed', Planck::EXTRACT_AND_REPLACE);
    }

    /** @When /^I extract markup classes and identities$/ */
    public function iExtractMarkupClassesAndIdentities() {
        $this->planckTest(__METHOD__, $this->content, 'markup', Planck::EXTRACT, ['mapForOutput' => true, 'mapOriginalsForOutput' => true]);
    }
}
