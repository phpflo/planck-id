<?php

namespace PlanckId\Utilities;

use PlanckId\Flo\InvokableFloComponent;

class ReadExternalFile extends InvokableFloComponent {
    protected $fileName;
    protected $content;

    public function setFileName($fileName) {
        $this->fileName($fileName);
    }

    // could also pass in the $fileName to the __invoke 
    public function __invoke($fileName) {
        $this->content = file_get_contents($this->fileName);
    }
}


Could pass it into ReadExternalFile

Could call multiple ports to pass on the $content

So when it gets passed on where does it go?




1) WHERE DOES IT GO
2) WHERE DOES IT GET REPLACED? > CAN IT LOOP BACK ON ITSELF AND CALL THE INITIAL FLO WITH AN ARRAY IN PORT (NOT INITIAL, BUT THE ONE WHERE IT REPLACES?)?
3) WHERE DOES IT SAVE/OUTPUT? 
   A) DOES IT TRY TO REPLACE THE SAME FILE
   B) DOES IT CREATE A LOCAL COPY?
   C) ALL OF THE ABOVE, SEE IF IT CAN REPLACE - IF NOT, CREATE A LOCAL COPY - IF NOT, OUTPUT IN TEXT.