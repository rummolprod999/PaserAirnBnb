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
        return $data;
    }
}