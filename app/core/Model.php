<?php


namespace app\core;

use app\lib\DataBase;

abstract class Model {
  public $db;

  public function __construct()  {
    $this->db = new DataBase();
  }
}