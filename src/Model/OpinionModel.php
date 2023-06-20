<?php

namespace Model;

class OpinionModel {

    /**
     * OpinionModel constructor.
     * 
     * @param ?int $id Opinion id
     * @param ?int $user_id User id
     * @param ?int $housing_id Housing id
     * @param ?int $reservation_id Reservation id
     * @param ?string $content Opinion content
     * @param ?string $display Opinion display
     */

    public function __construct(
        private ?int $id = null,
        private ?int $user_id = null,
        private ?int $housing_id = null,
        private ?int $reservation_id = null,
        private ?string $content = null,
        private ?string $display = null,
    ){
        
        $this->id = $id;
        $this->user_id = $user_id;
        $this->housing_id = $housing_id;
        $this->reservation_id = $reservation_id;
        $this->content = $content;
        $this->display = $display;
    }

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    public function setUserId(int $user_id): self{
        $this->user_id = $user_id;
        return $this;
    }

    public function setHousingId(int $housing_id): self{
        $this->housing_id = $housing_id;
        return $this;
    }

    public function setReservationId(int $reservation_id): self{
        $this->reservation_id = $reservation_id;
        return $this;
    }

    public function setContent(string $content): self{
        $this->content = $content;
        return $this;
    }

    public function setDisplay(string $display): self{
        $this->display = $display;
        return $this;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getUserId(): int{
        return $this->user_id;
    }
    public function getHousingId(): int{
        return $this->housing_id;
    }
    public function getReservationId(): int{
        return $this->reservation_id;
    }
    public function getContent(): string{
        return $this->content;
    }
    public function getDisplay(): string{
        return $this->display;
    }
}