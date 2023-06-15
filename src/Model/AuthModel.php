<?php

namespace Model;

use Model\Model;

class AuthModel extends Model{
    /**
     * AuthModel constructor.
     *
     * @param ?int $id Auth id
     * @param ?int $user_id User id from users
     * @param ?string $agent Request agent
     * @param ?string $token Auth token
     * @param ?string $token_start Auth token date start
     * @param ?string $token_end Auth token date end
     */
    public function __construct(
        private ?int $id = null,
        private ?int $user_id = null,
        private ?string $agent = null,
        private ?string $token = null,
        private ?string $token_start = null,
        private ?string $token_end = null,
    ){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->agent = $agent;
        $this->token = $token;
        $this->token_start = $token_start;
        $this->token_end = $token_end;
    }
}