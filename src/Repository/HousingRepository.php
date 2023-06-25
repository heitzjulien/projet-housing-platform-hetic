<?php

namespace Repository;

use App\Database;
use Model\HousingModel;
use Model\HousingImageModel;
use Model\ServiceModel;
use Model\OpinionModel;
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

    public function selectHousingService(int $id): array{
        $stmt = $this->db->pdo->prepare("SELECT s.id, s.icon, s.name, s.description FROM services s JOIN housing_services hs ON s.id = hs.service_id WHERE hs.housing_id = :id");
        $stmt->execute([
            ":id" => $id,
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $services = [];
        foreach ($results as $r){
            $services[] = (new ServiceModel())
            ->setId($r['id'])
            ->setIcon($r['icon'])
            ->setName($r['name'])
            ->setDescription($r['description']);
        }

        return $services;
    }

    public function selectServices(): array{
        $stmt = $this->db->pdo->prepare("SELECT id, icon, name, description FROM services");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $services = [];
        foreach ($results as $r){
            $services[] = (new ServiceModel())
            ->setId($r['id'])
            ->setIcon($r['icon'])
            ->setName($r['name'])
            ->setDescription($r['description']);
        }

        return $services;
    }

    public function selectHousingOpinion(int $id): array{
        $stmt = $this->db->pdo->prepare("SELECT o.id, o.user_id, o.reservation_id, o.content, o.display
        FROM opinions o
        JOIN reservations r ON o.reservation_id = r.id
        WHERE r.housing_id = :id");
        $stmt->execute([
            ":id" => $id,
        ]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];
        foreach ($results as $r){
            $opinions[] = (new OpinionModel())
            ->setId($r['id'])
            ->setUserId($r['user_id'])
            ->setReservationId($r['reservation_id'])
            ->setContent($r['content'])
            ->setDisplay($r['display']);
        }

        return $opinions;
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
            ->setAddress($r['address'])
            ->setOpinion($this->selectHousingOpinion($r['id']))
            ->setService($this->selectHousingService($r['id']));
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
            ->setAddress($r['address'])
            ->setOpinion($this->selectHousingOpinion($r['id']))
            ->setService($this->selectHousingService($r['id']));
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
            ->setAddress($r['address'])
            ->setOpinion($this->selectHousingOpinion($r['id']))
            ->setService($this->selectHousingService($r['id']));
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
            ->setAddress($r['address'])
            ->setOpinion($this->selectHousingOpinion($r['id']))
            ->setService($this->selectHousingService($r['id']));
        }

        return $arrayHousing;
    }

    public function checkHousingDisponibility(string $date_start, string $date_end, int $id): bool{
        $stmt = $this->db->pdo->prepare("SELECT h.id FROM housing h
        WHERE EXISTS (
            SELECT 1
            FROM housing_unavailability hu
            WHERE hu.housing_id = h.id
            AND hu.unavailability_start <= :date_end
            AND hu.unavailability_end >= :date_start
            AND hu.housing_id = :housing_id
        )");
        $stmt->execute([
            ":date_start" => date('Y-m-d', $date_start),
            ":date_end" => date('Y-m-d', $date_end),
            ":housing_id" => $id
        ]);

        return ($stmt->fetchAll(PDO::FETCH_ASSOC)) ? true : false;
    }

    public function createHousingReservation(int $user_id, HousingModel $housing, array $period): void{
        $stmt = $this->db->pdo->prepare("INSERT INTO reservations (user_id, housing_id, reservation_period, reservation_total_price) VALUES (:user_id, :housing_id, :reservation_period, :reservation_total_price)");
        $stmt->execute([
            ":user_id" => $user_id,
            ":housing_id" => $housing->getId(),
            ":reservation_period" => $period["date_diff"],
            ":reservation_total_price" => $period["date_diff"] * $housing->getPrice(),
        ]);
        $reservationId = $this->db->pdo->lastInsertId();
        
        $stmt = $this->db->pdo->prepare("INSERT INTO housing_unavailability (housing_id, unavailability_start, unavailability_end, unavailability_status, reservation_id) VALUES (:housing_id, :unavailability_start, :unavailability_end, :unavailability_status, :reservation_id)");
        $stmt->execute([
            ":housing_id" => $housing->getId(),
            ":unavailability_start" => $period["date_start"],
            ":unavailability_end" => $period["date_end"],
            ":unavailability_status" => 'booked',
            ":reservation_id" => $reservationId
        ]);        
    }

    public function deleteHousingById(int $id): void{
        $stmt = $this->db->pdo->prepare("DELETE FROM housing WHERE id = :id");
        $stmt->execute([
            "id" => $id
        ]);
    }
}