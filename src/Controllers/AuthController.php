<?php

namespace App\Controllers;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AuthController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];

        $factory->get('/', 'App\Controllers\AuthController::index')->bind('auth');
        $factory->get('/login', 'App\Controllers\AuthController::login')->bind('login');

        return $factory;
    }

    public function index(Application $app)
    {
        return $app->redirect($app['url_generator']->generate('login'));
    }

    public function login(Application $app, Request $request)
    {
        return $app['twig']->render('auth/login.html.twig', array(
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ));
    }
}