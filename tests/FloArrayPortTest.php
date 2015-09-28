<?php

namespace PlanckId;

use FeatureContext;

use PlanckId\Emitter;
use PlanckId\Flo\ExtendedFloGraph;
use PlanckId\Flo\ExtendedFloNetwork;
use PlanckId\Flo\ExtendedFloPort;
use PlanckId\Flo\ExtendedFloArrayPort;
use PlanckId\Flo\FloComponent;
use PlanckId\Flo\InvokableFloComponent;

/**
 * public static ONLY FOR EASE OF TESTING
 * could use another class 
 * in combination with this one 
 * to add up the total amount which can be used testing, 
 * or emit an event.
 */
class MockEndComponent extends FloComponent {
    public static $timesInPortFlowed = 0;

    public function __construct() {
        $this->addPorts(array(
            ['in', 'in', array()], 
            ['in', 'in2', array()], 
        ));

        $this->inPorts['in']->on('data', [$this, 'increment']);
        $this->inPorts['in2']->on('data', [$this, 'increment2']);
    }

    public function increment() {
        self::$timesInPortFlowed = 1;
        $this->displayTimesInPortFlowed();
    }
    public function increment2() {
        self::$timesInPortFlowed++;
        $this->displayTimesInPortFlowed();
    }

    public function displayTimesInPortFlowed() {
        // lineOut($this->timesInPortFlowed);
    }
}

/**
 * if one in port disconnects, does it disconnect the whole port for all other in the array?
 */
class MockFloArrayPortInAndArrayPortOut extends FloComponent {
    public function __construct() {
        $this->addPorts(array(
            ['in', 'in', array()], 
            ['out', 'out', array()],
        ));

        $this->inPorts['in']->on('data', [$this, 'arrayPortOuts']);
    }

    public function arrayPortOuts($data) {
        lineOut(__METHOD__);
        $this->outPorts['out']->sendAll($data);
    }
}

class MockRepeaterComponent extends InvokableFloComponent {
    public function __invoke($data) {
        $this->outPorts['out']->send($data);
        $this->outPorts['out']->disconnect();
    }
}

class FloArrayPortTest extends \PHPUnit_Framework_TestCase {
    # public function testArrayPortIn(){}    

    public function testArrayPortOut() {      
        $graph = new ExtendedFloGraph("arrayporttest");
        $graph->addNode("MockFloArrayPortInAndArrayPortOut", "PlanckId\MockFloArrayPortInAndArrayPortOut");

        $graph->addNode("MockEndComponent1", "PlanckId\MockEndComponent");
        $graph->addNode("MockEndComponent2", "PlanckId\MockEndComponent");

        $graph->addNode("MockRepeaterComponent1", "PlanckId\MockRepeaterComponent");
        $graph->addNode("MockRepeaterComponent2", "PlanckId\MockRepeaterComponent");
        
        $graph->addEdges(array(    
            ["MockRepeaterComponent1", "out", "MockFloArrayPortInAndArrayPortOut", "in"], 
          
            ["MockFloArrayPortInAndArrayPortOut", "out", "MockEndComponent1", "in"], 
            ["MockFloArrayPortInAndArrayPortOut", "out", "MockEndComponent1", "in2"], 
            ["MockFloArrayPortInAndArrayPortOut", "out", "MockEndComponent2", "in"], 
            ["MockFloArrayPortInAndArrayPortOut", "out", "MockEndComponent2", "in2"], 
        ));           
        $graph->addInitial("testing", "MockRepeaterComponent1", "in");
        ExtendedFloNetwork::create($graph);

        $this->assertEquals(2, MockEndComponent::$timesInPortFlowed);
    }
}
