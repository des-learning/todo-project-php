<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;

class HelloController implements BaseController {
  public function handle(Request $request): void {
    $name = $request->query('name') ?? 'World';

    echo "Hello $name";
  }
}
