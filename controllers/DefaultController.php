<?php
require_once 'Controller.php';
require_once 'models/DefaultModel.php';

class DefaultController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new DefaultModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/default.php', ["title" => "Main Page", "data" => $data]);
    }
}