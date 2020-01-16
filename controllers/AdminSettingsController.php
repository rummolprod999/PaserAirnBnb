<?php


require_once 'Controller.php';
require_once 'models/AdminSettingsModel.php';

class AdminSettingsController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new AdminSettingsModel();
//        $this->log_file = 'parser/logdir_anb_' . AuthController::$uid . '/log_parsing_ANB.log';
    }

    function index_page()
    {
        $data = [];
        $users = $this->model->get_data();
        $i = 0;
        foreach ($users['users'] as $user){
            $data[$i]['logs'] = $this->read_log($user['id']);
            $data[$i]['names'] = $users['names'][$i];
            $i++;
        }
        echo $this->template('templates/admin_settings.php', ["title" => "Admin Logs", "data" => $data]);
    }

    private function read_log($uid)
    {
        $message = [];
        if (file_exists('parser/logdir_anb_' . $uid . '/log_parsing_ANB.log')) {
            $file = file('parser/logdir_anb_' . $uid . '/log_parsing_ANB.log');
            $message = array_reverse($file);
        }
        return $message;
    }

}