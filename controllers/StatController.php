<?php
require_once 'Controller.php';
require_once 'models/StatModel.php';

class StatController extends Controller
{
    private $model = null;
    private $id_url = null;
    public function __construct()
    {
        $this->model = new StatModel();
    }
    function index_page($id_url)
    {
        $this->id_url = $id_url;
        $data = ['id_url' => $this->id_url];
        echo $this->template('templates/stat.php', ["title" => "Статистика", "data" => $data]);
    }
}