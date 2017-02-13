<?php

namespace App\Controllers;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class AdminController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];

        $factory->get('/', 'App\Controllers\AdminController::index')->bind('home');

        return $factory;
    }

    public function index(Application $app)
    {
        return $app['twig']->render('home/index.html.twig', array());
    }
}