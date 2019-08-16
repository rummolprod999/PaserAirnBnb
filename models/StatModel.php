<?php
require_once 'Model.php';

class StatModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }
    public function get_data()
    {

    }
}