<?php

namespace App\Api;

interface Router {
  function loadRoutes(\Slim\App $app);
}
