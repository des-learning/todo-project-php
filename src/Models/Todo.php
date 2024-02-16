<?php

namespace Uph22si1Web\Todo\Models;

use PDO;

class Todo {
  // dependency injection
  function __construct(private PDO $db) {}

  public function all()
  {
    return $this->db->query("SELECT id, title, state, created_at, updated_at FROM todos ORDER BY id");
  }
}
