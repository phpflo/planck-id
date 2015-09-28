<?php

use PlanckId\App\Planck;

/**
 * Here we want to use multiple 
 */
class Example4 extends AbstractExample {
    public function __invoke() {
        $filesIn = ['markup.html' => ['markup', Planck::EXTRACT_AND_REPLACE], 'style.css' => ['style', Planck::REPLACE], 'script.js' => ['script', Planck::REPLACE]];
        $filesOut = ['markup.html', 'style.css', 'script.js'];

        // we have changed key from the previous example to the file in
        $filePosition = 0;
        foreach ($filesIn as $fileIn => $contentTypeAndMethod) {
            $content = $this->filesystem->read('files/original/'.$fileIn);

            // 0 is contentType
            // 1 is method
            $fileOut = 'files/min/example4/'.$filesOut[$filePosition++];
            $planck = $this->planckFactory($name = $fileOut, $content, $fileOut, $contentTypeAndMethod[0], $contentTypeAndMethod[1]);

            // here we save the graph in json, to a json file
            $this->filesystem->put('files/graph/example-4-'.$fileIn.'-'.$contentTypeAndMethod[0].'.json', (string) $planck->getGraph()->toJSON());
        }
    }

    /**
     * @param  string $name
     * @param  string $content
     * @param  string $outputFile
     * @param  string $contentType
     * @param  string $method
     * @return Planck
     */
    public function planckFactory($name, $content, $outputFile, $contentType, $method) {
        $planck = $this->planckFactory->create($name, $contentType, $method);
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