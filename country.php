<?php

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controllers/CityController.php';

$controller = new CityController();

$id = isset($_GET['country_id']) ? $_GET['country_id'] : null;

$controller->detail($id);