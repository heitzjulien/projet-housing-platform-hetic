<?php

namespace Model;

class HousingModel {
    private int $id;
    private string $name;
    private int $capacity;
    private int $price;
    private string $description;
    private string $note;
    private string $instruction;
    private int $number_pieces;
    private int $number_rooms;
    private int $number_bathroom;
    private ?string $exterior;
    private ?string $car_park;
    private int $area;

    public function __construct(array $contents) {
        $this->id = $contents["id"];
        $this->name = $contents["name"];
        $this->capacity = $contents["capacity"];
        $this->price = $contents["price"];
        $this->description = $contents["description"];
        $this->note = $contents["note"];
        $this->instruction = $contents["instruction"];
        $this->number_pieces = $contents["number_pieces"];
        $this->number_rooms = $contents["number_rooms"];
        $this->number_bathroom = $contents["number_bathroom"];
        $this->exterior = $contents["exterior"];
        $this->car_park = $contents["car_park"];
        $this->area = $contents["area"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCapacity(): int {
        return $this->capacity;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getNote(): string {
        return $this->note;
    }

    public function getInstruction(): string {
        return $this->instruction;
    }

    public function getNumberPieces(): int {
        return $this->number_pieces;
    }

    public function getNumberRooms(): int {
        return $this->number_rooms;
    }

    public function getNumberBathroom(): int {
        return $this->number_bathroom;
    }

    public function getExterior(): ?string {
        return $this->exterior;
    }

    public function getCarPark(): ?string {
        return $this->car_park;
    }

    public function getArea(): int {
        return $this->area;
    }
}