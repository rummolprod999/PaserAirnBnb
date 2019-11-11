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
}