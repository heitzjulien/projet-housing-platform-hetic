<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

use Model\UserModel;

class UserRepository extends Repository{
    public function addUser(UserModel $user): void{
        $stmt = $this->db->pdo->prepare("INSERT INTO users (firstname, lastname, mail, password, birthdate) VALUES (:firstname, :lastname, :mail, :password, :birthdate)");
        $stmt->execute([
            ":firstname" => $user->getFirstname(),
            ":lastname" => $user->getLastname(),
            ":mail" => $user->getMail(),
            ":password" => $user->getPassword(),
            ":birthdate" => $user->getBirthdate()
        ]);
    }

    public function mailIsUse(string $mail): bool{
        $stmt = $this->db->pdo->prepare("SELECT id FROM users WHERE mail = :mail");
        $stmt->execute([
            ":mail" => $mail
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    public function getUserByMail(string $mail): UserModel{
        $stmt = $this->db->pdo->prepare("SELECT id, firstname, lastname, mail, password, birthdate, roles, account_date, account_status, last_seen FROM users WHERE mail = :mail");
        $stmt->execute([
            ":mail" => $mail
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return new UserModel(
            $user['id'],
            $user['firstname'],
            $user['lastname'],
            $user['mail'],
            $user['password'],
            $user['birthdate'],
            explode(',', $user['roles']),
            $user['account_date'],
            $user['account_status'],
            $user['last_seen'],
        );
    }

    public function getUserById(int $id): UserModel{
        $stmt = $this->db->pdo->prepare("SELECT id, firstname, lastname, mail, password, birthdate, roles, account_date, account_status, last_seen FROM users WHERE id = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return new UserModel(
            $user['id'],
            $user['firstname'],
            $user['lastname'],
            $user['mail'],
            $user['password'],
            $user['birthdate'],
            explode(',', $user['roles']),
            $user['account_date'],
            $user['account_status'],
            $user['last_seen'],
        );
    }

    public function updateLastSeen(int $id): void{
        $stmt = $this->db->pdo->prepare("UPDATE users SET last_seen = :time WHERE id = :id");
        $stmt->execute([
            ":time" => date("Y-m-d H:i:s", time()),
            ":id" => $id,
        ]);
    }

    public function updateUserInformation(UserModel $user): void{
        $stmt = $this->db->pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail, birthdate = :birthdate WHERE id = :id");
        $stmt->execute([
            ":firstname" => $user->getFirstname(),
            ":lastname" => $user->getLastname(),
            ":mail" => $user->getMail(),
            ":birthdate" => $user->getBirthdate(),
            ":id" => $user->getId(),
        ]);
    }

    public function updateUserPassword(UserModel $user, string $password){
        $stmt = $this->db->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            ":password" => $password,
            ":id" => $user->getId(),
        ]);
    }

    public function updateAccountStatus(int $id, string $status): void{
        $stmt = $this->db->pdo->prepare("UPDATE users SET account_status = :status WHERE id = :id");
        $stmt->execute([
            ":status" => $status,
            ":id" => $id,
        ]);
    }

    public function selectUser(): array{
        $stmt = $this->db->pdo->prepare("SELECT id, firstname, lastname, mail, password, birthdate, roles, account_date, account_status, last_seen FROM users");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach ($results as $r){
            $users[] = new UserModel(
                $r['id'],
                $r['firstname'],
                $r['lastname'],
                $r['mail'],
                $r['password'],
                $r['birthdate'],
                explode(',', $r['roles']),
                $r['account_date'],
                $r['account_status'],
                $r['last_seen'],
            );
        }

        return $users;
    }

    public function updateUser(int $id, string $roles, string $accountStatus): void{
        $stmt = $this->db->pdo->prepare("UPDATE users SET account_status = :account_status, roles = :roles WHERE id = :id");
        $stmt->execute([
            ":account_status" => $accountStatus,
            ":roles" => $roles,
            ":id" => $id,
        ]);
    }
}
