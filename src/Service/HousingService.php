<?php

namespace Service;

use Repository\HousingRepository;
use Model\HousingModel;
use Model\UserModel;

class HousingService {
    private HousingRepository $housingRepository;

    public function __construct() {
        $this->housingRepository = new HousingRepository();
    }

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
            $h->setService($this->housingRepository->selectHousingService($h->getId()));
            $h->setOpinion($this->housingRepository->selectHousingOpinion($h->getId()));
        }

        return $allHousing;
    }

    public function getHousingById(?string $id): ?array{
        $id = intval($id);
        if(!$id || $id <= 0){
            return ["Invalid apartment id", null];
        }
        
        $housing = $this->housingRepository->getHousingById($id);
        if($housing){
            $housing->setImage($this->housingRepository->selectHousingImage($id));
            $housing->setService($this->housingRepository->selectHousingService($id));
            $housing->setOpinion($this->housingRepository->selectHousingOpinion($id));
            return [null, $housing];
        }
        return ["Apartment not found", $housing];
    }

    public function checkDate(?string $dateStart, ?string $dateEnd): array{

        if(strtotime($dateStart) && strtotime($dateEnd) and $dateStart != $dateEnd){
            if (strtotime($dateStart) < time()){
                return ["Departure date not possible", null, strtotime($dateEnd)];
            } elseif (strtotime($dateEnd) < time()){
                return ["Return date not possible", strtotime($dateStart), null];
            }

            if (strtotime($dateStart) > strtotime($dateEnd)){
                return [null, strtotime($dateEnd), strtotime($dateStart)];
            }

            return [null, strtotime($dateStart), strtotime($dateEnd)];
        }

        return ["The dates are invalid", null, null];
    }

    public function checkDistrict(?int $district): array{
        if($district <= 0 || $district > 20){
            return ["The district is invalid", null];
        }
        return [null, $district];
    }

    public function checkNbPiece(?int $nbPiece): array{
        if($nbPiece <= 0){
            return ["The number of piece is invalid", null];
        }
        return [null, $nbPiece];
    }

    public function checkArea(?int $area): array{
        if($area <= 0){
            return ["The area is invalid", null];
        }
        return [null, $area];
    }

    public function getHousingFilter(array $housing, string $key, mixed $value): array{
        $filterHousing = [];
        switch($key){
            case "date":
                $filterHousing = $this->housingRepository->getHousingDateFilter($value['date_start'], $value['date_end']);
                break;
            case "district":
                if($value < 10){
                    $value = '0' . $value;
                }
                $filterHousing = $this->housingRepository->getHousingDistrictFilter($value);
                break;
            case "number_pieces":
                $filterHousing = $this->housingRepository->getHousingNbPieceFilter($value);
                break;
            case "area":
                $filterHousing = $this->housingRepository->getHousingAreaFilter($value);
                break;
        }

        foreach ($filterHousing as $h){
            $h->setImage($this->housingRepository->selectHousingImage($h->getId()));
        }
        $filterHousing = $this->serializeAll($filterHousing);

        $housing = $this->serializeAll($housing);
        $housing = array_intersect($housing, $filterHousing);
        $housing = $this->unserializeAll($housing);
        return $housing;
    }

    public function checkDateDisponibility(?string $dateStart, ?string $dateEnd, ?HousingModel $housing, ?UserModel $user): array{
        if($this->housingRepository->checkHousingDisponibility($dateStart, $dateEnd, $housing->getId())){
            return ["The apartment is not available on the desired dates", null];
        }
        $period = $this->getDateDiff(date("Y-m-d", $dateStart), date("Y-m-d", $dateEnd));

        $this->housingRepository->createHousingReservation($user->getId(), $housing, ["date_start" => date("Y-m-d", $dateStart), "date_end" => date("Y-m-d", $dateEnd), "date_diff" => $period]);
        return [null, "Reservation made successfully"];
    }

    public function deleteHousingById(int $id): void{
        $this->housingRepository->deleteHousingById($id);
    }

    public function selectServices(): array{
        return $this->housingRepository->selectServices();
    }

    public function updateHousing(HousingModel $housing): void{
        $this->housingRepository->updateHousing($housing);
    }

    public function updateHousingLocation(HousingModel $housing): void{
        $this->housingRepository->updateHousingLocation($housing);
    }

    public function updateHousingServices(int $housing_id, array $newServices): void{
        $this->housingRepository->deleteHousingServiceById($housing_id);
        $this->housingRepository->addHousingServiceById($housing_id, $newServices);
    }

    private function serializeAll(array $array): array{
        $tempArray = [];
        foreach ($array as $a){
            $tempArray[] = serialize($a);
        }

        return $tempArray;
    }

    private function unserializeAll(array $array): array{
        $tempArray = [];
        foreach ($array as $a){
            $tempArray[] = unserialize($a);
        }

        return $tempArray;
    }

    private function getDateDiff(string $dateStart, string $dateEnd): int{
        $date1 = new \DateTime($dateStart);
        $date2 = new \DateTime($dateEnd);
        
        return ($date2->diff($date1))->days;
    }
}