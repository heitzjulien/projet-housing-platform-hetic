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

    public function selectHousing($id): array {
        $stmt = $this->db->pdo->prepare("SELECT housing.id, housing.name, housing.capacity, housing.price, housing.description, housing.number_pieces, housing.area,  housing_id, GROUP_CONCAT(housing_images.image) AS images
        FROM housing
        INNER JOIN housing_images ON housing.id = housing_images.housing_id
        WHERE housing.id != :id AND housing_images.housing_id != :id
        GROUP BY housing.id
        ORDER BY RAND()
        LIMIT 5;");
        $stmt->execute([
            "id" => $id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $housing_array = [];
        foreach($results as $r){ 
            $housing_array[] = (new HousingModel())->setId($r['id'])->setName($r['name'])->setCapacity($r['capacity'])->setPrice($r['price'])->setDescription($r['description'])->setNbr_pieces($r['number_pieces'])->setArea($r['area'])->setImages([new HousingImageModel($r['housing_id'], $r['images'])]);
        }
        return $housing_array;
    }

    public function selectImageById($housing_id): array {
        $stmt = $this->db->pdo->prepare("SELECT image, housing_id FROM housing_images WHERE housing_id = :housing_id;");
        $stmt->execute([
            "housing_id" => $housing_id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $images = [];
        foreach($results as $r){
            $images[] = (new HousingModel())->setImages([new HousingImageModel($r['housing_id'], $r['image'])]);
        }
        return $images; 
    }

    // public function selectHousingForHome(): array {
    //     $stmt = $this->db->pdo->prepare("SELECT h.id, h.name, h.price, h.description, h.number_pieces, h.area, MIN(hi.image) AS image, hi.housing_id
    //     FROM housing h
    //     INNER JOIN housing_images hi ON hi.housing_id = h.id
    //     WHERE h.id NOT IN (:id1, :id2, :id3)
    //     GROUP BY h.id
    //     ORDER BY RAND()
    //     LIMIT :limit ;");
    //     $stmt->execute([
    //         "id1" => 5,
    //         "id2" => 6,
    //         "id3" => 7,
    //         "limit" => 3
    //     ]);
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $housings = [];
    //     foreach($results as $r){
    //         $housings[] = new HousingModel($r);
    //     }
    //     return $housings;
    // }

    // public function selectHousingRandomImage(): array {
    //     $stmt = $this->db->pdo->prepare("SELECT housing_id, image FROM housing_images;");       
    //     $stmt->execute();
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $images = [];
    //     foreach($results as $r){
    //         $images[] = new HousingModel($r);
    //     }
    //     return $images;
    // }
}