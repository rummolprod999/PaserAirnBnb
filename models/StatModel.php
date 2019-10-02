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

    private function suspend($id_url)
    {
        $message = '';
        if (isset($_POST['suspend']) && !empty($_POST['suspend']) && $_POST['suspend'] === 'true') {
            $stmt = $this->conn->prepare('UPDATE anb_url SET  suspend = 1 WHERE id = :id_url');
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
            $message = '<div class="alert alert-warning" role="alert">Apartment have been unsuspend</div>';
            return $message;

        }
        return $message;
    }

    private function bookable_seen($id_url)
    {
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
        $suspend = $this->suspend($id_url);
        if ($suspend !== '') {
            $data['suspend'] = $suspend;
        }
        $unsuspend = $this->unsuspend($id_url);
        if ($unsuspend !== '') {
            $data['unsuspend'] = $unsuspend;
        }
        $stmt = $this->conn->prepare('SELECT id, url, owner, apartment_name FROM anb_url WHERE id = :id');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();

        $data['info_url'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT d.min_nights FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id AND d.date = CURDATE() LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['min_nights'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT p.price_cleaning FROM price_cleaning p WHERE p.id_url = :id LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['cleaning_price'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT d.discount FROM discounts d WHERE d.id_url = :id ');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['discounts'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

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

        $stmt = $this->conn->prepare('SELECT date_cal FROM bookable_changes WHERE seen = 0 AND id_url = :id_url');
        $stmt->bindValue(':id_url', (int)$id_url, PDO::PARAM_INT);
        //$stmt->bindValue(':num_parsing', (int)$r['num_parsing'], PDO::PARAM_INT);
        $stmt->execute();
        $res_bookable_change = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $data['res_bookable_change'] = $res_bookable_change;
        return $data;
    }
}