<?php

namespace Service;

use Repository\HousingRepository;

class HousingService {
    private HousingRepository $housingRepository;

    public function __construct() {
        $this->housingRepository = new HousingRepository();
    }

    public function selectHousingHome() {
        return $this->housingRepository->selectHousingForHome();
    }
}