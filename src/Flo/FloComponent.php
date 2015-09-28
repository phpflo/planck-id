<?php

namespace PlanckId\Flo;

use InvalidArgumentException;
use PhpFlo\Component;
use PhpFlo\Port;
use PhpFlo\ArrayPort;
use PlanckId\Emitter;

/**
 * Extension to the Component adding the ability to create components without unessecary duplication
 */
abstract class FloComponent extends Component {

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

        // able to be used in debugging
        Emitter::emit('flocomponent.addingPort', ['class' => static::class, $port]);

        // example `$this->inPorts['delimiter'] = new Port`
        if (isset($port[2]))
            $this->{$portTypeMethod}[$portSubType] = new ExtendedFloArrayPort();
        else
            $this->{$portTypeMethod}[$portSubType] = new ExtendedFloPort();
    }

    /**
     * @example:
     *     `identities In On Data`
     *
     * @credit:
     *     https://github.com/thephpleague/tactician/blob/master/src/Handler/MethodNameInflector/MethodNameInflector.php
     *
     * @param  array|string
     * @return void
     */
    public function setupPortEventListenersUsingInflector() {
        $this->loopPortsToAddEventListeners(array_keys($this->inPorts));
        $this->loopPortsToAddEventListeners(array_keys($this->outPorts));
    }
    public function loopPortsToAddEventListeners($ports) {
        foreach ((array)$ports as $port) {
            $portType = $this->portType($port);
            $portSubType = $this->portSubType($port, $portType);
            $portTypeMethod = $portType . 'Ports';
            $this->addListenersIfMethodsExist($portSubType, $portType, $portTypeMethod);
        }
    }

    /**
     * @param  string $portSubType
     * @param  string $portType
     * @param  string $portTypeMethod
     * @return void
     */
    protected function addListenersIfMethodsExist($portSubType, $portType, $portTypeMethod) {
        $eventNames = ['data', 'disconnect', 'connect', 'attach'];
        foreach ($eventNames as $eventName) {
            $method = $this->inflectInternalMethod($portSubType, $portType, $eventName);

            // making sure we have this method and also that the porttype at that position exists
            if (method_exists($this, $method) && isset($this->{$portTypeMethod}[$portSubType]))
                $this->{$portTypeMethod}[$portSubType]->on($eventName, [$this, $method]);
        }
    }
    /**
     * @param  string $portSubType
     * @param  string $portType
     * @param  string $eventName
     * @return string
     */
    protected function inflectInternalMethod($portSubType, $portType, $eventName) {
        return $portSubType . $portType . 'On' . ucfirst($eventName);
    }

    /**
     * @param  string $portType
     * @return void
     */
    private function errorTest($portType) {
        if (!containsSubString($portType, 'in') && !containsSubString($portType, 'out') && !containsSubString($portType, 'error'))
            if (isset($this->outPorts['error']) && $this->outPorts['error']->isAttached())
                $this->outPorts['error']->send('did not contain in or out! instead it was: `' . $portType . '`; ');
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

    /**
     * shorthand usage of sending through multiple out ports
     * @param  array      $names
     * @param  mixed      $data
     * @param  bool       $ifAttached
     * @param  int|bool   $arrayPort to send out to all connected
     * @return bool
     */
    protected function sendAll($names = array(), $data, $ifAttached = true, $arrayPort = true) {
        foreach ($names as $name)
            $this->sendOut($name, $data, $ifAttached, $arrayPort);
    }

    /**
     * @see    ::sendAll()
     * @see    ::sendThenDisconnect()
     * @param  array      $names
     * @param  mixed      $data
     * @param  bool       $ifAttached
     * @param  int|bool   $arrayPort to send out to all connected
     * @return bool
     */
    protected function sendThenDisconnectAll($names = array(), $data, $ifAttached = true, $arrayPort = true) {
        foreach ($names as $name) {
            $this->sendOut($name, $data, $ifAttached, $arrayPort);
            $this->disconnectIfAttached($name);
        }
    }

    /**
     * shorthand usage of sending then disconnecting
     * could method extract sending to both send and disconnect
     * @param  array      $names
     * @param  mixed      $data
     * @param  bool       $ifAttached
     * @param  int|bool   $arrayPort  to send out to all connected
     * @return bool
     */
    protected function sendThenDisconnect($name, $data, $ifAttached = true, $arrayPort = true) {
        $this->sendOut($name, $data, $ifAttached, $arrayPort);
        return $this->disconnectIfAttached($name);
    }

    /**
     * shorthand usage of sending out if it's attached
     * @param  string     $name
     * @param  mixed      $data
     * @param  int|bool   $arrayPort
     * @return bool
     */
    protected function sendIfAttached($name, $data, $arrayPort = true) {
        if ($this->outPorts[$name]->isAttached())
            return $this->sendOutOrOutAll($name, $data, $arrayPort);
        return false;
    }

    /**
     * shorthand usage of disconnecting out if it's attached
     * @param  string $name
     * @param  mixed  $data
     * @return bool
     */
    protected function disconnectIfAttached($name) {
        if ($this->outPorts[$name]->isAttached()) {
            $this->outPorts[$name]->disconnect();
            return true;
        }
        return false;
    }

    /**
     * @param  array      $names
     * @param  mixed      $data
     * @param  bool       $ifAttached
     * @param  int|bool   $arrayPort
     * @return bool
     */
    protected function sendOut($name, $data, $ifAttached = true, $arrayPort = true) {
        if ($ifAttached)
            return $this->sendIfAttached($name, $data, $arrayPort);
        if ($arrayPort)
            return $this->sendOutOrOutAll($name, $data, $arrayPort);

        $this->outPorts[$name]->send($data);
        return false;
    }

    /**
     * @param  array      $names
     * @param  mixed      $data
     * @param  bool       $ifAttached
     */
    protected function sendOutOrOutAll($name, $data, $arrayPort = true) {
        if ($arrayPort)
            if (method_exists($this->outPorts[$name], 'sendAll'))
                return $this->outPorts[$name]->sendAll($data);

        return $this->outPorts[$name]->send($data);
    }
}
