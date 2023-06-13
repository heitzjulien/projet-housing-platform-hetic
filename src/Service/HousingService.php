<?php

namespace Service;

use Repository\HousingRepository;

class HousingService {
    private HousingRepository $housingRepository;

    public function __construct() {
        $this->housingRepository = new HousingRepository();
    }

    public function selectHousing() {
        return $this->housingRepository->selectAllHousing();
    }
}