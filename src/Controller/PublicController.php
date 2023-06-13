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

        $content = $this->HousingService->selectHousingHome();

        $this->render("home.php", $this->styles, [
            "start" => $content,
            "route" => $route,
            "request" => $request
        ]);
    }
}