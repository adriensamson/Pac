<?php

namespace Pac\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;


use Pac\Model\SubventionPeer;

class MainController implements ControllerProviderInterface
{
    const CACHE_MAXAGE_HOME             = 300; // 5 minutes
    const CACHE_MAXAGE_ZIPCODE          = 3600; // 1 heure
    const CACHE_MAXAGE_ZIPCODE_REDIRECT = 86400; // 1 jour

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request, Application $app) {
            $year = 2012;

            $content = $app['twig']->render('home.twig', array(
                'year'                 => $year,
                'biggestAmount'        => SubventionPeer::retrieveBiggestAmountByYear($year),
                'biggestGrowthAmount'  => SubventionPeer::retrieveBiggestGrowthAmountByYear($year),
                'biggestGrowthPercent' => SubventionPeer::retrieveBiggestGrowthPercentByYear($year),
            ));

            return new Response($content, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', self::CACHE_MAXAGE_HOME)));
        })
        ->bind('home');

        $controllers->match('/zipcode/{zipcode}', function (Request $request, Application $app, $zipcode) {
            if ($request->query->get('zipcode')) {
                $url = $app['url_generator']->generate('by_zipcode', array('zipcode' => $request->query->get('zipcode')));

                return new RedirectResponse($url, 302, array('Cache-Control' => sprintf('s-maxage=%s, public', self::CACHE_MAXAGE_ZIPCODE_REDIRECT)));
            }

            $year = 2012;

            $content = $app['twig']->render('zipcode.twig', array(
                'year'           => $year,
                'zipcode'        => $zipcode,
                'subventionsSum' => SubventionPeer::retrieveAmountSumByYearAndZipcode($year, $zipcode, null),
                'subventions'    => SubventionPeer::retrieveAmountByYearAndZipcode($year, $zipcode, null),
            ));

            return new Response($content, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', self::CACHE_MAXAGE_ZIPCODE)));
        })
        ->value('zipcode', null)
        ->bind('by_zipcode');

        return $controllers;
    }
}
