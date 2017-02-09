<?php

namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];
        
        $factory->get('/', 'App\Controllers\AuthController::index')->bind('home-auth');
        
        $factory->get('/login', 'App\Controllers\AuthController::login')->bind('login');
        $factory->post('/login', 'App\Controllers\AuthController::doLogin')->bind('do-login');
        
        $factory->get('/register', 'App\Controllers\AuthController::register')->bind('register');
        $factory->post('/register', 'App\Controllers\AuthController::doRegister')->bind('do-register');
        
        $factory->get('/logout', 'App\Controllers\AuthController::logout')->bind('logout');
        
        return $factory;
    }
    
    public function index(Application $app)
    {
        return $app->redirect($app['url_generator']->generate('login'));
    }
    
    public function login(Application $app)
    {
        return $app['twig']->render('auth/login.html.twig', array(
            'hasFlashMessage' => false,
            'msgClass' => null,
            'message' => null
        ));
    }
    
    public function doLogin(Application $app, Request $request)
    {
        $db = $app['dbs']['main'];
        $data = $request->request->all();
        $passwd = substr(md5($data['password']), 0, 15);
        
        $sql = 'SELECT name FROM users WHERE email = ? AND password = ?';
        $result = $db->fetchAssoc($sql, [$data['email'], $passwd]);

        if($result) {
            $app['session']->set('user', array('name' => $result['name']));
            
            return $app->redirect($app['url_generator']->generate('home'));
        } else {
            return $app['twig']->render('auth/login.html.twig', array(
                'hasFlashMessage' => true,
                'msgClass' => 'warning',
                'message' => 'Invalid email or password!'
            ));
        }
    }
    
    public function register(Application $app)
    {
        return $app['twig']->render('auth/register.html.twig', array(
            'hasFlashMessage' => false,
            'msgClass' => null,
            'message' => null
        ));
    }
    
    public function doRegister(Application $app, Request $request)
    {
        $db = $app['dbs']['main'];
        $data = $request->request->all();
        
        $sql = 'SELECT * FROM users WHERE email = ?';
        $user = $db->fetchAssoc($sql, [$data['email']]);
        
        if($user) {
            return $app['twig']->render('auth/register.html.twig', array(
                'hasFlashMessage' => true,
                'msgClass' => 'warning',
                'message' => 'Email alreary in use!'
            ));
        }
        
        $result = $db->insert('users', array(
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => substr(md5($data['password']), 0, 15)
        ));
        
        if($result) {
            return $app['twig']->render('auth/login.html.twig', array(
                'hasFlashMessage' => true,
                'msgClass' => 'success',
                'message' => 'Login credentials created successfully! Use them above to access the app.'
            ));
        } else {
            return $app['twig']->render('auth/register.html.twig', array(
                'hasFlashMessage' => true,
                'msgClass' => 'danger',
                'message' => 'There was an error while creating your credentials! Please try again later.'
            ));
        }
    }
    
    public function logout(Application $app)
    {
        $app['session']->remove('user');
        
        return $app->redirect($app['url_generator']->generate('login'));
    }

}