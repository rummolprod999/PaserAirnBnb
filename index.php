<?php
require_once 'controllers/AuthController.php';
$auth = new AuthController();
if ($auth->login()) {
    AuthController::$is_admin = $auth->check_is_admin(AuthController::$uid);
} else {
    $error = $auth->enter();
    if (count($error) === 0)
    {
        AuthController::$is_admin = $auth->check_is_admin(AuthController::$uid);
    }
}
require_once 'route/route.php';