<?php

namespace Repository;

use App\Database;
use Model\HousingModel;
use PDO;
// use PDOException;

class HousingRepository extends Repository{

    public function selectAllHousing(): array {
        $stmt = $this->db->pdo->prepare("SELECT * FROM housing;");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $housings = [];
        foreach($results as $r){
            $housings[] = new HousingModel($r);
        }
        return $housings;
    }
// PAS TOUCHER !!   INNER JOIN housing_images hi ON h.id = hi.housing_id;
    public function selectHousingForHome(): array {
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.price, h.description, h.number_pieces, h.area
        FROM housing h;");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $housings = [];
        foreach($results as $r){
            $housings[] = new HousingModel($r);
        }
        return $housings;
    }
}