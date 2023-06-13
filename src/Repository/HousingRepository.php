<?php

namespace Repository;

use App\Database;
use Model\HousingModel;
use PDO;
use PDOException;

class HousingRepository {
    private Database $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function selectAllHousing(): array {
        $stmt = $this->db->pdo->prepare("SELECT * FROM housing");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}