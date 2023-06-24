<?php

namespace Repository;

use App\Database;
use PDO;
use PDOException;

class UsersDirectoryRepository implements PersistencePort
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAllData()
    {
        $stmt = $this->db->pdo->prepare("SELECT user_id, role_subrogation FROM users_admins_extra");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function updateData($data)
    {
        $stmt = $this->db->pdo->prepare("UPDATE users_admins_extra SET firstname = :firstname, lastname = :lastname, subrogation_role = :subrogation_role WHERE user_id = :user_id");

        foreach ($data as $item) {
            $stmt->bindValue(':user_id', $item['user_id']);
            $stmt->bindValue(':firstname', $item['firstname']);
            $stmt->bindValue(':lastname', $item['lastname']);
            $stmt->bindValue(':subrogation_role', $item['subrogation_role']);
            $stmt->execute();
        }

        return true;
    }

    public function addData($data)
    {
        $stmt = $this->db->pdo->prepare("INSERT INTO users_admins_extra (firstname, lastname, subrogation_role) VALUES (:firstname, :lastname, :subrogation_role)");
        $stmt->bindValue(':firstname', $data['firstname']);
        $stmt->bindValue(':lastname', $data['lastname']);
        $stmt->bindValue(':subrogation_role', $data['subrogation_role']);
        $stmt->execute();

        return true;
    }
}
