<?php
require_once 'Model.php';

class AnalitycsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->create_connection();
    }

    public function get_data()
    {
        $data = [];
        for ($i = 6; $i <= 31; $i++) {
            $query = "SELECT a.start_date, a.end_date FROM analitic a WHERE a.perid_nights = {$i} AND a.id_user = :id_user GROUP BY a.start_date, a.end_date ORDER BY a.start_date";
            $period = [];
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
            $stmt->execute();
            $res =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $r) {
                $stmt = $this->conn->prepare('SELECT a.start_date, a.end_date, a.price, au.id, au.own, au.owner  FROM analitic a JOIN anb_url au on a.id_url = au.id WHERE a.start_date = STR_TO_DATE(:st, \'%Y-%m-%d\') AND a.end_date = STR_TO_DATE(:en, \'%Y-%m-%d\') AND a.id_user = :id_user ORDER BY  a.price ASC');
                $stmt->bindValue(':st', $r['start_date'], PDO::PARAM_STR);
                $stmt->bindValue(':en', $r['end_date'], PDO::PARAM_STR);
                $stmt->bindValue(':id_user', AuthController::$uid, PDO::PARAM_INT);
                $stmt->execute();
                $res_inner = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $periods = [];
                foreach ($res_inner as $n) {
                    $periods[] = $n;
                }
                $period[] = $periods;
            }
            if (count($period) > 0) {
                $data[] = [$i => $period];
            }
        }

        return $data;
    }
}