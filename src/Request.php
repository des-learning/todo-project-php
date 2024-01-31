<?php

namespace Uph22si1Web\Todo;

class Request {
  private array $allRequestVariables;
  private array $queryRequestVariables;
  private array $cookieRequestVariables;

  /**
    * @param array<int,mixed> $allRequestVariables
    * @param array<int,mixed> $queryRequestVariables
    * @param array<int,mixed> $cookieRequestVariables
    */
  function __construct(array $allRequestVariables, array $queryRequestVariables, array $cookieRequestVariables) {
    $this->allRequestVariables = $allRequestVariables ?? [];
    $this->queryRequestVariables = $queryRequestVariables ?? [];
    $this->cookieRequestVariables = $cookieRequestVariables ?? [];
  }

  public function input(?string $key): mixed {
    if (!key) {
      return $this->allRequestVariables;
    }

    return $this->allRequestVariables[$key] ?? null;
  }

  public function query(?string $key): mixed {
    if (!$key) {
      return $this->queryRequestVariables;
    }

    return $this->queryRequestVariables[$key] ?? null;
  }

  public function cookie(?string $key): mixed {
    if (!$key) {
      return $this->cookieRequestVariables;
    }

    return $this->cookieRequestVariables[$key] ?? null;
  }
}
