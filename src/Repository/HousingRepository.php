<?php

namespace Repository;

use App\Database;
use Model\HousingModel;
use Model\HousingImageModel;
use PDO;
// use PDOException;

class HousingRepository extends Repository{

    public function selectAllHousing(): array {
        $stmt = $this->db->pdo->prepare("SELECT * FROM housing;");
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $housings = [];
        foreach($results as $r){
            $housings[] = new HousingModel($r);
        }
        return $housings;
    }

    // public function selectHousing($id): array {
    //     $stmt = $this->db->pdo->prepare("SELECT housing.id, housing.name, housing.capacity, housing.price, housing.description, housing.number_pieces, housing.area,  housing_id, GROUP_CONCAT(housing_images.image) AS images
    //     FROM housing
    //     INNER JOIN housing_images ON housing.id = housing_images.housing_id
    //     WHERE housing.id != :id AND housing_images.housing_id != :id
    //     GROUP BY housing.id
    //     ORDER BY RAND()
    //     LIMIT 5;");
    //     $stmt->execute([
    //         "id" => $id
    //     ]);
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $housing_array = [];
    //     foreach($results as $r){ 
    //         $house = (new HousingModel())->setId($r['id'])->setName($r['name'])->setCapacity($r['capacity'])->setPrice($r['price'])->setDescription($r['description'])->setNumberPieces($r['number_pieces'])->setArea($r['area']);
    //         $houseImg = [];
    //         foreach(explode(',', $r['images']) as $i) {
    //             $houseImg[] = new HousingImageModel($r['housing_id'], $i);
    //         }
    //         $house->setImage($houseImg);
    //         $housing_array[] = $house;
    //     }
    //     return $housing_array;
    // }

    public function selectImageById($housing_id): array {
        $stmt = $this->db->pdo->prepare("SELECT image, housing_id FROM housing_images WHERE housing_id = :housing_id;");
        $stmt->execute([
            "housing_id" => $housing_id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $images = [];
        foreach($results as $r){
            $images[] = (new HousingModel())->setImage([new HousingImageModel($r['housing_id'], $r['image'])]);
        }
        return $images; 
    }

    public function selectHousingForSearch(?string $unavailability_start, ?string $unavailability_end, ?string $district, ?int $nbr_rooms, ?int $capacity): array {
        $sql = "SELECT h.id, h.name, h.capacity, h.price, h.description, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address, GROUP_CONCAT(housing_images.image) AS images
        FROM housing h
        INNER JOIN housing_location hl ON h.id = hl.housing_id
        INNER JOIN housing_images ON h.id = housing_images.housing_id
        WHERE NOT EXISTS (
            SELECT *
            FROM housing_unavailability u
            WHERE h.id = u.housing_id
            AND (
                (u.unavailability_start <= :unavailability_start AND u.unavailability_end >= :unavailability_end)
                OR (u.unavailability_start >= :unavailability_start AND u.unavailability_end <= :unavailability_end)
            )
        )";
        if (!is_null($district)) {
            $sql .= " AND hl.district = :district";
        }
        if (!is_null($nbr_rooms)) {
            $sql .= " AND h.number_rooms = :nbr_rooms";
        }
        if (!is_null($capacity)) {
            $sql .= " AND h.capacity = :capacity";
        }
        $sql .= " GROUP BY h.id;";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(":unavailability_start", $unavailability_start);
        $stmt->bindValue(":unavailability_end", $unavailability_end);
        if (!is_null($district)) {
            $stmt->bindValue(":district", $district);
        }
        if (!is_null($nbr_rooms)) {
            $stmt->bindValue(":nbr_rooms", $nbr_rooms);
        }
        if (!is_null($capacity)) {
            $stmt->bindValue(":capacity", $capacity);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $housing_array = [];
        foreach ($results as $r) {
            $house = (new HousingModel())->setId($r['id'])->setName($r['name'])->setCapacity($r['capacity'])->setPrice($r['price'])->setDescription($r['description'])->setNumberPieces($r['number_pieces'])->setNumberRooms($r['number_rooms'])->setNumberBathroom($r['number_bathroom'])->setExterior($r['exterior'])->setCarPark($r['car_park'])->setArea($r['area'])->setCountry($r['country'])->setCity($r['city'])->setZip($r['zip'])->setDistrict($r['district'])->setAddress($r['address']);
            $housing_img = [];
            foreach(explode(',', $r['images']) as $i) {
                $housing_img[] = new HousingImageModel($r['id'], $i);
            }
            $house->setImage($housing_img);
            $housing_array[] = $house;
        }
        return $housing_array;
    }

    public function getRandomImg(int $id, int $nb): array{
        $stmt = $this->db->pdo->prepare("SELECT housing_id, image FROM housing_images WHERE housing_id = :id ORDER BY RAND() LIMIT :limit");
        $stmt->bindParam(':limit', $nb, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayImg = [];

        foreach($results as $r){
            $arrayImg[] = new HousingImageModel($r['housing_id'], $r['image']);
        }

        return $arrayImg;
    }

    public function selectRandomHousing(int $nb): array{
        $stmt = $this->db->pdo->prepare("SELECT id, name, capacity, price, description, note, instruction, number_pieces, number_rooms, number_bathroom, exterior, car_park, area FROM housing ORDER BY RAND() LIMIT :limit");
        $stmt->bindParam(':limit', $nb, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area']);
        }

        return $arrayHousing;
    }

    public function selectHousingImage(int $id): array{
        $stmt = $this->db->pdo->prepare("SELECT housing_id, image FROM housing_images WHERE housing_id = :id");
        $stmt->execute([
            ":id" => $id,
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $images = [];
        foreach ($results as $r){
            $images[] = (new HousingImageModel())
            ->setHousingId($r['housing_id'])
            ->setImage($r['image']);
        }

        return $images;
    }

    public function selectHousing(){
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
        }

        return $arrayHousing;
    }

    public function getHousingAreaFilter(string $area): array{
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id WHERE h.area >= :area");
        $stmt->execute([
            "area" => $area
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
        }

        return $arrayHousing;
    }

    public function getHousingNbPieceFilter(string $nbPiece): array{
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id WHERE h.number_pieces >= :number_pieces");
        $stmt->execute([
            "number_pieces" => $nbPiece
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
        }

        return $arrayHousing;
    }

    public function getHousingDistrictFilter(string $district){
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id WHERE hl.district = :district;");
        $stmt->execute([
            "district" => $district
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
        }

        return $arrayHousing;
    }

    public function getHousingDateFilter(string $date_start, string $date_end){
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address
        FROM housing h
        JOIN housing_location hl ON h.id = hl.housing_id
        WHERE NOT EXISTS (
            SELECT 1
            FROM housing_unavailability hu
            WHERE hu.housing_id = h.id
            AND hu.unavailability_start <= :date_end
            AND hu.unavailability_end >= :date_start
        )");
        $stmt->execute([
            ":date_start" => date('Y-m-d', $date_start),
            ":date_end" => date('Y-m-d', $date_end)
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arrayHousing = [];

        foreach ($results as $r){
            $arrayHousing[] = (new HousingModel())
            ->setId($r['id'])
            ->setName($r['name'])
            ->setCapacity($r['capacity'])
            ->setPrice($r['price'])
            ->setDescription($r['description'])
            ->setNote($r['note'])
            ->setInstruction($r['instruction'])
            ->setNumberPieces($r['number_pieces'])
            ->setNumberRooms($r['number_rooms'])
            ->setNumberBathroom($r['number_bathroom'])
            ->setExterior($r['exterior'])
            ->setCarPark($r['car_park'])
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
        }

        return $arrayHousing;
    }
}