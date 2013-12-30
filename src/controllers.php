<?php

use Symfony\Component\HttpFoundation\Response;

$app->error(function (\Exception $exception, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    $content = $app['twig']->render('errors/'.$page, array(
      'code'      => $code,
      'exception' => $exception,
    ));

    return new Response($content, $code);
});

$app->mount('/', new \Pac\Controller\MainController());
