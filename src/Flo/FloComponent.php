<?php

namespace PlanckId\Flo;

use PhpFlo\Component;
use PhpFlo\Port;
use PhpFlo\ArrayPort;
use InvalidArgumentException;
use PlanckId\Emitter;

/**
 * Extension to the Component adding the ability to create components without unessecary duplication
 */
class FloComponent extends Component {
  
    /**
     * @example
     *     array<array('in')> && array<'in'>             # are the same
     *     array<[('in', 'delimiter')], ['out', 'out']>  # in-delimiter port & an out-out port
     *       
     * @param  array $ports
     * @return void
     */
    protected function addPort($port) {
        $portType = $this->portType($port);
        $portSubType = $this->portSubType($port, $portType);
        $this->errorTest($portType);

        // example `inPorts` 
        $portTypeMethod = $portType . 'Ports';
        
        if ($portTypeMethod !== 'inPorts' && $portTypeMethod !== 'outPorts') 
            return;
        if ($portSubType == 'err') 
            return;
            // throw new InvalidArgumentException("attempted to use a non `out` or `in` port, used: `$portTypeMethod`");

        // able to be used in debugging
        Emitter::emit('flocomponent.addingPort', ['class' => Static::class, $port]);

        // example `$this->inPorts['delimiter'] = new Port`
        if (isset($port[2])) 
            $this->$portTypeMethod[$portSubType] = new ArrayPort();
        else 
            $this->$portTypeMethod[$portSubType] = new Port();
    }

    private function errorTest($portType) {
        if (!containsSubString($portType, 'in') && !containsSubString($portType, 'out') && !containsSubString($portType, 'err')) 
            if (isset($this->outPorts['err']) && $this->outPorts['err']->isConnected()) 
                $this->outPorts['err']->send('did not contain in or out! instead it was: `' . $portType . '`; ');
    }

    /**
     * @throws InvalidArgumentException if $port is not string or array
     * @param  string|array $port
     * @return Port
     */
    private function portType($port) {
        if (is_array($port)) 
            return $port[0];
        if (is_string($port)) 
            return $port;
        else 
            throw new InvalidArgumentException('port type was not a string or array, it was: `' . var_export($port, true) . '`');
    }

    /**
     * if it has something at position 1, use that, or else use the type
     * 
     * @throws InvalidArgumentException if $port is not string or array
     * @param  string|array $port
     * @param  string|null  $portType
     * @return Port
     */
    private function portSubType($port, $portType) {
        if (is_array($port)) 
            return isset($port[1]) ? $port[1] : $portType;
        elseif (is_string($port)) 
            return $port;
        else 
            throw new InvalidArgumentException('port type was not a string or array, it was: `' . var_export($port, true) . '`');
    }

    /**
     * [ ] variable length arguments
     * must contain 'in' | 'out'
     * @example
     *     array<array('in', 'in'), array('in', 'delimiter'), ['out', 'out'] | 'in'>
     * @param  array $ports
     * @return void
     */
    protected function addPorts(array $ports) {
        foreach ($ports as $port) 
            $this->addPort($port);
    }

    /**
     * shorthand usage of `on` so we don't have to pass in an array containing $this every time
     * @param  string $event   
     * @param  string $listener 
     * @return void
     */
    protected function onOut($name, $event, $listener) {
        $this->outPorts[$name]->on($event, array($this, $listener));
    }        

    /**
     * shorthand usage of `on` so we don't have to pass in an array containing $this every time
     * @param  string $event   
     * @param  string $listener 
     * @return void
     */
    protected function onIn($name, $event, $listener) {
        $this->inPorts[$name]->on($event, array($this, $listener));
    }        
}