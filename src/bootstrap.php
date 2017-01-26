<?php

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

// Services registration
$app->register(new TwigServiceProvider());
$app->register(new RoutingServiceProvider());
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
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'dbhost'   => '',
        'dbname'   => '',
        'user'     => '',
        'password' => '',
    ),
));

// Application's configs
$app['debug'] = true;
$app['twig'] = $app->extend('twig', function($twig, $app) {
    return $twig;
});
$app['twig.path'] = array('templates');

return $app;