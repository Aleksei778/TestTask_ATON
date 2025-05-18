<?php

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controllers/CountryController.php';

$controller = new CountryController();

$controller->index();