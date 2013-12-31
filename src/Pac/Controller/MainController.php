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
            $year = 2012;

            return $app['twig']->render('home.twig', array(
                'year'                 => $year,
                'biggestAmount'        => SubventionPeer::retrieveBiggestAmountByYear($year),
                'biggestGrowthAmount'  => SubventionPeer::retrieveBiggestGrowthAmountByYear($year),
                'biggestGrowthPercent' => SubventionPeer::retrieveBiggestGrowthPercentByYear($year),
            ));
        })
        ->bind('home');

        $controllers->match('/zipcode/{zipcode}', function (Request $request, Application $app, $zipcode) {
            if ($request->getMethod() == 'POST') {
                return $app->redirect($app['url_generator']->generate('by_zipcode', array('zipcode' => $request->request->get('zipcode'))));
            }

            $year = 2012;

            return $app['twig']->render('zipcode.twig', array(
                'year'           => $year,
                'zipcode'        => $zipcode,
                'subventionsSum' => SubventionPeer::retrieveAmountSumByYearAndZipcode($year, $zipcode, null),
                'subventions'    => SubventionPeer::retrieveAmountByYearAndZipcode($year, $zipcode, null),
            ));
        })
        ->value('zipcode', null)
        ->bind('by_zipcode');

        return $controllers;
    }
}
