<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use App\Provider\UserProvider;

$app = new Silex\Application();

// Services registration
$app->register(new TwigServiceProvider());
$app->register(new RoutingServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new AssetServiceProvider(), array(
    'assets.version' => 'v1',
    'assets.version_format' => '%s?version=%s',
    'assets.named_packages' => array(
        'css' => array(
            'version' => 'css2',
            'base_path' => '/templates/assets/css'
        ),
        'js' => array(
            'base_path' => '/templates/assets/js'
        ),
        'images' => array(
            'base_path' => '/templates/assets/images'
        )
    ),
));
$app->register(new DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'main' => array(
            'driver'   => getenv('DB_DRIVER'),
            'host'     => getenv('DB_HOST'),
            'dbname'   => getenv('DB_NAME'),
            'user'     => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
        ),
        'console' => array(
            'driver'   => getenv('DB_DRIVER'),
            'host'     => getenv('DB_HOST'),
            'user'     => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
        )
    ),
));
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin' => array(
            'pattern' => '^/admin/',
            'form' => array(
                'login_path' => '/login',
                'check_path' => '/admin/login_check'
            ),
            'logout' => array(
                'logout_path' => '/admin/logout',
                'invalidate_session' => true
            ),
            'users' => function() use($app) {
                return new UserProvider($app['dbs']['main']);
            }
        )
    )
));

// General configs
$app['debug'] = getenv('APP_DEBUG');
$app['twig'] = $app->extend('twig', function($twig, $app) {
    return $twig;
});
$app['twig.path'] = array('templates');

return $app;