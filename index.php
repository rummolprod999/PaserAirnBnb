<?php
if (isset($_POST['login'], $_POST['password'])) {
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);
    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        setcookie('session_id', md5(trim($password) . trim($login)), time() + (30 * 24 * 3600));
    } else {
        setcookie('session_id', md5(trim($password) . trim($login)));
    }
    require_once 'controllers/AuthController.php';
    $a = new AuthController();
    if (AuthController::check_login_pass($password, $login)) {
        AuthController::$is_login = true;
    } else {
        AuthController::$wrong_pass = true;
    }

} else {
    require_once 'controllers/AuthController.php';
    $a = new AuthController();
    if (AuthController::check_auth()) {
        AuthController::$is_login = true;
    }
}
require_once 'route/route.php';