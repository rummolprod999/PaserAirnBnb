<?php
require_once 'Controller.php';
require_once 'models/SettingsModel.php';

class SettingsController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new SettingsModel();
    }

    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/settings.php', ["title" => "Настройки", "data" => $data]);
    }
}