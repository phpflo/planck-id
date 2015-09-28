<?php

class AbstractExample {
    protected $filesystem;
    protected $memoryFilesystem;
    protected $planckFactory;
    protected $networkFactory;

    public function __construct($filesystem, $memoryFilesystem, $planckFactory, $networkFactory) {
        $this->filesystem = $filesystem;
        $this->memoryFilesystem = $memoryFilesystem;
        $this->planckFactory = $planckFactory;
        $this->networkFactory = $networkFactory;

        $this->__invoke();
    }
}