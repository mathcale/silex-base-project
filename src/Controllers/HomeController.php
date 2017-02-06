<?php

namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class HomeController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $session = $app['session']->get('user');
    
        if(is_null($session) || empty($session)) {
            // Should redirect to login, but nothing happens
            $app->redirect('/login');
        }
        
        $factory = $app['controllers_factory'];
        
        $factory->get('/', 'App\Controllers\HomeController::index')->bind('home');
        
        return $factory;
    }
    
    public function index(Application $app)
    {
        return $app['twig']->render('home/index.html.twig', array());
    }

}