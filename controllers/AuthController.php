<?php
require_once 'Controller.php';
require_once 'models/AuthModel.php';

class AuthController extends Controller {
    private static $user;
    private static $password;
    public static $is_login = false;
    public static $wrong_pass = false;
    private $model;
    public function __construct()
    {
        $this->model = new AuthModel();
        self::$user = $this->model->user;
        self::$password = $this->model->password;
    }

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
