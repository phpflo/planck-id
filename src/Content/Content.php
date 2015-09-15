<?php

namespace PlanckId\Content;

use PlanckId\Flo\InvokableFloComponent;

class Content {
    public $content;
    public function __construct($content) {
        $this->content = (string) $content;
    }
    public function append($content) {
        $this->content .= $content;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    public function __toString() {
        return (string) $this->content;
    }
}