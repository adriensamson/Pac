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
        ->bind('home')
        ;

        $controllers->match('/about', function (Request $request, Application $app) {
            return $app['twig']->render('about.twig', array());
        })
        ->bind('about')
        ;

        $controllers->match('/contact', function (Request $request, Application $app) {
            return $app['twig']->render('contact.twig', array());
        })
        ->bind('contact')
        ;

        $controllers->match('/products/yatse', function (Request $request, Application $app) {
            return $app['twig']->render('yatse.twig', array());
        })
        ->bind('yatse')
        ;

        $controllers->match('/products/yatse/success', function (Request $request, Application $app) {
            // $purchase = new Purchase();
            // $purchase
            //     ->setProjectId(1) // id en dur pour éviter une requête supplémentaire
            //     ->setStatus('done')
            //     ->setAmount(3.99)
            //     // ...
            //     ->save()
            // ;

            //$app['session']->setFlash('success', 'Your order has been passed successfully. You\'ll receive an email with unlocker soon.' );
            $app['session']->getFlashBag()->add(
              'success',
                array(
                    'title'   => 'Thanks !',
                    'message' => 'Your order has been passed successfully. You\'ll receive an email with unlocker soon.',
                     )
            );
            $url = $app['url_generator']->generate('yatse');

            return $app->redirect($url);
        })
        ->bind('yatse_success')
        ;

        $controllers->match('/products/yatse/cancel', function (Request $request, Application $app) {
            $app['session']->getFlashBag()->add(
              'info',
                array(
                    'title'   => 'Canceled !',
                    'message' => 'Your order has been canceled. Don\'t hesitate to come back soon :)',
                     )
            );
            $url = $app['url_generator']->generate('yatse');

            return $app->redirect($url);
        })
        ->bind('yatse_cancel')
        ;

        $controllers->match('/products/yatse/error', function (Request $request, Application $app) {
            $app['session']->getFlashBag()->add(
              'danger',
                array(
                    'title'   => 'Oops !',
                    'message' => 'An error occurred during your order processing. Please check your data and try again later. If the error persists, feel free to contact us.',
                     )
            );
            $url = $app['url_generator']->generate('yatse');

            return $app->redirect($url);
        })
        ->bind('yatse_error')
        ;

        $controllers->post('/products/validate-email', function (Request $request, Application $app) {
            $email    = $request->request->get('email');
            $purchase = PurchasePeer::retrieveByUserEmail($email);

            return json_encode(array('status' => $purchase ? true : false));
        })
        ->bind('validate_email');


        $controllers->match('/products/galaxsim-unlock', function (Request $request, Application $app) {
            return $app['twig']->render('gsu.twig', array());
        })
        ->bind('gsu')
        ;

        $controllers->match('/products/payment-troubleshooting', function (Request $request, Application $app) {
            return $app['twig']->render('payment-troubleshoot.twig', array());
        })
        ->bind('payment_troubleshoot')
        ;

        $controllers->match('/privacy-policy', function (Request $request, Application $app) {
            return $app['twig']->render('privacy-policy.twig', array());
        })
        ->bind('privacy_policy')
        ;

        return $controllers;
    }
}
