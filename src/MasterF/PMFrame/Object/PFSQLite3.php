<?php

namespace MasterF\PMFrame\Object;


class PFSQLite3 {

  private $db;

  public function __construct(\SQLite3 $sqlite) {
    $this->db = $sqlite;
  }

  public function create($table, array $colum) {

  }
  
  public function select($table, $where = []) {

  }
}
