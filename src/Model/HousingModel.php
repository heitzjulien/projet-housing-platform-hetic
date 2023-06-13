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
    private string $exterior;
    private string $car_park;
    private int $area;

    public function __construct($id, $name, $capacity, $price, $description, $note, $instruction, $number_pieces, $number_rooms, $number_bathroom, $exterior, $car_park, $area) {
        $this->id = $id;
        $this->name = $name;
        $this->capacity = $capacity;
        $this->price = $price;
        $this->description = $description;
        $this->note = $note;
        $this->instruction = $instruction;
        $this->number_pieces = $number_pieces;
        $this->number_rooms = $number_rooms;
        $this->number_bathroom = $number_bathroom;
        $this->exterior = $exterior;
        $this->car_park = $car_park;
        $this->area = $area;
    }

    public function getId(): int {
        return $this->id;
    }
}