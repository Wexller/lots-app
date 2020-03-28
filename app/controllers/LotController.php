<?

namespace app\controllers;

use app\core\Controller;

Class LotController extends Controller {
  // Главная страница
  public function indexAction() {
    $vars = array(
      'statuses' => $this->getStatuses(),
      'lots' => $this->model->getLots(),
      'currencies' => $this->model->getCurrencies(),
    );
    $this->view->render('Main page', $vars);
  }

  // Экшн незавершённых лотов
  public function listAction() {
    $vars = array(
      'statuses' => $this->getStatuses(),
      'lots' => $this->model->getLots(['available' => true]),
    );
    $this->view->render('Main page', $vars);
  }

  // Экшн создания лота
  public function createAction() {
    $this->checkRequest($_POST);
    echo json_encode($this->model->create($_POST));
  }

  // Экшн обновления лота
  public function updateAction() {
    $this->checkRequest($_POST);
    echo json_encode($this->model->update($_POST));
  }

  // Получение списка статусов
  private function getStatuses() {
    return require_once 'app/config/lotStatuses.php';
  }

  // Проверка запроса на пустоту
  private function checkRequest($query) {
    if (empty($query)) {
      $this->view->redirect('/');
      exit();
    }
  }
}