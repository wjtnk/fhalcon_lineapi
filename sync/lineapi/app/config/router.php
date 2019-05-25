<?php

//$router = $di->getRouter();
//
//// Define your routes here
//
//$router->handle();


use Phalcon\Mvc\Router;
// Create the router
$router = new Router();

$router->add(
    '/hoge',
    [
        'controller' => 'post',
        'action'     => 'new',
    ]
);


$router->handle();


