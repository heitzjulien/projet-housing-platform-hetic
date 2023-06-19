<?php

namespace Model;

class HousingModel {

    /**
     * HousingModel constructor.
     * 
     * @param ?int $id Housing id
     * @param ?string $name Housing name
     * @param ?int $capacity Housing capacity
     * @param ?int $price Housing price
     * @param ?string $description Housing description
     * @param ?string $note Housing note
     * @param ?string $instruction Housing instruction
     * @param ?int $number_pieces Housing number pieces
     * @param ?int $number_rooms Housing number rooms
     * @param ?int $number_bathroom Housing number bathroom
     * @param ?array $exterior Housing exterior
     * @param ?array $car_park Housing car park
     * @param ?int $area Housing area
     * @param ?string $image Housing image
     */

    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?int $capacity = null,
        private ?int $price = null,
        private ?string $description = null,
        private ?string $note = null,
        private ?string $instruction = null,
        private ?int $number_pieces = null,
        private ?int $number_rooms = null,
        private ?int $number_bathroom = null,
        private ?array $exterior = null,
        private ?array $car_park = null,
        private ?int $area = null,
        private ?array $image = null,
        private ?string $country = null,
        private ?string $city = null,
        private ?string $zip = null,
        private ?string $district = null,
        private ?string $address = null
    ){
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
        $this->image = $image;
        $this->country = $country;
        $this->city = $city;
        $this->zip = $zip;
        $this->district = $district;
        $this->address = $address;
    }

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }
    
    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }

    public function setCapacity(int $capacity): self{
        $this->capacity = $capacity;
        return $this;
    }

    public function setPrice(int $price): self{
        $this->price = $price;
        return $this;
    }

    public function setDescription(string $description): self{
        $this->description = $description;
        return $this;
    }

    public function setNote(string $note): self{
        $this->note = $note;
        return $this;
    }

    public function setInstruction(string $instruction): self{
        $this->instruction = $instruction;
        return $this;
    }

    public function setNumberPieces(int $number_pieces): self{
        $this->number_pieces = $number_pieces;
        return $this;
    }

    public function setNumberRooms(int $number_rooms): self{
        $this->number_rooms = $number_rooms;
        return $this;
    }

    public function setNumberBathroom(int $number_bathroom): self{
        $this->number_bathroom = $number_bathroom;
        return $this;
    }

    public function setExterior(?string $exterior): self{
        if($exterior){
            $this->exterior = explode(',', $exterior);
        }
        return $this;
    }

    public function setCarPark(?string $car_park): self{
        if($car_park){
            $this->car_park = explode(',', $car_park);
        }
        return $this;
    }

    public function setArea(int $area): self{
        $this->area = $area;
        return $this;
    }

    public function setImage(array $image): self{
        $this->image = $image;
        return $this;
    }

    public function setCountry(string $country): self{
        $this->country = $country;
        return $this;
    }

    public function setCity(string $city): self{
        $this->city = $city;
        return $this;
    }

    public function setZip(string $zip): self{
        $this->zip = $zip;
        return $this;
    }

    public function setDistrict(string $district): self{
        $this->district = $district;
        return $this;
    }

    public function setAddress(string $address): self{
        $this->address = $address;
        return $this;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getName(): ?string{
        return $this->name;
    }

    public function getCapacity(): ?int{
        return $this->capacity;
    }

    public function getPrice(): ?int{
        return $this->price;
    }

    public function getDescription(): ?string{
        return $this->description;
    }

    public function getNote(): ?string{
        return $this->note;
    }

    public function getInstruction(): ?string{
        return $this->instruction;
    }

    public function getNumberPieces(): ?int{
        return $this->number_pieces;
    }

    public function getNumberRooms(): int{
        return $this->number_rooms;
    }

    public function getNumberBathroom(): int{
        return $this->number_bathroom;
    }

    public function getExterior(): ?array{
        return $this->exterior;
    }

    public function getCarPark(): ?array{
        return $this->car_park;
    }

    public function getArea(): ?int{
        return $this->area;
    }

    public function getImage(): ?array{
        return $this->image;
    }

    public function getCountry(): ?string{
        return $this->country;
    }

    public function getCity(): ?string{
        return $this->city;
    }

    public function getZip(): ?string{
        return $this->zip;
    }

    public function getDistrict(): ?string{
        return $this->district;
    }

    public function getAddress(): ?string{
        return $this->address;
    }
}