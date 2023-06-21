<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

use Model\ReservationModel;

class ReservationRepository extends Repository{

    public function selectReservation(int $id): array{
        $stmt = $this->db->pdo->prepare("SELECT r.id, r.user_id, r.housing_id, r.reservation_period, r.reservation_total_price, r.reservation_status, hu.unavailability_start, hu.unavailability_end FROM reservations r JOIN housing_unavailability hu ON r.housing_id = hu.housing_id WHERE r.user_id = :id");
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
            ->setStatus($r['reservation_status'])
            ->setUnavailabilityStart($r['unavailability_start'])
            ->setUnavailabilityEnd($r['unavailability_end']);
        }

        return $reservation;
    }
}