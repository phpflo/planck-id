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
ob_start("ob_gzhandler");
echo $content;
ob_flush();
sleep(1);
echo microtime(true) - $start;
