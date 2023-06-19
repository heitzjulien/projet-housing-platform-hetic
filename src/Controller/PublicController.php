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

        $images = $HousingService->getRandomImg(1, 3);
        $housing = $HousingService->selectRandomHousing(3);

        $this->render("home.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "images" => $images,
            "housing" => $housing
        ]);
    }

    public function search(Request $request, Route $route): void {
        $this->updateStyles(['search.css']);
        $housingService = new HousingService();
        $housing = [];
        $error = [];
        foreach($housingService->selectHousing() as $h) {
            $housing_images = [];
            foreach($h->getImage() as $i){ 
                $housing_images[] = $i->getImage();
            }

            $housing[] = [
                "id" => $h->getId(),
                "name" => $h->getName(),
                "capacity" => $h->getCapacity(),
                "price" => $h->getPrice(),
                "description" => $h->getDescription(),
                "number_pieces" => $h->getNumberPieces(),
                "area" => $h->getArea(), 
                "images" => $housing_images[0]
            ];
        }
        dump($housing);
        dump(json_encode($housing));

        switch($request->getMethod()) {
            case 'POST':
                $error[] = "Il y a une erreur";
                if(!$error){
                    $housing = [];
                    $post = $housingService->selectHousingForSearch($request->getRawBody()['date_start'], $request->getRawBody()['date_end'], ($request->getRawBody()['district'] !== '') ? (int)$request->getRawBody()['district'] : null, ($request->getRawBody()['number_pieces'] !== '') ? (int)$request->getRawBody()['number_pieces'] : null, ($request->getRawBody()['capacity'] !== '') ? (int)$request->getRawBody()['capacity'] : null);
                    foreach($post as $c) {
                        $housing[] = [
                            "id" => $c->getId(),
                            "name" => $c->getName(),
                            "capacity" => $c->getCapacity(),
                            "price" => $c->getPrice(),
                            "description" => $c->getDescription(),
                            "number_pieces" => $c->getNumberPieces(),
                            "area" => $c->getArea(), 
                            "images" => $c->getImage()[0]->getImage()
                        ];
                    }
                }
                break;
        }

        $this->render("search.php", $this->styles, [
            "route" => $route,
            "request" => $request,
            "error" => $error,
            "housing" => $housing,
        ]);
    }

    public function productPage(Request $request, Route $route): void {
        $this->updateStyles(['productPage.css']);
        $HousingService = new HousingService();

        // /!\ SELECTHOUSING
        $content = $HousingService->selectHousingHome();
        
        $this->render("productPage.php", $this->styles, [
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}