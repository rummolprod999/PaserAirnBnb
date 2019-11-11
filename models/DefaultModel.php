<?php

require_once 'Model.php';

class DefaultModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $add_mess = $this->add_url();
        $rem_mess = $this->remove_url();
        $launch_mess = $this->launch_parser();
        $data = $this->get_list_url();
        if ($launch_mess !== '') {
            $data['launch_mess'] = $launch_mess;
        }
        if ($add_mess !== '') {
            $data['add_mess'] = $add_mess;
        }
        if ($rem_mess !== '') {
            $data['rem_mess'] = $rem_mess;
        }
        return $data;
    }

    function add_url()
    {
        $message = '';
        $own = 0;
        if (isset($_POST['own']) && $_POST['own'] === 'true') {
            $own = 1;
        }
        if (isset($_POST['add_url']) && !empty($_POST['add_url'])) {
            $stmt = $this->conn->prepare('SELECT id FROM anb_url WHERE url = :url AND id_user = :id_user');
            $stmt->bindValue(':url', trim($_POST['add_url']), PDO::PARAM_STR);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $message = 'false';
                return $message;
            }
            $stmt = $this->conn->prepare('INSERT INTO anb_url SET url = :url, own = :own, id_user = :id_user');
            $stmt->bindValue(':url', trim($_POST['add_url']), PDO::PARAM_STR);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->bindValue(':own', $own, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $message = 'true';
                return $message;
            }
        }
        return $message;
    }

    function remove_url()
    {
        $message = '';
        if (isset($_POST['remove_url']) && !empty($_POST['remove_url'])) {
            $stmt = $this->conn->prepare('DELETE FROM anb_url WHERE id = :id AND id_user = :id_user');
            $stmt->bindValue(':id', (int)$_POST['remove_url'], PDO::PARAM_INT);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $message = '<div class="alert alert-warning" role="alert">Page deleted successfully</div>';
                return $message;
            }
        }
        return $message;
    }

    function launch_parser()
    {
        $message = '';
        if (isset($_POST['launch']) && !empty($_POST['launch']) && $_POST['launch'] === 'true') {
            try {
                $locale = 'ru_RU.UTF-8';
                setlocale(LC_ALL, $locale);
                putenv('LC_ALL=' . $locale);
                exec('java -jar ./anb-1.0-jar-with-dependencies.jar anb > /dev/null &');
                $message = '<div class="alert alert-success" role="alert">The parser is running, to view the results, go to "View Logs"</div>';
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        }
        return $message;
    }

    public function get_list_url()
    {
        $data = [];
        $query = 'SELECT id, url, owner, own, num_parsing, suspend FROM anb_url WHERE anb_url.id_user = :id_user ORDER BY own DESC';
        $data_new = [];
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
        $stmt->execute();
        $res =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $r) {
            $stmt = $this->conn->prepare('SELECT price_was, price, date_cal, date_parsing, num_parsing, seen FROM price_changes WHERE seen = 0 AND num_parsing = :num_parsing AND id_url = :id_url');
            $stmt->bindValue(':id_url', (int)$r['id'], PDO::PARAM_INT);
            $stmt->bindValue(':num_parsing', (int)$r['num_parsing'], PDO::PARAM_INT);
            $stmt->execute();
            $res_price_change = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->conn->prepare('SELECT date_cal, date_parsing, num_parsing, seen FROM bookable_changes WHERE seen = 0 AND id_url = :id_url');
            $stmt->bindValue(':id_url', (int)$r['id'], PDO::PARAM_INT);
            $stmt->execute();
            $res_bookable_change = $stmt->fetchAll(PDO::FETCH_ASSOC);


            $r['res_price_change'] = $res_price_change;
            $r['res_bookable_change'] = $res_bookable_change;

            $stmt = $this->conn->prepare('SELECT d.discount FROM discounts d WHERE d.id_url = :id ');
            $stmt->bindValue(':id', (int)$r['id'], PDO::PARAM_INT);
            $stmt->execute();
            $r['discounts'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $r['min_nights'] = $this->get_min_nights($r['id']);
            $data_new[] = $r;

        }
        $data['url_arr'] = $data_new;
        return $data;
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