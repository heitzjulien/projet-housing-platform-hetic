<?php

namespace Model;

class HousingImageModel {

    /**
     * HousingModel constructor.
     * 
     * @param ?int $housing_id Housing id
     * @param ?string $image Housing image
     */

    public function __construct(
        private ?int $housing_id = null,
        private ?string $image = null,
    ){
        $this->housing_id = $housing_id;
        $this->image = $image;
    }

    public function getImage(): ?string {
        return $this->image;
    }
}