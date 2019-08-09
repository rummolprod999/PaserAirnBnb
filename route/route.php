<?php
require_once 'RouterLite.php';
if(false){
    RouterLite::addRoute('/', 'DefaultController');
    RouterLite::dispatch();
} else{
    require_once 'templates/auth.php';
}
