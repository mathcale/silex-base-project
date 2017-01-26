<?php

namespace MyApp\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class HomeController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];
        
        $factory->get('/', 'MyApp\Controllers\HomeController::index')->bind('home');
        
        return $factory;
    }
    
    public function index(Application $app)
    {
        return $app['twig']->render('home/index.html.twig', array());
    }

}