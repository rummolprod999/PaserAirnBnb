<?php
require_once 'Controller.php';
require_once 'models/ChangesModel.php';

class ChangesController extends Controller
{
    private $model = null;
    private $id_url = null;
    public function __construct()
    {
        $this->model = new ChangesModel();
    }
    function index_page($id_url)
    {
        $this->id_url = $id_url;
        $data = $this->model->get_info_url($this->id_url);
        echo $this->template('templates/changes.php', ["title" => "Changes", "data" => $data]);
    }
}