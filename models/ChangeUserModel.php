<?php
require_once 'Model.php';

class ChangeUserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $upd_proxy = $this->change_proxy((int)$_GET['user_id']);
        if ($upd_proxy !== null) {
            $_SESSION['update_proxy'] = $upd_proxy;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $change_pass = $this->change_password((int)$_GET['user_id']);
        if ($change_pass !== null) {
            $_SESSION['update_password'] = $change_pass;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $data = [];
        $data['user'] = $this->get_user_from_id((int)$_GET['user_id']);
        return $data;
    }

    private function get_user_from_id($user_id)
    {
        $stmt = $this->conn->prepare('SELECT u.id, user_name, user_pass, proxy_address, proxy_port, proxy_user, proxy_pass FROM users u LEFT JOIN  proxy p on u.id = p.id_user WHERE u.id = :user_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function change_proxy($user_id)
    {
        if (isset($_POST['proxy_address'], $_POST['proxy_port'], $_POST['proxy_user'], $_POST['proxy_pass'])) {
            $stmt = $this->conn->prepare('UPDATE proxy SET proxy_address = :proxy_address, proxy_port = :proxy_port, proxy_user = :proxy_user, proxy_pass = :proxy_pass WHERE id_user = :user_id');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':proxy_address', $_POST['proxy_address'], PDO::PARAM_STR);
            $stmt->bindValue(':proxy_port', (int)$_POST['proxy_port'], PDO::PARAM_INT);
            $stmt->bindValue(':proxy_user', $_POST['proxy_user'], PDO::PARAM_STR);
            $stmt->bindValue(':proxy_pass', $_POST['proxy_pass'], PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "user proxy has been updated";
            } else {
                return "user proxy has not been updated";
            }
        }
        return null;
    }

    private function change_password($user_id)
    {
        if (isset($_POST['pass'], $_POST['confirm_pass']) && $_POST['pass'] === $_POST['confirm_pass']) {
            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare('UPDATE users SET user_pass = :user_pass WHERE id = :id');
            $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':user_pass', $hash, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "user password has been updated";
            } else {
                return "user password has not been updated";
            }
        }
        return null;
    }
}