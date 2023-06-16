<?php

namespace Controller;

use Controller\Controller;
use App\Request;
use Router\Route;

use Service\HousingService;

class PublicController extends Controller {
    private HousingService $HousingService;
    public function __construct() {
        $this->HousingService = new HousingService();
    }

    public function home(Request $request, Route $route): void {
        $this->updateStyles(['home.css']);

        $content = $this->HousingService->selectHousing(1);
        $images = $this->HousingService->selectImageById(1);
        $json = [];
        foreach($content as $c) {
            $json[] = json_encode([ 
                "id" => $c->getId(),
                "name" => $c->getName(),
                "capacity" => $c->getCapacity(),
                "price" => $c->getPrice(),
                "description" => $c->getDescription(),
                "number_pieces" => $c->getNbr_pieces(),
                "area" => $c->getArea(),
                "images" => $c->getImages()[0]->getImage(),
                "test" => $c->getName() . " " . $c->getNbr_pieces() . "pièces " . $c->getArea() . "m²"
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

        $content = $this->HousingService->selectHousing(0);
        $json = [];
        foreach($content as $c) {
            $json[] = json_encode([
                "id" => $c->getId(),
                "name" => $c->getName(),
                "capacity" => $c->getCapacity(),
                "price" => $c->getPrice(),
                "description" => $c->getDescription(),
                "number_pieces" => $c->getNbr_pieces(),
                "area" => $c->getArea(),
                "images" => $c->getImages()[0]->getImage()
            ]);
        }
 
        $this->render("search.php", $this->styles, [
            "json" => $json,
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function productPage(Request $request, Route $route): void {
        $this->updateStyles(['productPage.css']);

        $content = $this->HousingService->selectHousingHome();

        $this->render("productPage.php", $this->styles, [
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}