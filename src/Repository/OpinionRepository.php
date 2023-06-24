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

    public function addOpinion(int $user_id, int $reservation_id, string $content): void {
        $stmt = $this->db->pdo->prepare("INSERT INTO opinions (user_id, reservation_id, content, display)
        SELECT r.user_id, r.id, :content, 'hide'
        FROM reservations r
        WHERE r.reservation_status = 'accept'
          AND r.user_id = :user_id
          AND r.id = :reservation_id;");
        $stmt->execute([
            "user_id" => $user_id,
            "reservation_id" => $reservation_id,
            "content" => $content
        ]);
    }

    public function updateOpinion(int $id, int $user_id, int $housing_id, int $reservation_id, string $content): void {
        $stmt = $this->db->pdo->prepare("UPDATE opinions SET user_id = :user_id, housing_id = :housing_id, reservation_id = :reservation_id, content = :content WHERE id = :id");
        $stmt->execute([
            "id" => $id,
            "user_id" => $user_id,
            "housing_id" => $housing_id,
            "reservation_id" => $reservation_id,
            "content" => $content
        ]);
    }

    public function updateDiplayOpinion(int $id, string $display): void {
        $stmt = $this->db->pdo->prepare("UPDATE opinions SET display = :display WHERE id = :id");
        $stmt->execute([
            "id" => $id,
            "display" => $display
        ]);
    }

    public function deleteOpinion(int $id, int $user_id): void {
        $stmt = $this->db->pdo->prepare("DELETE FROM opinions WHERE id = :id, user_id = :user_id");
        $stmt->execute([
            "id" => $id,
            "user_id" => $user_id
        ]);
    }

    public function adminDeleteOpinion(int $id, int $admin_id): void {
        $stmt = $this->db->pdo->prepare("DELETE FROM opinions WHERE id = :id
        AND user_id = :admin_id IN (SELECT id FROM users WHERE roles = 'admin')");
        $stmt->execute([
            "id" => $id,
            "admin_id" => $admin_id
        ]);
    }       
}