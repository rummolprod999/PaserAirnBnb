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
        $data = [];
        $data['users_list'] = $this->get_users_list();
        return $data;
    }

    private function get_users_list()
    {
        $query = 'SELECT u.id, user_name, proxy_address, proxy_port, proxy_user, proxy_pass FROM users u LEFT JOIN proxy p on u.id = p.id_user';
        $res = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;
        }
        return [];
    }
}