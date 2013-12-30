<?php

use Silex\Provider\MonologServiceProvider;
use FF\ServiceProvider\LessServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/logs/pac.log',
));

$app['twig']->enableAutoReload();
$app['twig']->enableDebug();
