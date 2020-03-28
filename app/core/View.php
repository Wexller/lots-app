<?php


namespace app\core;


class View {
  public $path;
  public $route;
  public $layout = 'default';

  public function __construct($route) {
    $this->route = $route;
    $this->path = $route['controller'] . '/' . $route['action'];
  }

  // Подключение представления в зависимости от текущего контроллера и передача переменных в шаблон
  public function render($title, $vars = []) {
    extract($vars);
    $path = 'app/views/' . $this->path . '.php';
    if (file_exists($path)) {
      ob_start();
      require_once $path;
      $content = ob_get_clean();
      require_once 'app/views/layouts/' . $this->layout . '.php';
    } else {
      echo "View not found $path";
    }
  }

  public function redirect($url) {
    header("location: $url");
    exit;
  }

  // Рендер представления с ошибкой
  public static function errorCode($code) {
    http_response_code($code);
    $path = 'app/views/errors/' . $code . '.php';
    if (file_exists($path)) {
      require_once $path;
    } else {
      echo "View not found $path";
    }
  }
}