<?php
require_once 'Controller.php';

class AuthController extends Controller {
    private static $user = "admin";
    private static $password = "1234";

    function index_page(){
        echo $this->template('templates/auth.php', []);
    }

    static function check_auth(){
        return isset($_COOKIE['session_id']) && md5( self::$password . self::$user) === $_COOKIE['session_id'];
    }
}
