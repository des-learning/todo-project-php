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
  private string $base;

  // constructor
  function __construct(string $base)
  {
    // operator -> digunakan untuk mengakses property/method dari class instance/variable/object
    $this->base = $base;

    // register exception handler untuk menangani exception yang belum dihandle
    // tujuannya supaya aplikasi web memiliki default handler apabila ada code
    // yang lupa menghandle exception yang terjadi
    set_exception_handler(function(Throwable $exception) {
      // handle exception apabila resource yang direquest tidak ditemukan
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
    $request_path = $this->normalized_request_path($_SERVER['REQUEST_URI']);
    $method = $_SERVER['REQUEST_METHOD'];

    $handler = Router::getHandlerFor($request_path, $method);
    if ($handler) {
      // handler ditemukan, karena handler adalah sebuah callable, kita
      // dapat memanggil variable $handler seperti memanggil fungsi
      $handler($_REQUEST);
      return;
    }

    // jika handler tidak ditemukan throw exception not found
    throw new NotFoundException();
  }

  private function normalized_request_path(string $uri): string
  {
    $request_path = strtok($uri, '?');

    if (substr($request_path, 0, strlen($this->base)) == $this->base) {
      $request_path = substr($request_path, strlen($this->base));
    }

    return $request_path;
  }
}
