<?php

namespace Service;

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
}