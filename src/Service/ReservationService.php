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
}