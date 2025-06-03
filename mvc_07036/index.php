<?php
require_once 'controllers/MahasiswaController.php';

$controller = new MahasiswaController();

$page = $_GET['page'] ?? 'index';
$id   = $_GET['id'] ?? null;

switch ($page) {
    case 'create': $controller->create(); break;
    case 'store': $controller->store(); break;
    case 'edit': $controller->edit($id); break;
    case 'update': $controller->update($id); break;
    case 'delete': $controller->delete($id); break;
    default: $controller->index(); break;
}
