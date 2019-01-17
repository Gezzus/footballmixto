<?php

namespace App\Api;

use \App\Session as Session;
use \App\Database as Database;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthenticationRouter implements Router {
  function loadRoutes(\Slim\App $app) {

    $app->post('/api/login', function (Request $request, Response $response) {
      $user = \App\Model\User::getUser($request->getParam('userName'), $request->getParam('password'));
      if ($user) {
        Session::getInstance()->logIn($user->getId());
        return $response->withJson(['status' => 'success']);
      }
      throw new \Exception('The credentials provided are incorrect.');
    });

    $app->post('/api/signup', function (Request $request, Response $response) {
      $user = \App\Model\User::create(
        $request->getParam('userName'),
        $request->getParam('password'),
        $request->getParam('nickName'),
        $request->getParam('genderId'),
        $request->getParam('skillId')
      );
      if ($user && $user->getId()) {
        Session::getInstance()->logIn($user->getId());
        return $response->withJson([
          "username" => $user->getUserName(),
          "roleId" => $user->getRoleId(),
          "playerId" => $user->getPlayerId()
        ]);
      }
      throw new \Exception();
    });

  }
}
