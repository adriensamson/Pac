<?php

namespace Pac\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

use Pac\Model\SubventionPeer;

class MainController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request, Application $app) {
            return $app['twig']->render('home.twig', array(
                'biggestAmount' => SubventionPeer::retrieveBiggestAmountByYear(2012),
            ));
        })
        ->bind('home');

        return $controllers;
    }
}
