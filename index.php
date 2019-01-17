<?php
use \App\Session as Session;
use \App\Database as Database;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

Session::getInstance();
Database::getInstance();

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['debug'] = true;

$app = new \Slim\App(array('settings' => $config));

$container = $app->getContainer();

$container['db'] = function() {
  return Database::getInstance()->getConn();
};

$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $response->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->withJson(['status' => 'failed', 'message' => $exception->getMessage()]);
    };
};

$app->add(function (Request $request, Response $response, $next) {
  $path = $request->getUri()->getPath();
  if (substr($path, 0, 4) === 'api/' && $path !== 'api/login' && !Session::getInstance()->hasLoggedInUser()) {
    return $response->withStatus(401)
        ->withHeader('Content-Type', 'application/json')
        ->withJson(['status' => 'failed', 'message' => 'Unauthorized']);
  }
  return $next($request, $response);
});

// Single Page App
$app->get('/', function (Request $request, Response $response) {
  return $response->withRedirect(Session::getInstance()->hasLoggedInUser() ? '/web/index.html' : '/web/login.html');
});

$app->get('/api/logout', function (Request $request, Response $response) {
  Session::getInstance()->destroy();
  return $response->withRedirect('/');
});

// API Authentication
(new \App\Api\AuthenticationRouter())->loadRoutes($app);
(new \App\Api\UserRouter())->loadRoutes($app);
(new \App\Api\EventRouter())->loadRoutes($app);
(new \App\Api\AdminRouter())->loadRoutes($app);

// API User

$app->run();
