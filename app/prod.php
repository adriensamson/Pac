<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->after(function (Request $request, Response $response) {
    // Cache minimal de 2 minutes si non précisé dans le controller
    if ($response->headers->get('Cache-Control') == 'no-cache') {
        $response->headers->set('Cache-Control', 's-maxage=120, public');
    }
});