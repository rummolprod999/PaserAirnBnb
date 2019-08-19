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
        $stmt = $this->conn->prepare('SELECT id, url, owner, apartment_name FROM anb_url WHERE id = :id');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data = [];
        $data['info_url'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT d.min_nights FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['min_nights'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT ch.check_in, ch.check_out, ch.price FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb WHERE a.id = :id LIMIT 1');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['prices'] = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->conn->prepare('SELECT date, available, available_for_checkin, bookable FROM anb_url a LEFT JOIN  checkup ch ON a.id = ch.iid_anb LEFT JOIN days d on ch.id = d.id_checkup WHERE a.id = :id');
        $stmt->bindValue(':id', (int)$id_url, PDO::PARAM_INT);
        $stmt->execute();
        $data['days'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}