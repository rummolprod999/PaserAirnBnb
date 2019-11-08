<?php
require_once 'controllers/AuthController.php';
$auth = new AuthController();
if ($auth->login()){
    $auth->is_admin = $auth->check_is_admin($auth->uid);
} else{
    $error = $auth->enter();
    if (count($error) === 0) //если ошибки отсутствуют, авторизируем пользователя
    {
        $auth->is_admin = $auth->check_is_admin($auth->uid);
    }
}
require_once 'route/route.php';