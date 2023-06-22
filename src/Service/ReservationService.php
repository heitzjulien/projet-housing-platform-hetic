<?php

namespace Service;

use Repository\HousingRepository;
use Repository\ReservationRepository;
use Model\ReservationModel;
use Model\UserModel;

class ReservationService {
    private ReservationRepository $reservationRepository;
    
    public function __construct() {
        $this->reservationRepository = new ReservationRepository();
    }

    public function selectReservation(int $id): array{
        $reservation = $this->reservationRepository->selectReservation($id);

        return $reservation;
    }

    public function deleteReservation(int $user_id, int $reservation_id): void{
        $this->reservationRepository->deleteReservation($user_id, $reservation_id);
    }

    public function updateReservation(int $user_id, ?int $reservation_id, ?string $date_start, ?string $date_end, ?int $housing_id): ?string{
        $error = null;
        $housing = (new HousingRepository)->getHousingById($housing_id);
        $error = $this->reservationRepository->isReservation($reservation_id,  $housing_id, $date_start, $date_end);
        if(!$error){
            $this->reservationRepository->updateReservation($user_id, $reservation_id, $date_start, $date_end,  $housing_id);
            $period = $this->getDateDiff(date("Y-m-d", strtotime($date_start)), date("Y-m-d", strtotime($date_end)));
            $this->reservationRepository->updateReservationPrice($reservation_id, $period, $housing->getPrice());
            return null;
        }

        return "Date choisi indisponible";
    }

    private function getDateDiff(string $dateStart, string $dateEnd): int{
        $date1 = new \DateTime($dateStart);
        $date2 = new \DateTime($dateEnd);
        
        return ($date2->diff($date1))->days;
    }
}