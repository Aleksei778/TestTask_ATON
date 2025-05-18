<?php

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controllers/UserController.php';

$controller = new UserController();

$id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

$controller->detail($id);