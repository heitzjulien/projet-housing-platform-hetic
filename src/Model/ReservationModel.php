<?php

namespace Model;

class ReservationModel {

    /**
     * HousingModel constructor.
     * 
     * @param ?int $id Reservation id
     * @param ?int $user_id User id
     * @param ?int $housing_id Housing id
     * @param ?int $reservation_period Reservation period
     * @param ?int $reservation_total_price Reservation total price
     * @param ?string $reservation_status Reservation status
     */

    public function __construct(
        private ?int $id = null,
        private ?int $user_id = null,
        private ?int $housing_id = null,
        private ?int $reservation_period = null,
        private ?int $reservation_total_price = null,
        private ?string $reservation_status = null,
    ){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->housing_id = $housing_id;
        $this->reservation_period = $reservation_period;
        $this->reservation_total_price = $reservation_total_price;
        $this->reservation_status = $reservation_status;
    }

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function setUserId(int $user_id): self{
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserId(): ?int{
        return $this->user_id;
    }

    public function setHousingId(int $housing_id): self{
        $this->housing_id = $housing_id;
        return $this;
    }

    public function getHousingId(): ?int{
        return $this->housing_id;
    }

    public function setPeriod(int $reservation_period): self{
        $this->reservation_period = $reservation_period;
        return $this;
    }

    public function getPeriod(): ?int{
        return $this->reservation_period;
    }

    public function setTotalPrice(int $reservation_total_price): self{
        $this->reservation_total_price = $reservation_total_price;
        return $this;
    }

    public function getTotalPrice(): ?int{
        return $this->reservation_total_price;
    }

    public function setStatus(string $reservation_status): self{
        $this->reservation_status = $reservation_status;
        return $this;
    }

    public function getStatus(): ?string{
        return $this->reservation_status;
    }
}