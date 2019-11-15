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

$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('web/');
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
  return $response->withRedirect(Session::getInstance()->hasLoggedInUser() ? '/web/home' : '/web/login');
});

$app->get('/web/login', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $response->withRedirect('/web/home')
    : $this->view->render($response, 'login.html', []);
});

$app->get('/web/register', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $response->withRedirect('/web/home')
    : $this->view->render($response, 'register.html', []);
});

$app->get('/web/home', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $this->view->render($response, 'index.html', [])
    : $response->withRedirect('/web/login');
});

$app->get('/web/event', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $this->view->render($response, 'game.html', [])
    : $response->withRedirect('/web/login');
});

$app->get('/web/events', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $this->view->render($response, 'events.html', [])
    : $response->withRedirect('/web/login');
});

$app->get('/web/admin', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $this->view->render($response, 'admin.html', [])
    : $response->withRedirect('/web/login');
});

$app->get('/web/profile', function (Request $request, Response $response) {
  return Session::getInstance()->hasLoggedInUser()
    ? $response->withRedirect(Session::getInstance()->hasLoggedInUser() ? '/web/index.html' : '/web/login.html')
    : $response->withRedirect('/web/login');
});

$app->get('/api/logout', function (Request $request, Response $response) {
  Session::getInstance()->destroy();
  return $response->withRedirect('/');
});

// API Authentication
(new \App\Api\AuthenticationRouter())->loadRoutes($app);
(new \App\Api\PlayerRouter())->loadRoutes($app);
(new \App\Api\UserRouter())->loadRoutes($app);
(new \App\Api\EventRouter())->loadRoutes($app);
(new \App\Api\AdminRouter())->loadRoutes($app);

// API User

$app->run();
