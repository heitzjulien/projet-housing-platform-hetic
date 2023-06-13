<?php 

namespace Controller;
use Controller\Controller;
use App\Request;
use Router\Route;

// Services
use Service\RegisterService;

// Model
use Model\UserModel;

class AuthController extends Controller{

    public function register(Request $request, Route $route): void{
        $error = [];
        $firstname = null;
        $lastname = null;
        $mail = null;
        $birthdate = null;
        $password = null;

        switch($request->getMethod()){
            case "POST":
                $registerService = new RegisterService();
                
                // Check Informations
                [$error[], $firstname] = $registerService->checkFirstname($request->getRawBody()['firstname']);
                [$error[], $lastname] = $registerService->checkLastname($request->getRawBody()['lastname']);
                [$error[], $mail] = $registerService->checkMail($request->getRawBody()['mail']);
                [$error[], $birthdate] = $registerService->checkBirthdate($request->getRawBody()['birthdate']);
                [$error[], $password] = $registerService->checkPassword($request->getRawBody()['password'], $request->getRawBody()['confpsd']);
                
                // Clean null indice
                $error = array_filter($error, function ($value) { return $value !== null; });

                if(!$error){
                    // Register a user
                    $user = new UserModel($firstname, $lastname, $mail, $birthdate, $password);
                    $registerService->registerUser($user);
                    header("Location: ./?p=login");
                    exit();
                }
                break;
        }

        $this->updateStyles(['auth.css']);
        $this->render("register.php",  $this->styles ,[
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "newUser" => [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "mail" => $mail,
                "birthdate" => $birthdate
            ]
        ]);
    }

    public function login(Request $request, Route $route): void{
        switch($request->getMethod()){
            case "POST":
                
                break;
        }

        $this->updateStyles(['auth.css']);
        $this->render("login.php",  $this->styles ,[
            "route" => $route,
            "request" => $request
        ]);
    }

}
