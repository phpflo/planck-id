<?php

namespace PlanckId\Flo;

use PhpFlo\SocketInterface;

/**
 * adding features from ExtendedFloNetwork
 * adding sendAll()
 */
class ExtendedFloArrayPort extends ExtendedFloPort
{
    private $sockets = array();

    public function attach(SocketInterface $socket)
    {
        $this->sockets[] = $socket;
        $this->attachSocket($socket);
    }

    public function detach(SocketInterface $socket)
    {
        $index = array_search($socket, $this->sockets);
        if ($index === false) {
            return;
        }

        $this->emit('detach', array($socket));
        $this->sockets = array_splice($this->sockets, $index, 1);
    }

    public function sendAll($data)
    {
        foreach (array_keys($this->sockets) as $socketId) 
            $this->send($data, $socketId);
    }

    public function send($data, $socketId = 0)
    {
        if (!isset($this->sockets[$socketId])) {
            throw new \InvalidArgumentException("No socket {$socketId} connected");
        }

        if ($this->isConnected($socketId)) {
            return $this->sockets[$socketId]->send($data);
        }

        $this->sockets[$socketId]->once('connect', function(SocketInterface $socket) use ($data) {
            $socket->send($data);
        });
        $this->sockets[$socketId]->connect();
    }

    public function connect($socketId = 0)
    {
        if (!isset($this->sockets[$socketId])) {
            throw new \InvalidArgumentException("No socket {$socketId} connected");
        }

        $this->sockets[$socketId]->connect();
    }

    public function disconnect($socketId = 0)
    {
        if (!isset($this->sockets[$socketId])) {
            return;
        }

        $this->sockets[$socketId]->disconnect();
    }

    public function isAttached()
    {
        if (!empty($this->sockets)) {
            return true;
        }
        return false;
    }
    public function isSocketWithIdAttached($socketId = 0)
    {
        if (isset($this->sockets[$socketId])) {
            return true;
        }
        return false;
    }

    public function isConnected($socketId = 0)
    {
        if (!isset($this->sockets[$socketId])) {
            return false;
        }

        return $this->sockets[$socketId]->isConnected();
    }
}
