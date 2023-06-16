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
     * @param ?string $exterior Housing exterior
     * @param ?string $car_park Housing car park
     * @param ?int $area Housing area
     * @param ?string $image Housing image
     * @param ?int $housing_id Housing id
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
        private ?string $exterior = null,
        private ?string $car_park = null,
        private ?int $area = null,
        private ?array $image = null,
        private ?int $housing_id = null,
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
        $this->housing_id = $housing_id;
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

    public function setNbr_pieces(int $number_pieces): self{
        $this->number_pieces = $number_pieces;
        return $this;
    }

    public function setArea(int $area): self{
        $this->area = $area;
        return $this;
    }

    public function setImages(array $image): self{
        $this->image = $image;
        return $this;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getCapacity(): int{
        return $this->capacity;
    }

    public function getPrice(): int{
        return $this->price;
    }

    public function getDescription(): string{
        return $this->description;
    }

    public function getNbr_pieces(): int{
        return $this->number_pieces;
    }

    public function getArea(): int{
        return $this->area;
    }

    public function getImages(): array{
        return $this->image;
    }

}