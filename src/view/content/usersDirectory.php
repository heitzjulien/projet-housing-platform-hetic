<?php


use Controller\Controller;
use App\Request;
use Router\Route;

include('gestion.php');



interface PersistencePort {
    public function getAllData();
    public function updateData($data);
    public function addData($data);
}



class MySQLPersistencePort implements PersistencePort {
    private $conn;
    
    
    public function getAllData() {
        $sql = "SELECT user_id, role_subrogation FROM users_admins_extra";
        $result = $this->conn->query($sql);
        
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
    
    public function updateData($data) {
        foreach ($data as $item) {
            $user_id = $item['user_id'];
            $firstname = $item['firstname'];
            $lastname = $item['lastname'];
            $subrogation_role = $item['subrogation_role'];
            
            $sql = "UPDATE users_admins_extra SET nom='$nom', prenom='$prenom', role='$subrogation_role' WHERE id=$user_id";
            $this->conn->query($sql);
        }
        
        return true;
    }
    
    public function addData($data) {
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $subrogation_role = $data['subrogation_role'];
        
        $sql = "INSERT INTO users_admins_extra (firstname, lastname, subrogation_role) VALUES ('$firstname', '$lastname', '$subrogation_role')";
        $this->conn->query($sql);
        
        return true;
    }
    
    public function __destruct() {
        $this->conn->close();
    }
}


interface ApplicationPort {
    public function getAllData();
    public function updateData($data);
    public function addData($data);
}


class Application implements ApplicationPort {
    private $persistencePort;
    
    public function __construct(PersistencePort $persistencePort) {
        $this->persistencePort = $persistencePort;
    }
    
    public function getAllData() {
        return $this->persistencePort->getAllData();
    }
    
    public function updateData($data) {
        return $this->persistencePort->updateData($data);
    }
    
    public function addData($data) {
        return $this->persistencePort->addData($data);
    }
}


$persistencePort = new MySQLPersistencePort($host, $username, $password, $database);
$application = new Application($persistencePort);


$data = $application->getAllData();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $updatedData = array();
        foreach ($data as $item) {
            $user_id = $item['user_id_$id'];
            $firstname = $_POST["firstname_$id"];
            $lastname = $_POST["lastname_$id"];
            $subrogation_role = $_POST["subrogation_role_$id"];
            
            $updatedData[] = array(
                'user_id' => $user_id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'subrogation_role' => $subrogation_role
            );
        }
        
        $application->updateData($updatedData);
        
        
        $data = $application->getAllData();
    } elseif (isset($_POST['add'])) {
        $fistname = $_POST['new_fistname'];
        $prenom = $_POST['new_lastname'];
        $subrogation_role = $_POST['new_subrogation_role'];
        
        $newData = array(
            'fistname' => $fisrtname,
            'lastname' => $lastname,
            'subrogation_role' => $subrogation_role
        );
        
        $application->addData($newData);
        
        
        $data = $application->getAllData();
    }
}
?>
    
