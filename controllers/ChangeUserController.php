<?php

require_once 'Controller.php';
require_once 'models/ChangeUserModel.php';

class ChangeUserController extends Controller
{
    private $model = null;
    public function __construct()
    {
        $this->model = new ChangeUserModel();
    }
    function index_page()
    {
        $data = $this->model->get_data();
        if(!$data['user']){
            header('location:/404');
        }
        echo $this->template('templates/change_user.php', ["title" => "Change User", "data" => $data]);
    }
}