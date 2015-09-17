<?php

$content = "";
for ($i = 0; $i < 1000; $i++) {
    $content .= '<a href="https://packagist.org/login/github" class="pull-right btn btn-primary btn-github"><span class="icon-github"></span>Use Github</a>
    <style>.pull-right, .btn, .btn-primary, .btn-github, .icon-github {}</style>
    <style>.btn{}</style>
    <script>var githubButtons = document.getElementsByClassName("btn-github");</script>
    <script>githubIconButtons = $(".icon-github");</script>';
}

$start = microtime(true);
ob_start("ob_gzhandler");
echo $content;
ob_flush();
sleep(1);
echo microtime(true) - $start;
