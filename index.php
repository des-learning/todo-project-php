<?php

// Lakukan autoload  PSR-4
require __DIR__ . '/vendor/autoload.php';

// mengimport class dari namespace
use Uph22si1Web\Todo\Router;
use Uph22si1Web\Todo\Server;

// buat instance router baru, mount ke path '/todo'
$router = new Router('/todo');

// buat instance server baru untuk menghandle request http
// baca source-nya di src/Server.php
// inject instance $router ke server
$server = new Server($router);

// daftarkan sebuah router untuk menghandle request
// baca source-nya di src/Router.php
// parameter kedua Router::get adalah sebuah anonymous function
// (https://www.php.net/manual/en/functions.anonymous.php)
// yang akan dipanggil ketika ada request get ke `/`
//
// PHP mengdukung dua cara penulisan callable:
// 1. anonymous function/closure https://www.php.net/manual/en/functions.anonymous.php
// 2. arrow function https://www.php.net/manual/en/functions.arrow.php
$router->get('/', function(array $request) {
  $nama = $request['nama'] ?? 'World';
  echo "Hello $nama";
});

// jalankan logic untuk menerima request dan memanggil handler
// yang tepat sesuai router di-atas
$server->serve();
