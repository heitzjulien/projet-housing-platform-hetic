<?php 

namespace Repository;

use App\Database;
use PDO;
use PDOException;

// Models
use Model\AuthModel;

class AuthRepository extends Repository{
    public function addToken(int $user_id, string $agent, string $token): void{
        $stmt = $this->db->pdo->prepare("INSERT INTO authentifications (user_id, agent, token, token_start, token_end) VALUES (:user_id, :agent, :token, :token_start, :token_end)");
        $stmt->execute([
            ":user_id" => $user_id,
            ":agent" => $agent,
            ":token" => $token,
            ":token_start" => date("Y-m-d G:i:s", time()),
            ":token_end" => date("Y-m-d G:i:s", time() + (30*24*60*60))
        ]);
    }

    public function getToken(int $user_id, string $agent, string $token): ?AuthModel{
        $stmt = $this->db->pdo->prepare("SELECT id, user_id, agent, token, token_start, token_end FROM authentifications WHERE user_id = :user_id and agent = :agent");
        $stmt->execute([
            ":user_id" => $user_id,
            ":agent" => $agent
        ]);

        $token = $stmt->fetch(PDO::FETCH_ASSOC);
        return new AuthModel(
            $token['id'],
            $token['user_id'],
            $token['agent'],
            $token['token'],
            $token['token_start'],
            $token['token_end'],
        );
        // if(password_verify($token, $token['token'])){
            
        // }
        // return null;
    }

    public function alreadyExist(int $user_id, string $agent): bool{
        $stmt = $this->db->pdo->prepare("SELECT id FROM authentifications WHERE user_id = :user_id and agent = :agent");
        $stmt->execute([
            ":user_id" => $user_id,
            ":agent" => $agent
        ]);

        return ($stmt->fetch(PDO::FETCH_ASSOC)) ? true : false;
    }

    public function deleteToken(int $user_id, string $agent): void{
        $stmt = $this->db->pdo->prepare("DELETE FROM authentifications WHERE user_id = :user_id and agent = :agent");
        $stmt->execute([
            ":user_id" => $user_id,
            ":agent" => $agent
        ]);
    }
}