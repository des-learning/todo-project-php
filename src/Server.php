<?php

// deklarasi namespace file harus disimpan di src/Server.php
// karena namespace Uph22si1Web\Todo disimpan pada directory src
// (baca di composer.json)
namespace Uph22si1Web\Todo;

// import menggunakan namespace
use Throwable;
use Uph22si1Web\Todo\Exceptions\NotFoundException;

// definisi class
class Server
{
  // property private
  private Router $router;

  // constructor
  function __construct(Router $router)
  {
    $this->router = $router;

    // register exception handler untuk menangani exception yang belum dihandle
    // tujuannya supaya aplikasi web memiliki default handler apabila ada code
    // yang lupa menghandle exception yang terjadi
    set_exception_handler(function(Throwable $exception) {
      // handle exception apabila resource yang direquest tidak ditemukan
      // kita dapat memanfaatkan sistem exception PHP untuk menghandle situasi khusus
      // seperti 404 not found, handler/controller cukup meng-throw exception NotFoundException
      if ($exception instanceof NotFoundException) {
        http_response_code(404);
        echo "Not Found";
        return;
      }

      // default handler exception handler
      http_response_code(500);
      echo "Internal Server Error";
    });
  }

  // serving http request
  // method ini membaca data request, dan mengirimkan request ke handler
  // yang terdaftar di router
  function serve(): void
  {
    $uri = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    // cari handler/controller untuk path yang di-request
    $handler = $this->router->getHandlerFor($uri, $method);
    if ($handler) {
      // handler ditemukan, karena handler adalah sebuah callable, kita
      // dapat memanggil variable $handler seperti memanggil fungsi
      $handler($_REQUEST);
      return;
    }

    // jika handler tidak ditemukan throw exception not found
    throw new NotFoundException();
  }
}
