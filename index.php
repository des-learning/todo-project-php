<?php

require __DIR__ . '/vendor/autoload.php';

use Uph22si1Web\Todo\Router;
use Uph22si1Web\Todo\Server;

$server = new Server('/todo');

Router::get('/', function(array $request) {
  $nama = $request['nama'] ?? 'World';
  echo "Hello $nama";
});

$server->serve();
