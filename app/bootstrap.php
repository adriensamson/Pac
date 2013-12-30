<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\Yaml\Yaml;
use Propel\Silex\PropelServiceProvider;
use Pac\Lib\Config;

$app = new Application();

$app['config'] = $app->share(function() {
  return new Config(dirname(__DIR__));
});

$app->register(new PropelServiceProvider(), array(
  'propel.config_file' => $app['config']->get('config_dir').'/Propel/conf/Pac-conf.php',
  'propel.model_path'  => $app['config']->get('root_dir').'/src',
));

$app->register(new FormServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TwigServiceProvider(), array(
  'twig.path'           => $app['config']->get('root_dir').'/src/Pac/Views',
  'twig.options'        => array('cache' => $app['config']->get('root_dir').'/app/cache'),
  'twig.form.templates' => array('layout/_form.twig'),
));

$app['session']->start();

return $app;
