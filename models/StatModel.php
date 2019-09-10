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

    private function bookable_seen($id_url){
        $message = '';
        if (isset($_POST['remove_bookable']) && !empty($_POST['remove_bookable']) && $_POST['remove_bookable'] === 'remove') {
            $stmt = $this->conn->prepare('UPDATE bookable_changes SET  seen = 1 WHERE id_url = :id_url');
            $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $message = '<div class="alert alert-warning" role="alert">Booking have been cleaned</div>';
                return $message;
            }
        }
        return $message;
    }
    public function get_info_url($id_url)
    {
        $data = [];
        $bookable_clean = $this->bookable_seen($id_url);
        $data['bookable_clean'] = $bookable_clean;
        $stmt = $this->conn->prepare('SELECT id, url, owner, apartment_name FROM anb_url WHERE id = :id');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();

        $data['info_url'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT d.min_nights FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND d.date = CURDATE() LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['min_nights'] = $stmt->fetch(PDO::FETCH_ASSOC);

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

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(NOW())');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 1 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days2'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 2 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days3'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 3 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days4'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 4 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days5'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 5 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days6'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 6 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days7'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable, price_day FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND MONTH(date) = MONTH(DATE_ADD(DATE_SUB(LAST_DAY(NOW()),INTERVAL DAY(LAST_DAY(NOW()))- 1 DAY), INTERVAL 7 MONTH))');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days8'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}