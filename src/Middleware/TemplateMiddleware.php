<?php

namespace Middleware;

use Middleware\Middleware;

class AuthCheckMiddleware implements Middleware{
    public function __construct(
        private ?int $id = null,
        private ?string $agent = null,
        private ?string $token = null
    ){
        $this->id = $id;
        $this->agent = $agent;
        $this->token = $token;
    }
}
