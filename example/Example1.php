<?php

/**
 * Here we are working with just inputing a single file, then displaying the contents
 */
class Example1 extends AbstractExample {
    public function __invoke() {
        // get the contents of the file
        $content = $this->filesystem->read('files/original/markup.html');
        $planck = $this->planckFactory->create();        
        $planck->contentIn($content);
        $planck->contentOut(function ($contents) {
            echo "CONTENT_OUT"; // echo "<pre>"; var_dump($contents); echo "</pre>"; 
            dump($contents); 
        });
        $planck->mapOut(function ($map) {
            echo "MAP_OUT";
            dump($map);
        });
        $network = $this->networkFactory->createFromPlanck($planck);
    }
}