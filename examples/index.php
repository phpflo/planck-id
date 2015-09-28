<?php

require_once __DIR__.'/../bootstrap.php';

require_once 'AbstractExample.php';
require_once 'Example0.php';
require_once 'Example1.php';
require_once 'Example2.php';
require_once 'Example3.php';
require_once 'Example4.php';

use PlanckId\App\NetworkFactory;
use PlanckId\App\PlanckFactory;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Memory\MemoryAdapter;

$networkFactory = new NetworkFactory();
$planckFactory = new PlanckFactory();
$adapter = new Local(__DIR__.'');
$filesystem = new Filesystem($adapter);
$memoryFilesystem = new Filesystem(new MemoryAdapter());

echo("example1");
$example1 = new Example1($filesystem, $memoryFilesystem, $planckFactory, $networkFactory);

echo("example2");
$example2 = new Example2($filesystem, $memoryFilesystem, $planckFactory, $networkFactory);

echo("example3");
$example3 = new Example3($filesystem, $memoryFilesystem, $planckFactory, $networkFactory);

echo("example4");
$example3 = new Example4($filesystem, $memoryFilesystem, $planckFactory, $networkFactory);
