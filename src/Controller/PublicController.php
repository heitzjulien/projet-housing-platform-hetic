<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\HousingService;

use Model\UserModel;

class PublicController extends Controller {
    public function __construct(?UserModel $userLoggedIn){
        parent::__construct($userLoggedIn);
    }

    public function home(Request $request, Route $route): void {
        $this->updateStyles(['home.css']);
        $HousingService = new HousingService();

        $content = $HousingService->selectHousing(1);
        $images = $HousingService->selectImageById(1);
        $json = [];
        foreach($content as $c) {
            $json[] = json_encode([ 
                "id" => $c->getId(),
                "name" => $c->getName(),
                "capacity" => $c->getCapacity(),
                "price" => $c->getPrice(),
                "description" => $c->getDescription(),
                "number_pieces" => $c->getNumberPieces(),
                "area" => $c->getArea(),
                "images" => $c->getImage()[0]->getImage(),
                "test" => $c->getName() . " " . $c->getNumberPieces() . "pièces " . $c->getArea() . "m²"
            ]);
        }
        $this->render("home.php", $this->styles, [
            "images" => $images,
            "start" => $content,
            "json" => $json,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function search(Request $request, Route $route): void {
        $this->updateStyles(['search.css']);
        $json = []
        $HousingService = new HousingService();

        switch($request->getMethod()) {
            case 'GET':
                $get = $HousingService->selectHousing(0);
                foreach($get as $c) {
                    $json[] = json_encode([
                        "id" => $c->getId(),
                        "name" => $c->getName(),
                        "capacity" => $c->getCapacity(),
                        "price" => $c->getPrice(),
                        "description" => $c->getDescription(),
                        "number_pieces" => $c->getNumberPieces(),
                        "area" => $c->getArea(), 
                        "images" => $c->getImage()[0]->getImage()
                    ]);
                }
                break;
            case 'POST':
                $post = $HousingService->selectHousingForSearch($request->getRawBody()['date_start'], $request->getRawBody()['date_end'], ($request->getRawBody()['district'] !== '') ? (int)$request->getRawBody()['district'] : null, ($request->getRawBody()['number_pieces'] !== '') ? (int)$request->getRawBody()['number_pieces'] : null, ($request->getRawBody()['capacity'] !== '') ? (int)$request->getRawBody()['capacity'] : null);
                foreach($post as $c) {
                    $json[] = json_encode([
                        "id" => $c->getId(),
                        "name" => $c->getName(),
                        "capacity" => $c->getCapacity(),
                        "price" => $c->getPrice(),
                        "description" => $c->getDescription(),
                        "number_pieces" => $c->getNumberPieces(),
                        "area" => $c->getArea(), 
                        "images" => $c->getImage()[0]->getImage()
                    ]);
                }
                break;
        }
        $this->render("search.php", $this->styles, [
            "json" => $json,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function productPage(Request $request, Route $route): void {
        $this->updateStyles(['productPage.css']);
        $HousingService = new HousingService();

        $content = $HousingService->selectHousingHome();
        
        $this->render("productPage.php", $this->styles, [
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}