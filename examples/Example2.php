<?php

// simple - multiple files
class Example2 extends AbstractExample {
    public function __invoke() {
        $filesIn = ['markup.html', 'markup2.html'];
        foreach ($filesIn as $file) {
            $content = $this->filesystem->read('files/original/'.$file);
            $this->planckFactory($content);
        }
    }

    /**
     * @param  string $content     
     * @return Planck              
     */
    public function planckFactory($content) {
        $planck = $this->planckFactory->create();        
        $planck->contentIn($content);
        $planck->contentOut(function ($contents) {
            dump($contents);
        });
        $planck->mapOut(function ($map) {
            $this->memoryFilesystem->put('map.json', json_encode($map));
        });        
        
        // we use map for the first time
        $map =   
            [
              "section-acebf433-a6ec-43f6-8166-55c8d129353a" => "a",
              "post-simple-media-adjacent-left-8-media" => "b",
              "media-adjacent" => "c",
              "post-simple" => "d",
              "left" => "e",
            ];
        $this->memoryFilesystem->put('map.json', json_encode($map));

        $mapJson = $this->memoryFilesystem->read('map.json');
        $map = json_decode($mapJson, true);
        // dump($map);

        $planck->mapIn($map);
        $this->networkFactory->createFromPlanck($planck);
    }
}
