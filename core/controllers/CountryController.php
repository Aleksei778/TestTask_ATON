<?php

class CountryController {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../Models/Country.php';

        $this->model = new Country();
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

        $countries = $this->model->getAll($sortField, $sortDirection, $filter);

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/countries/list.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }

    public function detail($id = null) {
        $country = null;

        if ($id !== null) {
            $country = $this->model->getById($id);

            if (!$country) {
                header('Location: country.php');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'COUNTRY' => $_POST['country'],
            ];

            if ($id !== null) {
                $data['ID'] = $id;
            }

            if ($this->model->save($data)) {
                header('Location: countries.php');
                exit;
            }
        }

        header('Content-Type: text/html; charset=UTF-8');

        include_once __DIR__ . '/../../views/templates/header.php';
        include_once __DIR__ . '/../../views/countries/detail.php';
        include_once __DIR__ . '/../../views/templates/footer.php';
    }
}