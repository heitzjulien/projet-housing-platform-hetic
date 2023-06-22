<?php

namespace Service;

use Repository\OpinionRepository;
use Model\OpinionModel;


class OpinionService {
    private OpinionRepository $opinionRepository;

    public function __construct() {
        $this->opinionRepository = new OpinionRepository();
    }

    public function selectOpinion(int $id) {
        return $this->opinionRepository->selectOpinion($id);
    }

    public function selectOpinionsByUserId(int $user_id) {
        return $this->opinionRepository->selectOpinionsByUserId($user_id);
    }

    public function addOpinion(int $user_id, int $housing_id, int $reservation_id, string $content, string $display): void {
        $this->opinionRepository->addOpinion($user_id, $housing_id, $reservation_id, $content, $display);
    }
}