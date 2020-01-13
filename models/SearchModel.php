<?php
require_once 'Model.php';

class SearchModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $data = [];
        if (!isset($_GET['date_start'], $_GET['date_end'], $_GET['bookopt'])) {
            $url = $this->get_URL(6);
            return $url;
        }
        $start_date = $_GET['date_start'];
        $end_date = $_GET['date_end'];
        $case_bookable = $_GET['bookopt'];
        $data = $this->get_free($start_date, $end_date, $case_bookable);

        $data['video_url'] = $this->get_URL(6);
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

    private function get_free($start_date, $end_date, $case_bookable)
    {
        $full_date = [];
        switch ($case_bookable){
            case 'book':
                $stmt = $this->conn->prepare("SELECT a.id, a.url, a.owner FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb WHERE a.id_user = :id_user AND NOT EXISTS (SELECT inner_d.id FROM days inner_d WHERE (inner_d.bookable = 0) AND inner_d.id_checkup = ch.id AND inner_d.date BETWEEN STR_TO_DATE(:st, '%Y-%m-%d') AND STR_TO_DATE(:en, '%Y-%m-%d')) AND DATEDIFF(STR_TO_DATE(:en, '%Y-%m-%d'), STR_TO_DATE(:st, '%Y-%m-%d')) >= (SELECT cd_d.min_nights FROM days cd_d WHERE cd_d.id_checkup = ch.id AND cd_d.date = STR_TO_DATE(:st, '%Y-%m-%d'))");
                break;
            case 'book_or_avail':
                $stmt = $this->conn->prepare("SELECT a.id, a.url, a.owner FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb WHERE a.id_user = :id_user AND NOT EXISTS (SELECT inner_d.id FROM days inner_d WHERE (inner_d.available = 0 OR inner_d.bookable = 0) AND inner_d.id_checkup = ch.id AND inner_d.date BETWEEN STR_TO_DATE(:st, '%Y-%m-%d') AND STR_TO_DATE(:en, '%Y-%m-%d'))");
                break;
            case 'all':
                $stmt = $this->conn->prepare("SELECT a.id, a.url, a.owner FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id_user = :id_user AND d.date BETWEEN STR_TO_DATE(:st, '%Y-%m-%d') AND STR_TO_DATE(:en, '%Y-%m-%d') GROUP BY a.id");
                break;
            default:
                throw new \Exception('Unexpected value $case_bookable');
        }

        $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
        $stmt->bindValue(':st', $start_date, PDO::PARAM_STR);
        $stmt->bindValue(':en', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dates as $d){
            $stmt = $this->conn->prepare("SELECT min_nights, date, price_day, available, bookable FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN  days d on ch.id = d.id_checkup WHERE a.id = :id_url AND d.date BETWEEN STR_TO_DATE(:st, '%Y-%m-%d') AND STR_TO_DATE(:en, '%Y-%m-%d')");
            $stmt->bindValue(':id_url', (int)$d['id'], PDO::PARAM_INT);
            $stmt->bindValue(':st', $start_date, PDO::PARAM_STR);
            $stmt->bindValue(':en', $end_date, PDO::PARAM_STR);
            $stmt->execute();
            $d['period'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $full_date[] = $d;
        }
        return $full_date;
    }
}