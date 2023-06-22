<?php

namespace Model;

use Model\PersistencePort;
use Model\MySQLPersistencePort;

class ApplicationModel {
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
    
    public function getPersistencePort(): PersistencePort {
        return $this->persistencePort;
    }
    
    public function setPersistencePort(PersistencePort $persistencePort): void {
        $this->persistencePort = $persistencePort;
    }
}

$persistencePort = new MySQLPersistencePort($host, $username, $password, $database);
$model = new ApplicationModel($persistencePort);

$data = $model->getAllData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $updatedData = array();
        foreach ($data as $item) {
            $user_id = $item['user_id'];
            $firstname = $_POST["firstname_$user_id"];
            $lastname = $_POST["lastname_$user_id"];
            $subrogation_role = $_POST["subrogation_role_$user_id"];
            
            $updatedData[] = array(
                'user_id' => $user_id,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'subrogation_role' => $subrogation_role
            );
        }
        
        $model->updateData($updatedData);
        
        $data = $model->getAllData();
    } elseif (isset($_POST['add'])) {
        $firstname = $_POST['new_firstname'];
        $lastname = $_POST['new_lastname'];
        $subrogation_role = $_POST['new_subrogation_role'];
        
        $newData = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'subrogation_role' => $subrogation_role
        );
        
        $model->addData($newData);
        
        $data = $model->getAllData();
    }
}
