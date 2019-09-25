<?php
require_once 'RouterLite.php';
if (AuthController::$is_login || AuthController::check_auth()) {
    RouterLite::addRoute('/', 'DefaultController/index_page');
    RouterLite::addRoute('/stat/:num', 'StatController/index_page/$1');
    RouterLite::addRoute('/settings', 'SettingsController/index_page');
    RouterLite::addRoute('/changes/:num', 'ChangesController/index_page/$1');
    RouterLite::addRoute('/analytics', 'AnalitycsController/index_page');
    RouterLite::addRoute('/analytics2', 'Analitycs2Controller/index_page');

} else {
    RouterLite::addRoute('/', 'AuthController');
}
RouterLite::dispatch();
