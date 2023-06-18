<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\AuthService;


class PrivateController extends Controller{
    public function __construct() {
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
        
        if(!$this->userLoggedIn){
            header("Location:" . __ROOT_URL__ . "/home");
            exit;
        }

        switch($request->getMethod()){
            case "POST":
                $authService = new AuthService();
                $amen = false;
                // Check Informations
                if(isset($request->getRawBody()['firstname'])){
                    if ($request->getRawBody()['firstname'] != $this->userLoggedIn->getFirstname()){ 
                        [$error[], $firstname] = $authService->checkFirstname($request->getRawBody()['firstname']);
                        $this->userLoggedIn->setFirstname($firstname);
                        $amen = true;
                    }
                    if ($request->getRawBody()['lastname'] != $this->userLoggedIn->getLastname()){ 
                        [$error[], $lastname] = $authService->checkLastname($request->getRawBody()['lastname']);
                        $this->userLoggedIn->setLastname($lastname);
                        $amen = true;
                    }
                    if ($request->getRawBody()['mail'] != $this->userLoggedIn->getMail()){ 
                        [$error[], $mail] = $authService->checkMail($request->getRawBody()['mail'], 'register'); 
                        $this->userLoggedIn->setMail($mail);
                        $amen = true;
                    }
                    if ($request->getRawBody()['birthdate'] != $this->userLoggedIn->getBirthdate()){ 
                        [$error[], $birthdate] = $authService->checkBirthdate($request->getRawBody()['birthdate']);
                        $this->userLoggedIn->setBirthdate($birthdate);
                        $amen = true;
                    }

                    $error = array_filter($error, function ($value) { return $value; });
                    if(!$error && $amen){                        
                        echo('test2');
                        $authService->updateUser($this->userLoggedIn);
                    }
                }
                if(isset($request->getRawBody()['newPsd'])){
                    $error[] = $authService->verifyPassword($user->getMail(), $request->getRawBody()['currentPsd']);
                    [$error[], $password] = $authService->checkPasswords($request->getRawBody()['newPsd'], $request->getRawBody()['confNewPsd']);

                    $error = array_filter($error, function ($value) { return $value; });
                    if(!$error){
                        echo('je fais les changements');
                    }
                }

                // Clean array (false indice)
                $error = array_filter($error, function ($value) { return $value; });

                break; 
        }
        
        $this->render("settings.php", $this->styles, [
            // "start" => $content,
            "route" => $route,
            "request" => $request,
            "error" => $error,
        ]);
    }
    
}