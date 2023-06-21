<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

use Model\OpinionModel;

class OpinionRepository extends Repository{

    public function selectOpinion(int $id) {
        $stmt = $this->db->pdo->prepare("SELECT id, user_id, housing_id, reservation_id, content, display FROM opinions WHERE id = :id");
        $stmt->execute([
            "id" => $id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];
        foreach($results as $r) {
            $opinions[] = (new OpinionModel())
            ->setId($r['id'])
            ->setUserId($r['user_id'])
            ->setHousingId($r['housing_id'])
            ->setReservationId($r['reservation_id'])
            ->setContent($r['content'])
            ->setDisplay($r['display']);
        }
        return $opinions;
    }

    public function selectOpinionsByUserId(int $user_id) {
        $stmt = $this->db->pdo->prepare("SELECT id, user_id, housing_id, reservation_id, content, display FROM opinions WHERE user_id = :user_id");
        $stmt->execute([
            "user_id" => $user_id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];
        foreach($results as $r) {
            $opinions[] = (new OpinionModel())
            ->setId($r['id'])
            ->setUserId($r['user_id'])
            ->setHousingId($r['housing_id'])
            ->setReservationId($r['reservation_id'])
            ->setContent($r['content'])
            ->setDisplay($r['display']);
        }
        return $opinions;
    }
}