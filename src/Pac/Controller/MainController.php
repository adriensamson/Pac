<?php

namespace Pac\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

use Pac\Model\Purchase,
    Pac\Model\PurchasePeer;

class MainController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request, Application $app) {
            return $app['twig']->render('home.twig', array());
        })
        ->bind('home');

        return $controllers;
    }
}
