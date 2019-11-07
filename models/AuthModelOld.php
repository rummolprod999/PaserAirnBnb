<?php

require_once 'Model.php';

class AuthModelOld extends Model
{
    public $user = '';
    public $password = '';

    public function __construct()
    {
        parent::__construct();
        $this->password = '1234';
        $this->user = 'admin';
    }
}