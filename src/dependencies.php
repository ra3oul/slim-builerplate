<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};


$container['model'] = function ($c)
{


};
//controller dependency injection resolver
$container['Tourism\http\controllers\HomeController']=function ($c)
{

  return new \Tourism\http\controllers\HomeController($c, new \Tourism\services\validation\FooValidator());
};


//Bootstrap Illuminate Config Service

$confLoader = new \Tourism\services\config\LoadConfiguration();
$confLoader->bootstrap($container);
