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

    public function setHousingId(int $id): self{
        $this->housing_id = $id;
        return $this;
    }

    public function setImage(string $img): self{
        $this->image = $img;
        return $this;
    }

    public function getImage(): ?string {
        return $this->image;
    }
}