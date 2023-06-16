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

    public function home(Request $request, Route $route):void {
        $this->updateStyles(['home.css']);

        $content = $this->HousingService->selectHousing(1);
        $images = $this->HousingService->selectImageById(1);

        $this->render("home.php", $this->styles, [
            "images" => $images,
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }

    public function search(Request $request, Route $route): void {
        $this->updateStyles(['search.css']);

        $content = $this->HousingService->selectHousingHome();

        $this->render("search.php", $this->styles, [
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