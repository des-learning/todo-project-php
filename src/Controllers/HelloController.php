<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;

// HelloController mengimplementasikan BaseController
class HelloController implements BaseController {
  public function handle(Request $request): void {
    // kita mengakses informasi data yang kirim oleh user
    // melalui object request
    $name = $request->input('name') ?? 'World';

    echo "Hello $name";
  }
}
