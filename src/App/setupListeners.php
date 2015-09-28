<?php

$content = array();
Emitter::addListener('style.identities.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
Emitter::addListener('style.classes.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
Emitter::addListener('markup.classes.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
Emitter::addListener('markup.identities.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
Emitter::addListener('identities.replaced', function ($event, $param = null) use ($content) {
    $content[] = $param;
});

///
Emitter::addListener('inline.styles.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
Emitter::addListener('styles.blocks.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});

// debugging
Emitter::addListener('styles.blocks.extracted', function ($event, $param = null) use ($content) {
    $content[] = $param;
});
