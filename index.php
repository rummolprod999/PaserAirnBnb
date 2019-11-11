<?php
require_once 'controllers/AuthController.php';
require_once 'helpers/navHelpers.php';
$auth = new AuthController();
if (isset($_GET['action']) && $_GET['action'] === 'out') {
    $auth->out();
} else {
    if ($auth->login()) {
        AuthController::$is_admin = $auth->check_is_admin(AuthController::$uid);
    } else {
        $error = $auth->enter();
        if (count($error) === 0) {
            AuthController::$is_admin = $auth->check_is_admin(AuthController::$uid);
        }
    }
}

require_once 'route/route.php';