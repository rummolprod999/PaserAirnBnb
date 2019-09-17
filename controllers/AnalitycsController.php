<?php
require_once 'Controller.php';
require_once 'models/AnalitycsModel.php';

class AnalitycsController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new AnalitycsModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/analitycs.php', ["title" => "Analitycs", "data" => $data]);
    }

}