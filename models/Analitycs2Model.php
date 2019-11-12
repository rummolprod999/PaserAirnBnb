<?php

require_once 'Model.php';

class Analitycs2Model extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $data = [];
        $query = 'SELECT d.start_date, d.end_date, d.days FROM date_not_first d WHERE id_user = :id_user';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
        $stmt->execute();
        $data['not_first'] =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $query = 'SELECT d.id, day_month, count_m FROM date_not_first_count d WHERE id_user = :id_user';
        if (isset($_GET['date_start'])) {
            $stmt = $this->conn->prepare('SELECT inter.date_start, inter.date_end, DAYOFMONTH(:dt) dd FROM intervals_count inter JOIN date_not_first_count dnf ON inter.id_count = dnf.id WHERE (STR_TO_DATE(:dt, \'%Y-%m-%d\') >= inter.date_start AND STR_TO_DATE(:dt, \'%Y-%m-%d\') <= inter.date_end) AND dnf.day_month = DAYOFMONTH(:dt) AND inter.id_user = :id_user');
            $stmt->bindValue(':dt', (string)$_GET['date_start'], PDO::PARAM_STR);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->execute();
            $res_inner = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data['inter_filter'] = $res_inner;
        } else {
            $days = [];
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->execute();
            $res =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $r) {
                $stmt = $this->conn->prepare('SELECT date_start, date_end FROM intervals_count inter WHERE inter.id_count = :id_count AND inter.id_user = :id_user');
                $stmt->bindValue(':id_count', (int)$r['id'], PDO::PARAM_INT);
                $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
                $stmt->execute();
                $res_inner = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $days[] = ['day_month' => $r['day_month'], 'count' => $r['count_m'], 'intervals' => $res_inner];
            }
            $data['inter'] = $days;
        }

        return $data;
    }
}
