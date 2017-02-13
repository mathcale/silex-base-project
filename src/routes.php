<?php

use Symfony\Component\HttpFoundation\Request;
use App\Controllers\AuthController;
use App\Controllers\AdminController;

$app->error(function(\Exception $e, Request $request, $code) use($app) {
    if(getenv('APP_DEBUG') == 'true') {
        return $app['twig']->render('errors/common.html.twig', array(
            'message' => $e->getMessage()
        ));
    } else {
        switch($code) {
            case 403:
                return $app['twig']->render('errors/auth.html.twig', array(
                    'message' => 'Not authorized! Please, log in or register.'
                ));

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
    }
});

$app->mount('/', new AuthController());
$app->mount('/admin', new AdminController());