<?php
require_once 'Controller.php';
require_once 'models/AuthModel.php';

class AuthController extends Controller
{
    public static $uid = 0;
    public static $is_admin = false;
    public static $error = [];
    private $model = null;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function enter()
    {
        if (isset($_POST['login'], $_POST['password']) && $_POST['login'] !== '' && $_POST['password'] !== '') {
            $login = htmlentities(trim($_POST['login']));
            $password = htmlentities(trim($_POST['password']));
            $user = $this->model->get_user($login);
            if ($user) {

                if (password_verify($password, $user['user_pass'])) {
                    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                        setcookie('login', $user['user_name'], time() + (30 * 24 * 3600));
                        setcookie('password', md5($user['user_name'] . $user['user_pass']), time() + (30 * 24 * 3600));
                    } else {
                        setcookie('login', $user['user_name']);
                        setcookie('password', md5($user['user_name'] . $user['user_pass']));
                    }
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    self::$uid = (int)$_SESSION['id'];
                    $this->write_last_activity(self::$uid);
                } else {
                    self::$error[] = 'Wrong password';
                    return self::$error;
                }
            } else {
                self::$error[] = 'Wrong login or password';
                return self::$error;
            }

        } else {
            return self::$error;
        }
        return self::$error;
    }

    public function login()
    {
        ini_set('session.use_trans_sid', '1');
        session_start();
        if (isset($_SESSION['id'])) {
            $user = $this->model->get_user_from_id($_SESSION['id']);
            if (!($user && isset($_COOKIE['password']) && md5($user['user_name'] . $user['user_pass']) === $_COOKIE['password'])) {
                setcookie('login', '', time() - 1, '/');
                setcookie('password', '', time() - 1, '/');
                return false;
            }
            if (isset($_COOKIE['login'], $_COOKIE['password'])) {
                setcookie('login', '', time() - 1, '/');
                setcookie('password', '', time() - 1, '/');
                setcookie('login', $_COOKIE['login'], time() + (30 * 24 * 3600), '/');
                setcookie('password', $_COOKIE['password'], time() + (30 * 24 * 3600), '/');
                self::$uid = (int)$_SESSION['id'];
                $this->write_last_activity(self::$uid);
                return true;
            } else {
                if ($user) {
                    setcookie('login', $user['user_name'], time() + (30 * 24 * 3600));
                    setcookie('password', md5($user['user_name'] . $user['user_pass']), time() + (30 * 24 * 3600));
                    self::$uid = (int)$_SESSION['id'];
                    $this->write_last_activity(self::$uid);
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            if (isset($_COOKIE['login'], $_COOKIE['password'])) {
                $user = $this->model->get_user($_COOKIE['login']);
                if ($user && md5($user['user_name'] . $user['user_pass']) === $_COOKIE['password']) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    self::$uid = (int)$_SESSION['id'];
                    $this->write_last_activity(self::$uid);
                    return true;
                } else {
                    setcookie('login', '', time() - (30 * 24 * 3600), '/');
                    setcookie('password', '', time() - (30 * 24 * 3600), '/');
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function check_is_admin($user_id)
    {
        return $this->model->is_admin($user_id);
    }

    private function write_last_activity($user_id)
    {
        $this->model->write_last_activity($user_id);
    }

    public function out()
    {
        session_start();
        $_SESSION = array();
        setcookie('login', '', time() - (30 * 24 * 3600), '/');
        setcookie('password', '', time() - (30 * 24 * 3600), '/');
        session_destroy();
        header('location:/');
    }

    function index_page()
    {
        echo $this->template('templates/auth.php', ["title" => "Authentication"]);
    }
}