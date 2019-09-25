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
        $query = 'SELECT d.start_date, d.end_date, d.days FROM date_not_first d';
        $data['not_first'] = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

        $query = 'SELECT d.id, day_month, count FROM date_not_first_count d';
        $days = [];
        $res = $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $r) {
            $stmt = $this->conn->prepare('SELECT date_start, date_end FROM intervals_count inter WHERE inter.id_count = :id_count');
            $stmt->bindValue(':id_count', (int)$r['id'], PDO::PARAM_INT);
            $stmt->execute();
            $res_inner = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $days[] = ['day_month' => $r['day_month'], 'count' => $r['count'], 'intervals' => $res_inner];
        }
        $data['inter'] = $days;
        return $data;
    }
}
