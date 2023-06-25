<?php

namespace Service;

use Repository\UserRepository;
use Model\UserModel;


class UserService {
    public function selectUsers(): array{
        return (new UserRepository)->selectUser();
    }

    public function checkAccountStatus(?string $status): array{
        if($status == 'waiting' || $status == 'valid' || $status == 'disable'){
            return [null, $status];
        }

        return ["Erreur sur le statut du compte...", null];
    }

    public function updateUser(int $id, array $roles, string $accountStatus): void{
        $newRoles = 'client';
        foreach ($roles as $key => $r){
            if($r){
                $newRoles .= ',' . $key;
            }
        }
        (new UserRepository)->updateUser($id, $newRoles, $accountStatus);
    }
}