<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\AuthService;
use Service\ReservationService;
use Service\OpinionService;
use Service\HousingService;
use Service\UserService;

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
        $this->updateStyles(['settings.css']);
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
        $this->updateStyles(['dashboard_card.css', 'reservation.css']);
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

        $this->render("reservation.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "reservation" => $reservation,
            "error" => $error,
            "valid" => $valid,
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
                $opinionService->addOpinion($this->userLoggedIn->getId(), $request->getQueryParams()['id'], $request->getRawBody()['comment']);
                header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/reservation");
                exit;
        }

        $this->render("opinion.php", $this->styles, [
            "route" => $route,
            "request" => $request
        ]);
    }

    public function admin(Request $request, Route $route): void {
        if(!in_array('admin', $this->userLoggedIn->getRoles())){
            header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard");
            exit;
        }
        $this->updateStyles(['dashboard_card.css', 'gestion.css']);
        $users = (new UserService)->selectUsers();
        $error = [];
        $valid = $request->getQueryParams()['update'] ?? null;

        switch($request->getMethod()) {
            case "POST":
                $roles = [
                    "admin" => isset($request->getRawBody()["admin"]), 
                    "management" => isset($request->getRawBody()["management"]), 
                    "maintenance" => isset($request->getRawBody()["maintenance"])];
                [$error[], $accountStatus] = (new UserService)->checkAccountStatus($request->getRawBody()["account_status"] ?? null);

                $error = array_filter($error, function ($value) { return $value; });
                if(!$error && isset($request->getRawBody()["id"])){
                    (new UserService)->updateUser($request->getRawBody()["id"], $roles, $accountStatus);
                    header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/admin?update=valid");
                    exit;
                }
        }

        $this->render("administration.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "valid" => $valid,
            "users" => $users
        ]);
    }

    public function dashboardAppartement(Request $request, Route $route): void{
        if(!in_array('management', $this->userLoggedIn->getRoles())){
            header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard");
            exit;
        }
        $this->updateStyles(['dashboard_card.css', 'reservation.css']);
        $error = [];
        $valid = null;
        $housingService = new HousingService;

        $housing = $housingService->selectHousing();
        
        $this->render("gestionAppartement.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "valid" => $valid,
            "housing" => $housing
        ]);
    }

    public function dashboardAppartementUpdate(Request $request, Route $route): void{
        if(!in_array('management', $this->userLoggedIn->getRoles())){
            header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard");
            exit;
        }
        $this->updateStyles(['dashboard_card.css', 'reservation.css']);
        $error = [];
        $valid = $request->getQueryParams()["update"] ?? null;
        $housingService = new HousingService;

        [$error[], $housing] = $housingService->getHousingById($request->getQueryParams()["id"]);
        $services = $housingService->selectServices();
        switch($request->getMethod()) {
            case "POST":
                switch($request->getRawBody()["table"]) {
                    case "housing":
                        $exterior = [];
                        $exterior[] = $request->getRawBody()["pool"] ?? null;
                        $exterior[] = $request->getRawBody()["terrace"] ?? null;
                        $exterior[] = $request->getRawBody()["garden"] ?? null;
                        $exterior[] = $request->getRawBody()["gym"] ?? null;
                        $exterior = array_filter($exterior, function ($value) { return $value; });
                        $exterior = implode(',', $exterior);
                        $carPark = [];
                        $carPark[] = $request->getRawBody()["garage"] ?? null;
                        $carPark[] = $request->getRawBody()["underground_parking"] ?? null;
                        $carPark[] = $request->getRawBody()["parking_spot"] ?? null;
                        $carPark[] = $request->getRawBody()["covered_parking_space"] ?? null;
                        $carPark = array_filter($carPark, function ($value) { return $value; });
                        $carPark = implode(',', $carPark);
                        $housing
                        ->setName($request->getRawBody()["name"])
                        ->setCapacity($request->getRawBody()["capacity"])
                        ->setPrice($request->getRawBody()["price"])
                        ->setDescription($request->getRawBody()["description"])
                        ->setNote($request->getRawBody()["note"])
                        ->setInstruction($request->getRawBody()["instruction"])
                        ->setNumberPieces($request->getRawBody()["number_pieces"])
                        ->setNumberRooms($request->getRawBody()["number_rooms"])
                        ->setNumberBathroom($request->getRawBody()["number_bathroom"])
                        ->setExterior($exterior)
                        ->setCarPark($carPark)
                        ->setArea($request->getRawBody()["area"]);
                        $housingService->updateHousing($housing);
                        break;
                    case "housing_images":
                        echo("images");
                        break;
                    case "housing_services":
                        $newServices = [];
                        foreach($services as $s){
                            $newServices[] = $request->getRawBody()["service" . $s->getId()] ?? null;
                        }
                        $newServices = array_filter($newServices, function ($value) { return $value; });
                        $housingService->updateHousingServices($housing->getId(), $newServices);
                        break;
                    case "opinions":
                        echo("avis");
                        break;
                    case "housing_location":
                        $housing
                        ->setDistrict($request->getRawBody()["district"])
                        ->setAddress($request->getRawBody()["address"]);
                        $housingService->updateHousingLocation($housing);
                        break;
                }
                header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/appartement/update?id=" . $housing->getId() . "&update=valid");
                exit;
            break;
        }
        
        $error = array_filter($error, function ($value) { return $value; });
        $this->render("updateAppartement.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "valid" => $valid,
            "housing" => $housing,
            "services" => $services
        ]);
    }

    public function dashboardAppartementDelete(Request $request, Route $route): void{
        if(!in_array('management', $this->userLoggedIn->getRoles())){
            header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard");
            exit;
        }
        $housingService = new HousingService;
        $housingService->deleteHousingById($request->getQueryParams()["id"]);

        header("Location: http://localhost/projet-housing-platform-hetic/public/dashboard/appartement");
        exit;
    }
}
