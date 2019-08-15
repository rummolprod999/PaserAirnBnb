<?php

require_once 'Model.php';

class DefaultModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
    }

    public function get_list_url(){
        $query = 'SELECT id, url, owner FROM anb_url';
        $data = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}