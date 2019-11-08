<?php
require_once 'Controller.php';
require_once 'models/AuthModel.php';

class AuthController extends Controller
{
    public $uid = 0;
    public $is_admin = false;
    private $model = null;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function enter()
    {
        $error = array();
        if (isset($_POST['login'], $_POST['password']) && $_POST['login'] !== '' && $_POST['password'] !== '') {
            $login = htmlentities(trim($_POST['login']));
            $password = htmlentities(trim($_POST['password']));
            $user = $this->model->get_user($login);
            if ($user) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                if (password_verify($user['user_pass'], $hash)) {
                    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                        setcookie('login', $user['user_name'], time() + (30 * 24 * 3600));
                        setcookie('password', md5($user['user_name'] . $user['user_pass']), time() + (30 * 24 * 3600));
                    } else {
                        setcookie('login', $user['user_name']);
                        setcookie('password', md5($user['user_name'] . $user['user_pass']));
                    }
                    $_SESSION['id'] = $user['id'];
                    $this->uid = $_SESSION['id'];
                } else {
                    $error[] = 'Wrong password';
                    return $error;
                }
            } else {
                $error[] = 'Wrong login or password';
                return $error;
            }

        } else {
            $error[] = 'Empty fields';
            return $error;
        }
        return $error;
    }

    public function login()
    {
        ini_set('session.use_trans_sid', '1');
        session_start();
        if (isset($_SESSION['id'])) {
            if (isset($_COOKIE['login'], $_COOKIE['password'])) {
                setcookie('login', '', time() - 1, '/');
                setcookie('password', '', time() - 1, '/');
                setcookie('login', $_COOKIE['login'], time() + (30 * 24 * 3600), '/');
                setcookie('password', $_COOKIE['password'], time() + (30 * 24 * 3600), '/');
                $this->uid = $_SESSION['id'];
                return true;
            } else {
                $user = $this->model->get_user_from_id($_SESSION['id']);
                if ($user) {
                    setcookie('login', $user['user_name'], time() + (30 * 24 * 3600));
                    setcookie('password', md5($user['user_name'] . $user['user_pass']), time() + (30 * 24 * 3600));
                    $this->uid = $_SESSION['id'];
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
                    $this->uid = $_SESSION['id'];
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
    public function check_is_admin($user_id){
        return $this->model->is_admin($user_id);
    }
    function index_page()
    {
        echo $this->template('templates/auth.php', ["title" => "Authentication"]);
    }
}