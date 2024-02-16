<?php

namespace Uph22si1Web\Todo\Controllers;

use Uph22si1Web\Todo\Models\Todo;
use Uph22si1Web\Todo\Request;
use Uph22si1Web\Todo\View;

class TodoController {
  function index(Request $request)
  {
    echo "list todo";
  }

  function show(Request $request, $id)
  {
    echo "show todo {$id}";
  }

  function new(Request $request)
  {
    echo "new todo";
  }

  function create(Request $request)
  {
    echo "create todo";
  }

  function edit(Request $request, $id)
  {
    echo "edit todo {$id}";
  }

  function update(Request $request, $id)
  {
    echo "update todo {$id}";
  }

  function delete(Request $request, $id)
  {
    echo "delete todo {$id}";
  }
}
