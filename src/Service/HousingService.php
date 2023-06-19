<?php

namespace Service;

use Repository\HousingRepository;

class HousingService {
    private HousingRepository $housingRepository;

    public function __construct() {
        $this->housingRepository = new HousingRepository();
    }

    // public function selectHousing($id) {
    //     return $this->housingRepository->selectHousing($id);
    // }

    public function selectImageById($housing_id) {
        return $this->housingRepository->selectImageById($housing_id);
    }

    public function selectHousingForSearch(?string $unavailability_start, ?string $unavailability_end, ?string $district, ?int $nbr_rooms, ?int $capacity) {
        return $this->housingRepository->selectHousingForSearch($unavailability_start, $unavailability_end, $district, $nbr_rooms, $capacity);
    }

    public function getRandomImg(int $housingId, int $nbImg): array {
        $img = $this->housingRepository->getRandomImg($housingId, $nbImg);
        return $img;
    }

    public function selectRandomHousing(int $nbImg): array {
        $housing = $this->housingRepository->selectRandomHousing($nbImg);
        foreach ($housing as $h){
            $h->setImage($this->housingRepository->selectHousingImage($h->getId()));
        }

        return $housing;
    }

    public function selectHousing(): array {
        $allHousing = $this->housingRepository->selectHousing();
        foreach ($allHousing as $h){
            $h->setImage($this->housingRepository->selectHousingImage($h->getId()));
        }

        return $allHousing;
    }

    public function checkDate(?string $dateStart, ?string $dateEnd): array{
        if(strtotime($dateStart) && strtotime($dateEnd)){
            if (strtotime($dateStart) < time()){
                return ["Departure date not possible", null, null];
            } elseif (strtotime($dateEnd) < time()){
                return ["Return date not possible", null, null];
            }

            if (strtotime($dateStart) > strtotime($dateEnd)){
                return ['inverse', strtotime($dateEnd), strtotime($dateStart)];
            }

            return ['good', strtotime($dateStart), strtotime($dateEnd)];
        }

        return ["The dates are invalid", null, null];
    }

    public function checkDistrict(?int $district): array{
        if($district <= 0 || $district > 20){
            return ["The district is invalid", null];
        }
        return ["good district", $district];
    }

    public function checkNbPiece(?int $nbPiece): array{
        if($nbPiece <= 0){
            return ["The number of piece is invalid", null];
        }
        return ["good piece", $nbPiece];
    }

    public function checkArea(?int $area): array{
        if($area <= 0){
            return ["The area is invalid", null];
        }
        return ["good area", $area];
    }
}