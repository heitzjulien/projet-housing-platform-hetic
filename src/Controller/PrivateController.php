<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\AuthService;

use Model\UserModel;


class PrivateController extends Controller{
    public function __construct(?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);
    }

    public function dashboardClient(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

        // $content = $this->templateService->selectContent();

        $this->render("dashboardVotreEspace.php", $this->styles, [
            // "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function dashboardAdmin(Request $request, Route $route): void{
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

        // $content = $this->templateService->selectContent();

        $this->render("dashboardAdmin.php", $this->styles, [
                        // "start" => $content,
                        "route" => $route,
                        "request" => $request
        ]);
    }

    public function dashboardUserParametre(Request $request, Route $route): void{
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);

            // $content = $this->templateService->selectContent();

            $this->render("dashboardParametre.php", $this->styles, [
                // "start" => $content,
                "route" => $route,
                "request" => $request
    ]);
    }

    public function dashboardParametre(Request $request, Route $route): void{
        $error = [];
        $valid = null;
        
        if(!$this->userLoggedIn){
            header("Location:" . __ROOT_URL__ . "/home");
            exit;
        }

        switch($request->getMethod()){
            case "POST":
                $authService = new AuthService();
                $change = false;
                // Check Informations
                if(isset($request->getRawBody()['firstname'])){
                    if ($request->getRawBody()['firstname'] != $this->userLoggedIn->getFirstname()){ 
                        [$error[], $firstname] = $authService->checkFirstname($request->getRawBody()['firstname']);
                        if ($firstname){ $this->userLoggedIn->setFirstname($firstname); }
                        $change = true;
                    }
                    if ($request->getRawBody()['lastname'] != $this->userLoggedIn->getLastname()){ 
                        [$error[], $lastname] = $authService->checkLastname($request->getRawBody()['lastname']);
                        if ($lastname){ $this->userLoggedIn->setLastname($lastname); }
                        $change = true;
                    }
                    if ($request->getRawBody()['mail'] != $this->userLoggedIn->getMail()){ 
                        [$error[], $mail] = $authService->checkMail($request->getRawBody()['mail'], 'register'); 
                        if ($mail){ $this->userLoggedIn->setMail($mail); }
                        $change = true;
                    }
                    if ($request->getRawBody()['birthdate'] != $this->userLoggedIn->getBirthdate()){ 
                        [$error[], $birthdate] = $authService->checkBirthdate($request->getRawBody()['birthdate']);
                        if ($birthdate){ $this->userLoggedIn->setBirthdate($birthdate); }
                        $change = true;
                    }

                    $error = array_filter($error, function ($value) { return $value; });
                    if(!$error && $change){                        
                        $authService->updateUser($this->userLoggedIn);
                        $valid = "The information has been successfully modified";
                    }
                }

                if(isset($request->getRawBody()['currentPsd'])){
                    $error[] = $authService->verifyPassword($this->userLoggedIn->getMail(), $request->getRawBody()['currentPsd']);
                    [$error[], $password] = $authService->checkPasswords($request->getRawBody()['newPsd'], $request->getRawBody()['confNewPsd']);

                    $error = array_filter($error, function ($value) { return $value; });
                    if(!$error){
                        $authService->updateUser($this->userLoggedIn, $password);
                        $valid = "Password changed successfully";
                    }
                }
                
                break; 
        }
        
        $this->render("settings.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "valid" => $valid,
        ]);
    }
    
}
