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

        $controllers->match('/zipcode/{zipcode}', function (Request $request, Application $app, $zipcode) {
            if ($request->getMethod() == 'POST') {
                return $app->redirect($app['url_generator']->generate('by_zipcode', array('zipcode' => $request->request->get('zipcode'))));
            }

            return $app['twig']->render('zipcode.twig', array(
                'zipcode'     => $zipcode,
                'subventionsSum' => SubventionPeer::retrieveAmountSumByYearAndZipcode(2012, $zipcode, null),
                'subventions' => SubventionPeer::retrieveAmountByYearAndZipcode(2012, $zipcode, null),
            ));
        })
        ->value('zipcode', null)
        ->bind('by_zipcode');

        return $controllers;
    }
}
