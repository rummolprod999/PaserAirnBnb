<?php
require_once 'RouterLite.php';
if(AuthController::$is_login || AuthController::check_auth()){
    RouterLite::addRoute('/', 'DefaultController/index_page');

} else{
    RouterLite::addRoute('/', 'AuthController');
}
RouterLite::dispatch();
