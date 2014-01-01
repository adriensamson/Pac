<?php

use Silex\Provider\MonologServiceProvider;

$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/logs/pac.log',
));

$app['twig']->enableAutoReload();
$app['twig']->enableDebug();