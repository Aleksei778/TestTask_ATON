<?php

class UserController {
    private $model;
    private $cityModel;

    public function __construct() {
        require_once __DIR__ . '/../Models/User.php';
        require_once __DIR__ . '/../Models/City.php';

        $this->model = new User();
        $this->cityModel = new City();
    }

    public function index() {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'Users.ID';
        $sortDirection = isset($_GET['order']) ? $_GET['order'] : 'ASC';

        $filter = null;
        if (isset($_GET['filter_name']) && !empty($_GET['filter_name'])) {
            $filter = ['name' => $_GET['filter_name']];
        } elseif (isset($_GET['filter_location']) && !empty($_GET['filter_location'])) {
            $filter = ['location' => $_GET['filter_location']];
        }

        $users = $this->model->getAll($sortField, $sortDirection, $filter);

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/users/list.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }

    public function detail($id = null) {
        $user = null;

        if ($id !== null) {
            $user = $this->model->getById($id);

            if (!$user) {
                header('Location: users.php');
                exit;
            }
        }

        $cities = $this->cityModel->getAll('CITY', 'ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'FIRST_NAME' => $_POST['first_name'],
                'LAST_NAME' => $_POST['last_name'],
                'CITY_ID' => $_POST['city_id'],
            ];

            if ($id !== null) {
                $data['ID'] = $id;
            }

            if ($this->model->save($data)) {
                header('Location: users.php');
                exit;
            }
        }

        header('Content-Type: text/html; charset=UTF-8');

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/users/detail.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }
}