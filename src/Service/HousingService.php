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

    // public function selectHousingImage() {
    //     return $this->housingRepository->selectHousingImage();
    // }

    public function selectHousingRandomImage() {
        return $this->housingRepository->selectHousingRandomImage();
    }

    public function selectHousing($id) {
        return $this->housingRepository->selectHousing($id);
    }

    public function selectImageById($housing_id) {
        return $this->housingRepository->selectImageById($housing_id);
    }
}