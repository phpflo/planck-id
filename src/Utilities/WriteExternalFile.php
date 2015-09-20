<?php

namespace PlanckId\Utilities;

/**
 * could make one class that takes in a separate Content & separate FileName input
 * and one to take in an array
 */
class WriteExternalFile extends AbstractExternalFile {
    protected $ports = array(['out', 'out', []]);

    /**
     * using LocalFileAdapter
     * @param FlySystem $flysystem 
     */
    public function __construct(FlySystem $flysystem) {
        $this->flysystem = $flysystem;
    }




    public function setContent($content) {
        $this->content = $content;
    }

    public function __invoke($fileName) {
        $this->flysystem->write($fileName);

        $this->outPorts['out']->send();
        $this->outPorts['out']->disconnect();
    }   




    /**
     * @param array<string, string> $data fileNameAndContent
     * @return void
     */
    public function writeFrom($data) {
        $this->flysystem->write($data['fileName'], $data['content']);

        $this->outPorts['out']->send($data['fileName']);
        $this->outPorts['out']->disconnect();
    }
}
