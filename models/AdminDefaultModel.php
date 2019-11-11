<?php
require_once 'Model.php';

class AdminDefaultModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $add_new_user = $this->add_new_user();
        if ($add_new_user !== null) {
            $_SESSION['add_user'] = $add_new_user;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $data = [];
        $data['users_list'] = $this->get_users_list();
        return $data;
    }

    private function get_users_list()
    {
        $query = 'SELECT u.id, user_name, proxy_address, proxy_port, proxy_user, proxy_pass, (SELECT c.date_last FROM anb_url a LEFT JOIN checkup c on a.id = c.iid_anb WHERE c.date_last IS NOT NULL AND a.id_user = u.id ORDER BY c.date_last DESC LIMIT 1) last_date FROM users u LEFT JOIN proxy p on u.id = p.id_user ORDER BY u.id';
        $res = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;
        }
        return [];
    }

    private function add_new_user()
    {
        if (isset($_POST['name_user'], $_POST['pass'], $_POST['confirm_pass'], $_POST['proxy_address'], $_POST['proxy_port'], $_POST['proxy_user'], $_POST['proxy_pass']) && $_POST['pass'] === $_POST['confirm_pass']) {
            $stmt = $this->conn->prepare('SELECT id FROM users WHERE user_name = :user_name');
            $stmt->bindValue(':user_name', trim($_POST['name_user']), PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "a user with that name exists";
            }
            $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare('INSERT INTO users SET user_name = :user_name, user_pass = :user_pass');
            $stmt->bindValue(':user_pass', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':user_name', $_POST['name_user'], PDO::PARAM_STR);
            $stmt->execute();
            $user_id = $this->conn->lastInsertId();
            $stmt = $this->conn->prepare('INSERT INTO proxy SET proxy_address = :proxy_address, proxy_port = :proxy_port, proxy_user = :proxy_user, proxy_pass = :proxy_pass, id_user = :user_id');
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':proxy_address', $_POST['proxy_address'], PDO::PARAM_STR);
            $stmt->bindValue(':proxy_port', (int)$_POST['proxy_port'], PDO::PARAM_INT);
            $stmt->bindValue(':proxy_user', $_POST['proxy_user'], PDO::PARAM_STR);
            $stmt->bindValue(':proxy_pass', $_POST['proxy_pass'], PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "new user has been added";
            } else {
                return "new user has not been added";
            }
        }
        return null;
    }
}