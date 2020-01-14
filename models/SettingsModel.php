<?php

require_once 'Model.php';

class SettingsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $stmt = $this->conn->prepare('SELECT c.date_last FROM anb_url a LEFT JOIN checkup c on a.id = c.iid_anb WHERE c.date_last IS NOT NULL AND a.id_user = :id_user ORDER BY c.date_last DESC LIMIT 1');
        $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
        $stmt->execute();
        $data = [];
        $data['date_last'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $url = $this->get_URL(7);

//        if(count($data['date_last']) > 0){
//            $ind = count($data['date_last']) - 1;
//        } else{
//            $ind = count($data['date_last']);
//        }
        $data['date_last'][1] = $url;

        return $data;
    }

    private function get_URL($id)
    {
        $stmt = $this->conn->prepare('SELECT page_url_video FROM pages WHERE page_id = :id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['page_url_video'];
    }
}