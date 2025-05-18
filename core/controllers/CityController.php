<?php

class CityController {
    private $model;
    private $countryModel;

    public function __construct() {
        require_once __DIR__ . '/../Models/City.php';
        require_once __DIR__ . '/../Models/Country.php';

        $this->model = new City();
        $this->countryModel = new Country();
    }

    public function index() {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'Users.ID';
        $sortDirection = isset($_GET['order']) ? $_GET['order'] : 'ASC';

        $filter = null;
        if (isset($_GET['filter_name']) && !empty($_GET['filter_name'])) {
            $filter = ['name' => $_GET['filter_name']];
        } elseif (isset($_GET['filter_id']) && !empty($_GET['filter_id'])) {
            $filter = ['id' => $_GET['filter_id']];
        }

        $cities = $this->model->getAll($sortField, $sortDirection, $filter);

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/cities/list.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }

    public function detail($id = null) {
        $city = null;

        if ($id !== null) {
            $city = $this->model->getById($id);

            if (!$city) {
                header('Location: city.php');
                exit;
            }
        }

        $countries = $this->countryModel->getAll('COUNTRY', 'ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'CITY' => $_POST['city'],
                'COUNTRY_ID' => $_POST['country_id'],
            ];

            if ($id !== null) {
                $data['ID'] = $id;
            }

            if ($this->model->save($data)) {
                header('Location: cities.php');
                exit;
            }
        }

        header('Content-Type: text/html; charset=UTF-8');

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/cities/detail.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }
}