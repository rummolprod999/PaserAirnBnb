<?php
require_once 'Model.php';

class StatModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
    }

    public function get_info_url($id_url)
    {
        $data = [];
        $bookable_clean = $this->bookable_seen($id_url);
        if ($bookable_clean !== '') {
            $_SESSION['bookable_clean'] = $bookable_clean;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $suspend = $this->suspend($id_url);
        if ($suspend !== '') {
            $_SESSION['suspend'] = $suspend;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $unsuspend = $this->unsuspend($id_url);
        if ($unsuspend !== '') {
            $_SESSION['unsuspend'] = $unsuspend;
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        }
        $stmt = $this->conn->prepare('SELECT id, url, owner, apartment_name FROM anb_url WHERE id = :id');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();

        $data['info_url'] = $stmt->fetch(PDO::FETCH_ASSOC);

        /*$stmt = $this->conn->prepare('SELECT d.min_nights FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND d.date = CURDATE() LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['min_nights'] = $stmt->fetch(PDO::FETCH_ASSOC);*/
        $data['min_nights'] = $this->get_min_nights($id_url);
        $stmt = $this->conn->prepare('SELECT p.price_cleaning FROM price_cleaning p WHERE p.id_url = :id LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['cleaning_price'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT d.discount FROM discounts d WHERE d.id_url = :id ');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['discounts'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($data['discounts'] as &$disc){
            $disc = str_replace(' price', '', $disc);
        }
        unset($disc);
        $stmt = $this->conn->prepare('SELECT ch.check_in, ch.check_out, ch.price, ch.check_in_first_15, ch.check_out_first_15, ch.price_first_15, ch.check_in_second_15, ch.check_out_second_15, ch.price_second_15, ch.check_in_30, ch.check_out_30, ch.price_30 FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb WHERE a.id = :id LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['prices'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['prices']['check_in_first_15'] = explode(',', $data['prices']['check_in_first_15']);
        $data['prices']['check_out_first_15'] = explode(',', $data['prices']['check_out_first_15']);
        $data['prices']['price_first_15'] = explode(',', $data['prices']['price_first_15']);

        $data['prices']['check_in_second_15'] = explode(',', $data['prices']['check_in_second_15']);
        $data['prices']['check_out_second_15'] = explode(',', $data['prices']['check_out_second_15']);
        $data['prices']['price_second_15'] = explode(',', $data['prices']['price_second_15']);

        $data['prices']['check_in_30'] = explode(',', $data['prices']['check_in_30']);
        $data['prices']['check_out_30'] = explode(',', $data['prices']['check_out_30']);
        $data['prices']['price_30'] = explode(',', $data['prices']['price_30']);
        for($i=1; $i<= 8; $i++){
            if($i===1){
                $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day, (SELECT MAX(d_inner.price_day) mx FROM anb_url a_inner LEFT JOIN  checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN  days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = date AND d_inner.available = 1 AND d_inner.bookable = 1) max_price, (SELECT MIN(d_inner.price_day) mx FROM anb_url a_inner LEFT JOIN  checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN  days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = d.date AND d_inner.available = 1 AND d_inner.bookable = 1) min_price, (SELECT COUNT(a_inner.id) mx FROM anb_url a_inner LEFT JOIN checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = d.date AND d_inner.available = 1 AND d_inner.bookable = 1) only_book, (SELECT COUNT(a_inner.id) FROM anb_url a_inner WHERE a_inner.id_user = :id_user) all_app FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(NOW())');
                $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
                $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
                $stmt->execute();
                $data['days'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else{
                $interval = $i - 1;
                $stmt = $this->conn->prepare("SELECT date, available, available_for_checkin, bookable, price_day, (SELECT MAX(d_inner.price_day) mx FROM anb_url a_inner LEFT JOIN  checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN  days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = d.date AND d_inner.available = 1 AND d_inner.bookable = 1) max_price, (SELECT MIN(d_inner.price_day) mx FROM anb_url a_inner LEFT JOIN  checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN  days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = d.date AND d_inner.available = 1 AND d_inner.bookable = 1) min_price, (SELECT COUNT(a_inner.id) mx FROM anb_url a_inner LEFT JOIN checkup ch_inner ON a_inner.id = ch_inner.iid_anb LEFT JOIN days d_inner on ch_inner.id = d_inner.id_checkup WHERE a_inner.id_user = :id_user AND d_inner.date = d.date AND d_inner.available = 1 AND d_inner.bookable = 1) only_book, (SELECT COUNT(a_inner.id) FROM anb_url a_inner WHERE a_inner.id_user = :id_user) all_app FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL {$interval} MONTH))");
                $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
                $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
                $stmt->execute();
                $data["days$i"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        $stmt = $this->conn->prepare('SELECT date_cal FROM bookable_changes WHERE seen = 0 AND id_url = :id_url');
        $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
        //$stmt->bindValue(':num_parsing', (int)$r['num_parsing'], PDO::PARAM_INT);
        $stmt->execute();
        $res_bookable_change = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $data['res_bookable_change'] = $res_bookable_change;
        $data['video_url'] = $this->get_URL(4);

        return $data;
    }

    private function bookable_seen($id_url)
    {
        $message = '';
        if (isset($_POST['remove_bookable']) && !empty($_POST['remove_bookable']) && $_POST['remove_bookable'] === 'remove') {
            $stmt = $this->conn->prepare('UPDATE bookable_changes SET  seen = 1 WHERE id_url = :id_url');
            $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
            $stmt->execute();
            $clean_book = $stmt->rowCount();

            $stmt = $this->conn->prepare('UPDATE price_changes SET  seen = 1 WHERE id_url = :id_url');
            $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
            $stmt->execute();
            $clean_price = $stmt->rowCount();
            if ($clean_book > 0 || $clean_price > 0) {
                $message = '<div class="alert alert-warning" role="alert">Changes have been cleaned</div>';
                return $message;
            }
        }
        return $message;
    }

    private function get_URL($id)
    {
        $stmt = $this->conn->prepare('SELECT page_url_video FROM pages WHERE page_id = :id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['page_url_video'];
    }

    private function suspend($id_url)
    {
        $message = '';
        if (isset($_POST['suspend']) && !empty($_POST['suspend']) && $_POST['suspend'] === 'true') {
            $stmt = $this->conn->prepare('UPDATE anb_url SET  suspend = 2 WHERE id = :id_url');
            $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
            $stmt->execute();
            $message = '<div class="alert alert-warning" role="alert">Apartment have been suspend</div>';

        }
        return $message;
    }

    private function unsuspend($id_url)
    {
        $message = '';
        if (isset($_POST['unsuspend']) && !empty($_POST['unsuspend']) && $_POST['unsuspend'] === 'true') {
            $stmt = $this->conn->prepare('UPDATE anb_url SET  suspend = 0 WHERE id = :id_url');
            $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
            $stmt->execute();
            $message = '<div class="alert alert-success" role="alert">Apartment have been unsuspend</div>';
            return $message;

        }
        return $message;
    }

    function get_min_nights($id)
    {
        $stmt = $this->conn->prepare('SELECT d.min_nights, d.date FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id ORDER BY d.date');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $buffer = [];
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $buffer[] = $result[0];
            $count_res = count($result);
            for ($i = 0; $i < $count_res; $i++) {
                if (end($buffer)['min_nights'] !== $result[$i]['min_nights']) {
                    $buffer[] = $result[$i - 1];
                    $buffer[] = $result[$i];
                }
            }
            $buffer[] = end($result);
        }
        return $buffer;

    }
}