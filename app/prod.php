<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => $app['config']->get('root_dir').'/app/cache',
    'http_cache.esi'       => null,
));

$app->after(function (Request $request, Response $response) {
    // Cache minimal de 2 minutes si non précisé dans le controller
    if ($request->getMethod() == 'GET' && $response->headers->get('Cache-Control') == 'no-cache') {
        $response->headers->set('Cache-Control', 's-maxage=120, public');
    }
});