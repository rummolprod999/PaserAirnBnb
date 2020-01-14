<?php
require_once 'Controller.php';
require_once 'models/MatrixModel.php';

class MatrixController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new MatrixModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/matrix.php', ["title" => "Availability table", "data" => $data]);
    }
}