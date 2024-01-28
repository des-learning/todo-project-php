<?php

namespace Uph22si1Web\Todo;

class Router
{
  private static array $getHandlers = [];
  private static array $postHandlers = [];

  /**
    * @return void
    * @param callable(): mixed $handler
    */
  static function get(string $path, callable $handler): void
  {
    self::$getHandlers[$path] = $handler;
  }

  /**
    * @return void
    * @param callable(): mixed $handler
    */
  static function post(string $path, callable $handler): void
  {
    self::$postHandlers[$path] = $handler;
  }

  static function getHandlerFor(string $path, string $method): ?callable
  {
    if ($method === 'GET') {
      return self::$getHandlers[$path] ?? null;
    }

    if ($method === 'POST') {
      return self::$postHandlers[$path] ?? null;
    }

    return null;
  }
}
