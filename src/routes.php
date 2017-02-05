<?php

use Symfony\Component\HttpFoundation\Request;
use App\Controllers\HomeController;

$app->error(function(\Exception $e, Request $request, $code) use($app) {
    switch($code) {
        case 404:
            return $app['twig']->render('errors/common.html.twig', array(
                'message' => 'Page Not Found'
            ));

        case 500:
            return $app['twig']->render('errors/common.html.twig', array(
                'message' => 'Service Temporary Unavailable'
            ));

        default:
            return $app['twig']->render('errors/common.html.twig', array(
                'message' => $e->getMessage()
            ));
    }
});

$app->mount('/', new HomeController());