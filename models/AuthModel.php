<?php
require_once 'Model.php';

class AuthModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_user($user_name)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE user_name = :user_name');
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_user_from_id($user_id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE id = :user_id');
        $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function is_admin($user_id)
    {
        $stmt = $this->conn->prepare('SELECT is_admin FROM users WHERE id = :user_id');
        $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res && $res['is_admin'] === '1';
    }

    public function write_last_activity($user_id)
    {
        $curr_time = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        $request_page = $_SERVER['REQUEST_URI'];
        $stmt = $this->conn->prepare('INSERT INTO users_activity SET id_user = :id_user, last_logon = :last_logon, ip_address = :ip_address, request_page = :request_page');
        $stmt->bindValue(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':last_logon', $curr_time, PDO::PARAM_STR);
        $stmt->bindValue(':ip_address', $ip, PDO::PARAM_STR);
        $stmt->bindValue(':request_page', $request_page, PDO::PARAM_STR);
        $stmt->execute();
    }
}