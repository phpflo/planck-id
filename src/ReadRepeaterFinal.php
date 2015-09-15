<?php

namespace PlanckId;

/**
 *  From the File Read sending it out to Content, Style, Markup
 */
class ReadRepeaterFinal extends ReadRepeater
{   
    public function repeat($content) {
        lineOut(__METHOD__);

        parent::repeat($content);

        $this->outPorts['final']->send($content);
        $this->outPorts['final']->disconnect();
    }
} 