<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\AuthService;
use Service\ReservationService;
use Service\OpinionService;
use Service\HousingService;

use Model\UserModel;

class PrivateController extends Controller{

    public function __construct(?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);

        if(!$this->userLoggedIn){
            header("Location:" . __ROOT_URL__ . "/home");
            exit;
        }
    }

    public function dashboard(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'dashboardVotreEspace.css ']);


        $this->render("dashboard.php", $this->styles, [
            "route" => $route,
            "request" => $request
        ]);
    }

    public function dashboardParametre(Request $request, Route $route): void{
        $error = [];
        $valid = null;

        switch($request->getMethod()){
            case "GET":
                $authService = new AuthService();
                if(isset($request->getQueryParams()['action']) == 'sendmail'){
                    $authService->sendMail($this->userLoggedIn->getMail(), $this->userLoggedIn->getFirstname(), $this->userLoggedIn->getLastname());
                }
                if (isset($request->getQueryParams()['action']) && $request->getQueryParams()['action'] == 'valid') {
                    $authService->updateAccountStatus($this->userLoggedIn->getId(), 'valid');
                    header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/parametre");
                }
                if (isset($request->getQueryParams()['action']) && $request->getQueryParams()['action'] == 'disable'){
                    $authService->updateAccountStatus($this->userLoggedIn->getId(), "disable");
                    header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/parametre");
                }
                if (isset($request->getQueryParams()['action']) && $request->getQueryParams()['action'] == 'waiting' && $this->userLoggedIn->getAccountStatus() == 'waiting'){
                    $authService->updateAccountStatus($this->userLoggedIn->getId(), 'valid');
                    header("Location: http://localhost/projet-housing-platform-hetic/public/home?mail=valid");
                }
                if (isset($request->getQueryParams()['action']) && $request->getQueryParams()['action'] == 'waiting' && $this->userLoggedIn->getAccountStatus() != 'waiting'){
                    header("Location: http://localhost/projet-housing-platform-hetic/public/home?mail=error");
                }
                break;
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

    public function dashboardReservation(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'reservation.css ']);
        $error = []; 
        if(isset($request->getQueryParams()['update']) && $request->getQueryParams()['update'] == "valid"){
            $valid = "Modification effectué";
        } else {
            $valid = null;
        };
        $date_start = isset($request->getRawBody()['date_start']);
        $date_end = isset($request->getRawBody()['date_end']);
        $housingService = new HousingService;

        $reservation = (new ReservationService)->selectReservation($this->userLoggedIn->getId());
        foreach($reservation as $r){
            [$temp, $housing] = $housingService->getHousingById($r->getHousingId());
            $r->setHousing($housing);
        }

        switch($request->getMethod()){
            case "POST":
                [$error[], $date_start, $date_end] = $housingService->checkDate($request->getRawBody()['date_start'], $request->getRawBody()['date_end']);
                $error = array_filter($error, function ($value) { return $value; });
                if(!$error && isset($request->getRawBody()['reservation_id']) && isset($request->getRawBody()['housing_id'])){
                    $error[] = (new ReservationService)->updateReservation($this->userLoggedIn->getId(), $request->getRawBody()['reservation_id'], date("Y-m-d", $date_start), date("Y-m-d", $date_end), $request->getRawBody()['housing_id']);
                    $error = array_filter($error, function ($value) { return $value; });
                    if(!$error){
                        header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/reservation?update=valid");
                        exit;
                    }
                }
                break;
        }

        // A CHANGER DE PAGE
        // $opinionService = new OpinionService();
        // $content = $opinionService->selectOpinionsByUserId($this->userLoggedIn->getId());

        $this->render("reservation.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "reservation" => $reservation,
            "error" => $error,
            "valid" => $valid,
            // "start" => $content,
        ]);
    }

    public function dashboardReservationDelete(Request $request, Route $route): void{
        $reservationId = $request->getQueryParams()['id'] ?? null;

        if($reservationId){
            (new ReservationService)->deleteReservation($this->userLoggedIn->getId(), $reservationId);
        }

        header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/reservation");
        exit;
    }

    public function gestion(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'gestion.css ']);

        $this->render("gestion.php", $this->styles, [
            "route" => $route,
            "request" => $request
        ]);
    }

    public function opinion(Request $request, Route $route): void {
        $this->updateStyles(['dashboard_card.css', 'opinion.css ']);
        switch($request->getMethod()) {
            case "POST":
                $opinionService = new OpinionService();
                $opinionService->addOpinion($this->userLoggedIn->getId(), $request->getQueryParams()['reservation_id'], $request->getRawBody()['comment']);
                header("Location: http://localhost/projet-housing-platform-hetic/public/opinion");
                exit;
        }

        $this->render("opinion.php", $this->styles, [
            "route" => $route,
            "request" => $request
        ]);
    }
}
