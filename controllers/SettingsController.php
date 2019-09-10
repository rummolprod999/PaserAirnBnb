<?php
require_once 'Controller.php';
require_once 'models/SettingsModel.php';

class SettingsController extends Controller
{
    private $model = null;
    private $log_file = 'logdir_tenders_anb/log_parsing_ANB.log';

    public function __construct()
    {
        $this->model = new SettingsModel();
    }
    private function read_log(){
    $message = '';
    if(file_exists($this->log_file)){
        $file = file($this->log_file);
        $message = array_reverse($file);
    }
    return $message;
    }
    function index_page()
    {
        $data = $this->model->get_data();
        $data['file_log'] = $this->read_log();
        echo $this->template('templates/settings.php', ["title" => "Log", "data" => $data]);
    }

}