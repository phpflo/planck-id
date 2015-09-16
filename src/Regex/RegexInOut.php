<?php 

namespace PlanckId\Regex;

use InvalidArgumentException;
use PlanckId\Flo\FloComponent;
use Illuminate\Support\Arr;
use PlanckId\Emitter;

/**
 * could also pass a regex in as an inPort
 */
class RegexInOut extends FloComponent
{   
    protected $regex = "";
    protected $ports = array(
        ['out', 'err'], 
        'in',   
        'out',  
    );
     
    public function __construct() {
        $this->addPorts($this->ports);
        $this->onIn('in', 'data', 'outs');
    }

    /**
     * @uses   $this->regex
     * @param  mixed $data 
     * @return array matches 
     */
    protected function get($data) {
        $dataExtended = $data;
        if (is_array($data)) 
            $dataExtended = implode(" ", $data);

        $matches = pregMatchAll($dataExtended, $this->regex);        
        if (is_array($matches)) 
            $matches = Arr::flatten($matches);

        if (is_array($matches) && count($matches) === 0 && $this->outPorts['err']->isConnected()) 
            $this->outPorts['err']->send($matches);

        Emitter::emit('regex.inout', $matches, Static::class);

        return $matches;
    }

    /**
     * @param string $data 
     * @out array<string|array<string>> matches
     * @return void
     */
    public function outs($data) {
        lineOut(__CLASS__ . ".> " .Static::class . " " . __METHOD__);
        $dataOut = $this->get($data);

        $this->outPorts['out']->send($dataOut);
        $this->outPorts['out']->disconnect();
    }
}   