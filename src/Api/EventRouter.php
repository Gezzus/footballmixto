<?php

namespace App\Api;

use \App\Session as Session;
use \App\Database as Database;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class EventRouter implements Router {
  function loadRoutes(\Slim\App $app) {

    $app->get('/api/events', function (Request $request, Response $response) {
      $events = \App\Model\Game::getAllByStatus($request->getParam('status'), $request->getParam('amount'));
      return $response->withJson($events);
    });

    $app->get('/api/events/{id}', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['id']);
      return $response->withJson($event);
    });

    $app->post('/api/events', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::create($request->getParam('date') . ' ' . $request->getParam('time'), $request->getParam('typeId'), '');
      if($event) {
          return $response->withJson($event);
      }
      throw new \Exception("Cannot create event");
    });

    $app->put('/api/events/{eventId}', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['eventId']);
      if ($event) {
        $event->putStatus($request->getParam('status'));
      }
      return $response->withJson($event);
    });

    $app->delete('/api/events/{eventId}', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['eventId']);
      if ($event) {
        $event->delete();
      }
      return $response->withJson([]);
    });

    $app->post('/api/events/{eventId}/players', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['eventId']);
      $playerId = $request->getParam('id');
      if (!$playerId && $request->getParam('nickName') && $request->getParam('genderId')) {
        $player = \App\Model\Player::getByNickNameAndGenderId($request->getParam('nickName'), $request->getParam('genderId'), 3);
        if (!$player) {
          $player = \App\Model\Player::create($request->getParam('nickName'), $request->getParam('genderId'));
        }
        $playerId = $player->getId();
      }
      if ($playerId) {
        $event->addPlayer($playerId);
      }
      return $response->withJson($event);
    });

    $app->put('/api/events/{eventId}/players/{playerId}', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['eventId']);
      if ($event) {
        $team = $event->getTeam($request->getParam('teamId'));
        \App\Model\Team::transferPlayerWithId($args['playerId'], $request->getParam('teamId'), $args['eventId']);
      }
      return $response->withJson($event);
    });

    $app->delete('/api/events/{eventId}/players/{playerId}', function (Request $request, Response $response, $args) {
      $event = \App\Model\Game::getById($args['eventId']);
      $event->removePlayer($args['playerId']);
      return $response->withJson($event);
    });

  }
}
