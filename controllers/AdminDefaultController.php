<?php


require_once 'Controller.php';
require_once 'models/AdminDefaultModel.php';

class AdminDefaultController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new AdminDefaultModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/admin_default.php', ["title" => "Admin Page", "data" => $data]);
    }
}