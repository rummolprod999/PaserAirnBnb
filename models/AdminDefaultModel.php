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
        $remove_user = $this->remove_user();
        if ($remove_user !== null) {
            $_SESSION['remove_user'] = $remove_user;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $data = [];
        $data['users_list'] = $this->get_users_list();
        return $data;
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

    private function remove_user()
    {
        if (isset($_POST['remove_user']) && !empty($_POST['remove_user'])) {
            $this->remove_dirs();
            $stmt = $this->conn->prepare('DELETE FROM users WHERE id = :id');
            $stmt->bindValue(':id', (int)$_POST['remove_user'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return 'the user has been removed';
            } else {
                return 'the user has not been removed';
            }
        }
        return null;
    }

    private function remove_dirs()
    {
        $dir_log = getcwd() . '/parser/logdir_anb_' . (int)$_POST['remove_user'];
        $dir_temp = getcwd() . '/parser/tempdir_anb_' . (int)$_POST['remove_user'];
        if (file_exists($dir_log)) {
            $this->recursive_remove_dir($dir_log);
        }
        if (file_exists($dir_temp)) {
            $this->recursive_remove_dir($dir_temp);
        }
    }

    private function recursive_remove_dir($dir)
    {
        $includes = glob($dir . '/*');
        foreach ($includes as $include) {
            if (is_dir($include)) {
                $this->recursive_remove_dir($include);
            } else {
                unlink($include);
            }
        }
        rmdir($dir);
    }

    private function get_users_list()
    {
        $query = 'SELECT u.id, user_name, proxy_address, proxy_port, proxy_user, proxy_pass, u.is_admin, (SELECT c.date_last FROM anb_url a LEFT JOIN checkup c on a.id = c.iid_anb WHERE c.date_last IS NOT NULL AND a.id_user = u.id ORDER BY c.date_last DESC LIMIT 1) last_date FROM users u LEFT JOIN proxy p on u.id = p.id_user ORDER BY u.id';
        $res = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;
        }
        return [];
    }
}