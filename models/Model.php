<?php


class Model
{
    public $conn = null;
    private $host = 'localhost';
    private $db = 'anb';
    private $user_db = 'root';
    private $pass_db = '1234';

    public function __construct()
    {
    }

    public function __destruct()
    {
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }

    public function get_data()
    {
    }

    public function create_connection()
    {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user_db, $this->pass_db, $opt);
    }
}