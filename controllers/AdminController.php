<?php
require_once 'Controller.php';
require_once 'models/AdminModel.php';

class AdminController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/admin.php', ["title" => "Admin Page", "data" => $data]);
    }
}