<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

use Model\ReservationModel;

class ReservationRepository extends Repository{

    public function selectReservation(int $id): array{
        $stmt = $this->db->pdo->prepare("SELECT id, user_id, housing_id, reservation_period, reservation_total_price, reservation_status FROM reservations WHERE user_id = :id");
        $stmt->execute([
            ":id" => $id,
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reservation = [];
        foreach ($results as $r){
            $reservation[] = (new ReservationModel())
            ->setId($r['id'])
            ->setUserId($r['user_id'])
            ->setHousingId($r['housing_id'])
            ->setPeriod($r['reservation_period'])
            ->setTotalPrice($r['reservation_total_price'])
            ->setStatus($r['reservation_status']);
        }

        return $reservation;
    }
}