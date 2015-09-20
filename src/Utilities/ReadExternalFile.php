<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class ReadExternalFile extends InvokableFloComponent {
    protected $ports = array(['in', 'in', []], 'out', ['out', 'filename']);

    public function __invoke($fileName) {
        $this->fileContentOut($fileName);
        $this->fileNameOut($fileName);
    }

    public function fileContentOut($fileName) {
        if (!file_exists($fileName)) 
            return $this->outPorts['error']->send("File {$fileName} doesn't exist");

        $this->sendThenDisconnect('filename', file_get_contents($fileName), false);
    }

    public function fileNameOut($fileName) {
        $this->sendThenDisconnect('filename', $fileName);
    }
}
