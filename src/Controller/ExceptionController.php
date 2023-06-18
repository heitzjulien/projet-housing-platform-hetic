<?php

namespace Controller;

use Controller\Controller;
use Exception\AbstractException;
use Router\Route;

use Model\UserModel;

class ExceptionController extends Controller{
    private \Exception $error;

    public function __construct(\Exception $error, ?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);
        $this->error = $error;

        http_response_code($error->getCode());

        switch($error->getCode()){
            case "404":
                $this->error404();
                break;
        }
    }

    public function error404(): void{
        $this->updateStyles(['exception.css']);
        
        $this->render($this->error->getViewFile(),  $this->styles ,[
            "route" => (new Route())->setTitle("Error 404"),
            "code" => $this->error->getCode(),
            "message" => $this->error->getMessage(),
        ]);
    }
}