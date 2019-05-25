<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Session\Adapter\Files as Session;

use Phalcon\Mvc\Router;


// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

//デバッグするのに必要(debugコンポーネントを使用する際には最後のtry-chachを無効にする必要がある)
$debug = new \Phalcon\Debug();
$debug->listen();


// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/forms/',
        APP_PATH . '/plugins/',
        BASE_PATH . '/cache/',
    ]
);

$loader->register();

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

// Setup a base URI
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);

// Setup the database service
$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'host'     => '192.168.10.10',
                'username' => 'root',
                'password' => '',
                'dbname'   => 'tutorial1',
            ]
        );
    }
);

$di->set(
    'session',
    function () {
        $session = new Session();
        $session->start();
        return $session;
    }
);

$di->set(
    'dispatcher',
    function () {
      $eventsManager = new EventsManager();
      // Listen for events produced in the dispatcher using the Security plugin
      $eventsManager->attach(
          'dispatch:beforeExecuteRoute',
          new SecurityPlugin()
      );
      // Handle exceptions and not-found exceptions using NotFoundPlugin
      $eventsManager->attach(
          'dispatch:beforeException',
          new NotFoundPlugin()
      );
      $dispatcher = new Dispatcher();
      $dispatcher->setEventsManager($eventsManager);
      return $dispatcher;

    }
);



$di->set('router', function(){
    require APP_PATH.'/config/router.php';
    return $router;
});


$application = new Application($di);

// Handle the request
$response = $application->handle();
$response->send();


//debugコンポーネントを使用する際にはtry-chachを無効にする必要がある
// try {
//     // Handle the request
//     $response = $application->handle();
//     $response->send();
// } catch (\Exception $e) {
//     // echo 'Exception: ', $e->getMessage();
//     echo get_class($e), ': ', $e->getMessage(), '\n';
//     echo ' File=', $e->getFile(), '\n';
//     echo ' Line=', $e->getLine(), '\n';
//     echo $e->getTraceAsString();
// }
