<?php

$content = "";
for ($i = 0; $i < 1000; $i++) {
    $content .= '<a href="https://packagist.org/login/github" class="c e a d"><span class="b"></span>Use Github</a> 
    <style>.c, .e, .a, .d, .b {}</style>
    <style>.e{}</style> 
    <script>var githubButtons = document.getElementsByClassName("d");</script>
    <script>githubIconButtons = $(".b");</script>';
}

$start = microtime(true);
echo $content;
sleep(1);
echo microtime(true) - $start;
