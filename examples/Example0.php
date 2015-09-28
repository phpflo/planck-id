<?php

/**
 * Here we are working with just inputing an input string content, then displaying the contents
 */
class Example0 extends AbstractExample {
    public function __invoke() {
        // get the contents of the file
        $content = '<section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else">
        @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}<style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {} </style>
        <script>var test = document.getElementById("post-simple-media-adjacent-left-8-media"); var test2 = document.getElementById("post-simple-media-adjacent-left"); </script>';

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