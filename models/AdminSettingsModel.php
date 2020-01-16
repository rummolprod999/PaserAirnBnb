<?php
require_once 'Model.php';

class AdminSettingsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $data = [];
        $data['users'] = $this->get_users();
        $data['names'] = $this->get_names();
        return $data;
    }

    private function get_users()
    {
        if(isset($_POST['user_name'])){
            $stmt = $this->conn->prepare('SELECT id FROM users WHERE user_name = :user_name');
            $stmt->bindValue(':user_name', $_POST['user_name'], PDO::PARAM_STR);
        } else{
            $stmt = $this->conn->prepare('SELECT id FROM users WHERE is_admin = 0');
        }

        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    private function get_names()
    {
        if(isset($_POST['user_name'])){
            $stmt = $this->conn->prepare('SELECT user_name FROM users WHERE user_name = :user_name');
            $stmt->bindValue(':user_name', $_POST['user_name'], PDO::PARAM_STR);
        } else{
            $stmt = $this->conn->prepare('SELECT user_name FROM users WHERE is_admin = 0');
        }

        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

}