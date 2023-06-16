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
            ":time" => date("Y-m-d G:i:s", time()),
            ":id" => $id,
        ]);
    }
}
