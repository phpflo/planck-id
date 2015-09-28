<?php

// ... now let's try using multiple files for the input, and multiple files as the output
// intermediate - multiple files in - multiple files out
class Example3 extends AbstractExample {
    public function __invoke() {
        // advanced
        // here we use multiple types of files and define the type of file,
        // eventually the detection will be fully functional and this will be unessecary
        // either 'css', 'markup', or 'style' ([ ] later, add in css, js, html, php)
        $filesIn = ['markup.html' => 'markup', 'style.css' => 'style', 'script.js' => 'script'];
        $filesOut = ['markup.html', 'style.css', 'script.js'];

        // we have changed key from the previous example to the file in,
        $filePosition = 0;
        foreach ($filesIn as $fileIn => $contentType) {
            $content = $this->filesystem->read('files/original/'.$fileIn);
            // dump($contentType);
            // dump($fileIn);
            // dump($content);

            $fileOut = 'files/min/example3/'.$filesOut[$filePosition++];
            $planck = $this->planckFactory($name = $fileOut, $content, $fileOut, $contentType);

            // here we save the graph in json, to a json file
            $this->filesystem->put('files/graph/example-3-'.$fileIn.'-'.$contentType.'.json', (string) $planck->getGraph()->toJSON());
        }
    }

    /**
     * @param  string $name
     * @param  string $content
     * @param  string $outputFile
     * @param  string $contentType
     * @return Planck
     */
    public function planckFactory($name, $content, $outputFile, $contentType) {
        $planck = $this->planckFactory->create($name, $contentType);
        $planck->contentIn($content);
        $planck->setContentType($contentType);

        $planck->contentOut(function ($contents) use ($outputFile) {
            $this->filesystem->put($outputFile, $contents);
        });
        $planck->mapOut(function ($map) {
            $this->memoryFilesystem->put('map.json', json_encode($map));
        });

        // it will not be there the first time
        // subsequent times however, it will be
        if ($this->memoryFilesystem->has('map.json')) {
            $mapJson = $this->memoryFilesystem->read('map.json');
            $map = json_decode($mapJson, true);
            $planck->mapIn($map);
        }

        $this->networkFactory->createFromPlanck($planck);

        return $planck;
    }
}
