<?

namespace app\models;

use app\core\Model;

class Lot extends Model {
  private $errors = [];

  // Добавление лота
  public function create($post = []) {
    $errors = $this->validation($post);

    if ($errors) {
      return $errors;
    }

    $rubles = $this->convertAmount($post['amount'], $this->getCurrencyById($post['currency'])[0]['rub_ratio']);

    $params = [
      'id' => '',
      'amount' => $post['amount'],
      'rubles' => $rubles,
      'status' => 'new',
      'completed' => 0,
      'currency_id' => $post['currency'],
    ];

    $this->db->query('INSERT INTO lots VALUES (:id, :amount, :rubles, :status, :completed, :currency_id)', $params);

    return 'Лот успешно добавлен';
  }

  // Обновление статуса лота
  public function update($post = []) {
    $errors = $this->validation($post);

    if ($errors) {
      return $errors;
    }

    $params = [
      'id' => $_POST['id'],
      'status' => $_POST['status'],
      'completed' => 1,
    ];

    $this->db->query('UPDATE lots SET status=:status, completed=:completed WHERE id=:id AND completed=0', $params);

    return 'Лот успешно оновлён';
  }

  // Получение списка валют
  public function getCurrencies() {
    return $this->db->row('SELECT * FROM currency ORDER BY id ASC');
  }

  // Получение всех лотов, если заданы параметры, то получние только незавершённых лотов
  public function getLots($params = []) {
    $query = '';

    if (isset($params['available']) && $params['available']) {
      $query = ' WHERE lots.completed = 0';
    }

    return $this->db->row("SELECT lots.id, amount, rubles, status, completed, name 
                               FROM lots JOIN currency ON lots.currency_id = currency.id $query 
                               ORDER BY lots.id ASC");
  }

  // Объединение валидации для добавления и обновления лота
  private function validation($post = []) {
    if (empty($post)) {
      http_response_code(400);
      return 'Неверный запрос';
    }

    if (!$this->isValid($post)) {
      http_response_code(400);
      return $this->errors;
    }

    return false;
  }

  // Получение лота по ID
  private function getCurrencyById($id) {
    $params = ['id' => $id];

    return $this->db->row('SELECT * FROM currency WHERE id=:id', $params);
  }

  // Конвертация валюты в рубли
  private function convertAmount($amount, $ratio) {
    return round($amount * $ratio, 2);
  }

  // Валидация входящих параметров
  private function isValid ($data) {
    foreach ($data as $key => $value) {
      switch ($key) {
        case 'amount':
          if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            $this->errors['amount'] = "Неверный формат ввода";
          }

          if (mb_strlen($value) < 1) {
            $this->errors['amount'] = (isset($this->errors['name'])
                ? $this->errors['amount'] . '. '
                : '') .
              "Вводимая сумма не должна быть пустая";
          }
          break;

        case 'currency':
          if ($value === 'none') {
            $this->errors['currency'] = "Выберете валюту";
          }
          break;

        case 'status':
          if (!isset($this->getStatuses()[$value])) {
            $this->errors['status'] = "Неверный статус";
          }
          break;

        case 'id':
          if (!filter_var($value, FILTER_VALIDATE_INT)) {
            $this->errors['id'] = "Неверный ID";
          }
          break;
      }
    }

    return empty($this->errors);
  }

  // Получение всех статусов из файла
  private function getStatuses() {
    return require_once 'app/config/lotStatuses.php';
  }
}