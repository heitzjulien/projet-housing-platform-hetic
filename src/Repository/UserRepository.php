<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

use Model\UserModel;

class UserRepository{
    private Database $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

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
}
