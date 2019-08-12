<?php
require_once 'RouterLite.php';
if(AuthController::check_auth() || AuthController::$is_login){
    RouterLite::addRoute('/', 'DefaultController/index_page');

} else{
    RouterLite::addRoute('/', 'AuthController');
}
RouterLite::dispatch();
