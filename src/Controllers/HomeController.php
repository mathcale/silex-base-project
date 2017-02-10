<?php

namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class HomeController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];
        
        $factory->get('/', 'App\Controllers\HomeController::index')->bind('home');
        
        return $factory;
    }
    
    public function index(Application $app)
    {
        if(is_null($app['get_session']) || empty($app['getSession'])) {
            return $app->redirect($app['url_generator']->generate('login'));
        } else {
            return $app['twig']->render('home/index.html.twig', array());
        }
    }

}