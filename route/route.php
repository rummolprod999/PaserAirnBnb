<?php
require_once 'RouterLite.php';
/*if (AuthControllerOld::$is_login || AuthControllerOld::check_auth()) {
    RouterLite::addRoute('/', 'DefaultController/index_page');
    RouterLite::addRoute('/stat/:num', 'StatController/index_page/$1');
    RouterLite::addRoute('/settings', 'SettingsController/index_page');
    RouterLite::addRoute('/changes/:num', 'ChangesController/index_page/$1');
    RouterLite::addRoute('/analytics', 'AnalitycsController/index_page');
    RouterLite::addRoute('/analytics2', 'Analitycs2Controller/index_page');

} else {
    RouterLite::addRoute('/', 'AuthController');
}*/
if (AuthController::$uid !== 0 && AuthController::$is_admin) {
    RouterLite::addRoute('/', 'AdminController');
    RouterLite::addRoute('/admin', 'AdminDefaultController');
} elseif (AuthController::$uid !== 0) {
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
