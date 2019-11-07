<?php


class AuthModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_user($user_name){
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE user_name = :user_name');
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}