<?php

namespace Uph22si1Web\Todo;

use Throwable;
use Uph22si1Web\Todo\Exceptions\NotFoundException;

class Server
{
  private string $base;

  function __construct(string $base)
  {
    $this->base = $base;

    set_exception_handler(function(Throwable $exception) {
      if ($exception instanceof NotFoundException) {
        http_response_code(404);
        echo "Not Found";
        return;
      }

      http_response_code(500);
      echo $exception->getMessage();
      echo "Internal Server Error";
    });
  }

  function serve(): void
  {
    $request_path = $this->normalized_request_path($_SERVER['REQUEST_URI']);
    $method = $_SERVER['REQUEST_METHOD'];

    $handler = Router::getHandlerFor($request_path, $method);
    if ($handler) {
      $handler($_REQUEST);
      return;
    }

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
