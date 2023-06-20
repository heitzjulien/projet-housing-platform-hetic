<?php

namespace Model;

class ServiceModel {

    /**
     * ServiceModel constructor.
     * 
     * @param ?int $id Service id
     * @param ?string $name Service icon
     * @param ?string $capacity Service name
     * @param ?string $price Service description
     */

    public function __construct(
        private ?int $id = null,
        private ?string $icon = null,
        private ?string $name = null,
        private ?string $description = null,
    ){
        $this->id = $id;
        $this->icon = $icon;
        $this->name = $name;
        $this->description = $description;
    }

    
    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }
    
    public function setIcon(string $icon): self{
        $this->icon = $icon;
        return $this;
    }
    
    public function setName(string $name): self{
        $this->name = $name;
        return $this;
    }
    
    public function setDescription(string $description): self{
        $this->description = $description;
        return $this;
    }
    
    public function getId(): int{
        return $this->id;
    }
    
    public function getIcon(): string{
        return $this->icon;
    }
    
    public function getName(): string{
        return $this->name;
    }
    
    public function getDescription(): string{
        return $this->description;
    }
}