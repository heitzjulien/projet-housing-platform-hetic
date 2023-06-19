<?php

namespace Repository;

use App\Database;
use Model\HousingModel;
use Model\HousingImageModel;
use PDO;
// use PDOException;

class HousingRepository extends Repository{

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
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id ORDER BY RAND() LIMIT :limit");
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
            ->setArea($r['area'])
            ->setCountry($r['country'])
            ->setCity($r['city'])
            ->setZip($r['zip'])
            ->setDistrict($r['district'])
            ->setAddress($r['address']);
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

    public function getHousingById(string $id): ?HousingModel{
        $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.capacity, h.price, h.description, h.note, h.instruction, h.number_pieces, h.number_rooms, h.number_bathroom, h.exterior, h.car_park, h.area, hl.country, hl.city, hl.zip, hl.district, hl.address FROM housing h JOIN housing_location hl ON h.id = hl.housing_id WHERE h.id = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if($results){
            return (new HousingModel())
                ->setId($results['id'])
                ->setName($results['name'])
                ->setCapacity($results['capacity'])
                ->setPrice($results['price'])
                ->setDescription($results['description'])
                ->setNote($results['note'])
                ->setInstruction($results['instruction'])
                ->setNumberPieces($results['number_pieces'])
                ->setNumberRooms($results['number_rooms'])
                ->setNumberBathroom($results['number_bathroom'])
                ->setExterior($results['exterior'])
                ->setCarPark($results['car_park'])
                ->setArea($results['area'])
                ->setCountry($results['country'])
                ->setCity($results['city'])
                ->setZip($results['zip'])
                ->setDistrict($results['district'])
                ->setAddress($results['address']);
        }

        return null;
    }

    public function selectHousing(): array{
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

    public function getHousingDistrictFilter(string $district): array{
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

    public function getHousingDateFilter(string $date_start, string $date_end): array{
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