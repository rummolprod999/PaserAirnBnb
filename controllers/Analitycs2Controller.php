<?php
require_once 'Controller.php';
require_once 'models/Analitycs2Model.php';

class Analitycs2Controller extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new Analitycs2Model();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/analitycs2.php', ["title" => "Analitycs2", "data" => $data]);
    }

}