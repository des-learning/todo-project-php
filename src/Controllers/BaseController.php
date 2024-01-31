<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Request;

interface BaseController {
    /**
     * @return void
     * @param mixed $request
     */
    function handle(Request $request);
}
