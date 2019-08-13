<?php
require_once 'Controller.php';

class AuthController extends Controller {
    private static $user = "admin";
    private static $password = "1234";
    public static $is_login = false;
    public static $wrong_pass = false;
    function index_page(){
        echo $this->template('templates/auth.php', ["title" => "Аутентификация"]);
    }

    static function check_auth(){
        return isset($_COOKIE['session_id']) && md5( self::$password . self::$user) === $_COOKIE['session_id'];
    }

    static function check_login_pass($pass, $login){
        return md5(self::$password . self::$user) === md5(trim($pass) . trim($login));
    }
}
