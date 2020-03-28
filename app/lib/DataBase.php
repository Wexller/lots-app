<?php


namespace app\lib;

use PDO;

class DataBase {

  protected $db;

  // Подключение к базе
  public function __construct() {
    $config = require_once 'app/config/db.php';

    $this->db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8', $config['user'], $config['password']);
  }

  // Формирование безопасного запроса к базе
  public function query($sql, $params = []) {
    $preparedSql = $this->db->prepare($sql);
    if ($params) {
      foreach ($params as $key => $value) {
        $preparedSql->bindValue(":$key", $value);
      }
    }

    $preparedSql->execute();
    return $preparedSql;
  }

  // Получнение списка
  public function row($sql, $params = []) {
    $result = $this->query($sql, $params);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  // Получение столбца
  public function column($sql, $params = []) {
    $result = $this->query($sql, $params);
    return $result->fetchColumn();
  }
}