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
            $stmt = $this->db->pdo->prepare("SELECT unavailability_start, unavailability_end FROM housing_unavailability WHERE reservation_id = :id");
            $stmt->execute([
                ":id" => $r['id'],
            ]);
            $newresults = $stmt->fetch(PDO::FETCH_ASSOC);

            $reservation[] = (new ReservationModel())
            ->setId($r['id'])
            ->setUserId($r['user_id'])
            ->setHousingId($r['housing_id'])
            ->setPeriod($r['reservation_period'])
            ->setTotalPrice($r['reservation_total_price'])
            ->setStatus($r['reservation_status'])
            ->setUnavailabilityStart($newresults['unavailability_start'])
            ->setUnavailabilityEnd($newresults['unavailability_end']);
        }

        return $reservation;
    }

    public function deleteReservation(int $user_id, int $reservation_id): void{
        $stmt = $this->db->pdo->prepare("DELETE FROM reservations WHERE user_id = :user_id AND id = :reservation_id");
        $stmt->execute([
            ":user_id" => $user_id,
            ":reservation_id" => $reservation_id
        ]);
    }

    public function updateReservation(int $user_id, ?int $reservation_id, ?string $date_start, ?string $date_end): void{
        $stmt = $this->db->pdo->prepare("UPDATE housing_unavailability AS hu
        INNER JOIN reservations AS r ON hu.reservation_id = r.id
        SET hu.unavailability_start = :new_start_date, hu.unavailability_end = :new_end_date
        WHERE r.id = :reservation_id AND r.user_id = :user_id
        ");
        
        $stmt->bindValue(':new_start_date', $date_start);
        $stmt->bindValue(':new_end_date', $date_end);
        $stmt->bindValue(':reservation_id', $reservation_id);
        $stmt->bindValue(':user_id', $user_id);

        $stmt->execute();
    }

    public function updateReservationPrice(?int $reservation_id, ?int $period, ?int $price): void{
        $stmt = $this->db->pdo->prepare("UPDATE reservations SET reservation_period = :new_period, reservation_total_price = :new_price WHERE id = :reservation_id");
        
        $stmt->bindValue(':new_start_date', $date_start);
        $stmt->bindValue(':new_end_date', $date_end);
        $stmt->bindValue(':reservation_id', $reservation_id);
        $stmt->bindValue(':user_id', $user_id);

        $stmt->execute([
            ":new_period" => $period,
            ":new_price" => ($period * $price),
            ":reservation_id" => $reservation_id,
        ]);
    }

    public function isReservation(int $reservation_id, int $housing_id, string $new_start_date, string $new_end_date): bool{
        $stmt = $this->db->pdo->prepare("SELECT hu.id
        FROM housing_unavailability AS hu
        INNER JOIN reservations AS r ON hu.reservation_id = r.id
        WHERE r.housing_id = :housing_id
        AND r.id != :reservation_id
        AND (
            (hu.unavailability_start <= :new_end_date AND hu.unavailability_end >= :new_start_date)
            OR (hu.unavailability_start <= :new_start_date AND hu.unavailability_end >= :new_start_date)
            OR (hu.unavailability_start >= :new_start_date AND hu.unavailability_end <= :new_end_date)
        )
        LIMIT 1");

        $stmt->execute([
            ":housing_id" => $housing_id,
            ":reservation_id" => $reservation_id,
            ":new_end_date" => $new_end_date,
            ":new_start_date" => $new_start_date
        ]);

        return ($stmt->fetch(PDO::FETCH_ASSOC)) ? true : false;
    }
}