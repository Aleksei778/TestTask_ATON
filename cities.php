<?php

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controllers/CityController.php';

$controller = new CityController();

$controller->index();