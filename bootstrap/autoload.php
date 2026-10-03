<?php

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../vendor/autoload.php';

$basePath = dirname(__DIR__);
$loader->setPsr4('App\\', [$basePath . '/app']);
$loader->setPsr4('Database\\Factories\\', [$basePath . '/database/factories']);
$loader->setPsr4('Database\\Seeders\\', [$basePath . '/database/seeders']);
$loader->setPsr4('Tests\\', [$basePath . '/tests']);

$classMap = $loader->getClassMap();
foreach ($classMap as $class => $path) {
    if (str_starts_with($class, 'App\\') || str_starts_with($class, 'Tests\\') || str_starts_with($class, 'Database\\')) {
        unset($classMap[$class]);
    }
}
$loader->addClassMap($classMap);

return $loader;
