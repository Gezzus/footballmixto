<?php

namespace App\Api;

use \App\Session as Session;
use \App\Database as Database;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AdminRouter implements Router {
  function loadRoutes(\Slim\App $app) {

    $app->post('/api/admins/queries', function (Request $request, Response $response) {
      $user = \App\Session::getInstance()->getLoggedUser()->getUserName();
      if ($user === 'Alessandro' || $user === 'pablo.angelani') {
        return $response->withJson(["status" => "success", "message" => \App\Model\Admin::runQuery($request->getParam('context'))]);
      }
      throw new \Exception("Missing user, please sign in again", 1);
    });

  }
}
