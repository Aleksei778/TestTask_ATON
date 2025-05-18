<?php

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controllers/UserController.php';

$controller = new UserController();

$controller->index();