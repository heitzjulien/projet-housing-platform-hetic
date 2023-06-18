<?php

namespace Service;

use Repository\HousingRepository;

class HousingService {
    private HousingRepository $housingRepository;

    public function __construct() {
        $this->housingRepository = new HousingRepository();
    }

    public function selectHousing($id) {
        return $this->housingRepository->selectHousing($id);
    }

    public function selectImageById($housing_id) {
        return $this->housingRepository->selectImageById($housing_id);
    }

    public function selectHousingForSearch(?string $unavailability_start, ?string $unavailability_end, ?string $district, ?int $nbr_rooms, ?int $capacity) {
        return $this->housingRepository->selectHousingForSearch($unavailability_start, $unavailability_end, $district, $nbr_rooms, $capacity);
    }
}