<?php
require_once 'controllers/AuthController.php';
if (isset($_POST['login'], $_POST['password'])) {
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);
    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        setcookie('session_id', md5(trim($password) . trim($login)), time() + (30 * 24 * 3600));
    } else {
        setcookie('session_id', md5(trim($password) . trim($login)));
    }
    $a = new AuthControllerOld();
    if (AuthControllerOld::check_login_pass($password, $login)) {
        AuthControllerOld::$is_login = true;
    } else {
        AuthControllerOld::$wrong_pass = true;
    }

} else {
    $a = new AuthControllerOld();
    if (AuthControllerOld::check_auth()) {
        AuthControllerOld::$is_login = true;
    }
}
require_once 'route/route.php';